@extends('print.master')
@section('title', 'Print '.$order->getCode())
@section('content')
<section class="invoice">
	<div class="row">
		<div class="col-sm-12">
			<h2 class="page-header">
	            {{ config('app.name') }}
	            <small class="pull-right">Invoice {{ $order->invoiceCode() }}</small>
	        </h2>
		</div>
	</div>
	<div class="row invoice-info">
        <div class="col-sm-6 invoice-col">
          	<address>
	            <strong>{{ $order->store->name }}</strong><br>
	            {{ $order->store->address->address }}<br>
	            {{ $order->store->address->city->name }}, {{ $order->store->address->province->name }} 
	            {{ $order->store->address->postal_code }}<br>
	            Phone: {{ $order->store->address->phone }}
	        </address>
        </div>
        <div class="col-sm-6 invoice-col">
        	Tanggal: {{ $order->tanggal() }}
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="table-responsive">
				<table class="table table-bordered table-hover" style="margin-bottom: 0">
					<tbody>
						@foreach($order->order_details as $item)
						<tr>
							<td class="text-muted" colspan="3">
								<h5 class="text-purple" style="margin: 0"><strong>{{ $item->product->name }}</strong></h5>
								{{ $item->quantity }} barang 
								({{ $item->weightInKilo() }})
								x {{ $item->priceStringFormatted() }}
							</td>
							<td class="text-right text-muted">
								{{ $item->totalPriceStringFormatted() }}
							</td>
						</tr>
						@endforeach
						<tr class="bg-gray">
							<td>
								<strong>Alamat Tujuan</strong><br>
								{{ $order->user->name }}<br>
								{{ $order->user->address->address }}<br>
								{{ $order->user->address->city->type }}
								{{ $order->user->address->city->name }}
								{{ $order->user->address->province->name }}
								{{ $order->user->address->postal_code }}<br>
								Telp {{ $order->user->address->phone }}
							</td>
							<td class="text-right">
								<strong>Total Berat Barang</strong><br>
								{{ $order->totalWeightInKilo() }}
							</td>
							<td class="text-right">
								<strong>Ongkir (JNE)</strong><br>
								({{ $order->jne_service }})
								{{ $order->ongkirStringFormatted() }}
							</td>
							<td class="text-right">
								<strong>Subtotal</strong><br>
								{{ $order->subtotalStringFormatted() }}
							</td>
						</tr>
						<tr>
							<th colspan="4" class="text-muted">
								<strong>Dibayar</strong>
								<span class="pull-right text-orange">
									<strong>{{ $order->totalTagihanStringFormatted() }}</strong>
								</span>
							</th>
						</tr>
					</tbody>
				</table>
			</div>
    	</div>
    </div>
</section>
@endsection
@push('scripts')
<script>
	$(function(){
		window.print();
	});
</script>
@endpush