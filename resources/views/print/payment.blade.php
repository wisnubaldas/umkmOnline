@extends('print.master')
@section('title', 'Cetak Pembayaran Masuk')
@section('content')
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Pembayaran Masuk periode {{ request('dari') . ' - ' . request('sampai') }}</h3>		
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Kode</th>
							<th class="text-center">Jumlah Pembayaran</th>
							<th class="text-center">Pembeli</th>
							<th class="text-center">Status</th>
							<th class="text-center">Tanggal</th>
						</thead>
						<tbody>
							@if($payments->count() > 0)
								@foreach($payments as $index => $payment)
									<tr>
										<td class="text-right">{{ $index+1 }}</td>
										<td>{{ $payment->getCode() }}</td>
										<td class="text-right">{{ $payment->amountStringFormatted() }}</td>
										<td>{{ $payment->user->name }}</td>
										<td class="text-center">
											<span class="label {{ $payment->is_paid == 0 ? 'bg-yellow' : 'bg-green' }}">
												{{ $payment->status() }}
											</span>
										</td>
										<td class="text-right">
											{{ $payment->tanggal() }}
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="7">
										@if(request('code'))
											Pembayaran tidak ditemukan
										@else
											Belum ada pembayaran
										@endif
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		window.print();
	});
</script>
@endpush