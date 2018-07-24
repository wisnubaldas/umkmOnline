@extends('front.master')
@section('title', 'Pembayaran Kode '.$payment->getCode())
@section('breadcrumb')
	<li><a href="{{ url('payment') }}">Pembayaran</a></li>
	<li class="active">{{ $payment->getCode() }}</li>
@endsection
@section('content')
	@if(session('success'))
		<div class="callout callout-success">
			<h4>Sukses!</h4>
			<p>{{ session('success') }}</p>
		</div>
	@endif
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-body">
					{{--Transfer--}}
					<div class="callout bg-gray">
						<h4>Transfer Rekening Bank</h4>
						<p>
							Silahkan transfer uang anda senilai 
							<strong class="text-black">{{ $payment->amountStringFormatted() }}</strong> 
							ke salah satu nomor rekening <strong>{{ config('app.name') }}</strong> berikut.
						</p>
					</div>

					{{--daftar bank--}}
					
					<div class="row">
					@foreach($adminBanks as $bank)
						<div class="col-sm-4">
							<div class="box box-solid bg-gray">
								<div class="box-body">
									<h4 class="text-center">{{ $bank->bank_name }}</h4>
									<p class="text-center">{{ $bank->bank_account }}</p>
									<p class="text-center">a/n {{ $bank->under_the_name }}</p>
								</div>
							</div>
						</div>
					@endforeach
					</div>	

					{{--Detail Pembayaran--}}
					<h3>Detail Pembayaran</h3>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead class="bg-purple">
								<tr>
									<th class="text-center">Kode Pembayaran</th>
									<th class="text-center">Jumlah Pembayaran</th>
									<th class="text-center">Status</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">#</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>{{ $payment->getCode() }}</strong></td>
									<td class="text-right text-orange">
										<strong>{{ $payment->amountStringFormatted() }}</strong>
									</td>
									<td class="text-center">
										<span class="badge
										{{ $payment->is_paid == 1 ? 'bg-green' : 'bg-yellow' }}">
											{{ $payment->status() }}
										</span>
									</td>
									<td class="text-right">
										{{ $payment->tanggal() }}
									</td>
									<td class="text-center">
										<a href="javascript:void(0)" id="detailPesananBtn" class="btn bg-purple btn-xs">Detail Pesanan</a>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="row" id="detailPesanan" style="display: none">
						<div class="col-sm-12">
							<div class="box">
								<div class="box-body">
									@foreach($payment->orders as $order)
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th colspan="4" class="text-muted">
														Pembelian dari toko <strong>{{ $order->store->name }}</strong>
														({{ $order->store->city->name }})
														<span class="pull-right">
															<strong>{{ $order->code }}</strong>
														</span>
														<a href="javascript:void(0)" class="btn-link tbody-toggle">
															(Detail)
														</a>
													</th>
												</tr>
											</thead>
											<tbody style="display: none">
												@foreach($order->order_details as $item)
													<tr>
														<td class="text-muted" colspan="3">
															<h5 class="text-purple" style="margin:0">
																<strong>{{ $item->product->name }}</strong>
															</h5>
															{{ $item->quantity }} barang ({{$item->weightInKilo()}})
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
														{{ $order->user->city->name }}
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
											</tbody>
											<thead>
												<tr>
													<th colspan="4" class="text-muted">
														<strong>Total Tagihan</strong>
														<span class="pull-right text-orange">
															<strong>{{ $order->totalTagihanStringFormatted() }}</strong>
														</span>
													</th>
												</tr>
											</thead>
										</table>
									</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>

					{{--konfirmasi Pembayaran--}}
					<div class="callout bg-gray">
						<h4>Konfirmasi Pembayaran</h4>
						<p>
							Setelah melakukan pembayaran dengan transfer ke salah satu nomor rekening Bank kami diatas, Segeralah melakukan konfirmasi pembayaran dengan mengisi form yang telah kami sediakan. 
						</p>
					</div>

					@if(is_null($payment->payment_confirmation))
					<div class="text-center">
						<a href="{{ url('payment-confirmation'.'?kode='.$payment->code) }}" class="btn bg-orange btn-lg">Konfirmasi Pembayaran</a>
					</div>
					@else
					<table class="table table-bordered">
						<thead class="bg-gray">
							<tr>
								<th class="text-center">Tanggal Transfer</th>
								<th class="text-center">Bank Tujuan</th>
								<th class="text-center">Dari Bank</th>
								<th class="text-center">Rekening</th>
								<th class="text-center">Atas Nama</th>
								<th class="text-center">Total Transfer</th>
								<th class="text-center">#</th>
							</tr>
						</thead>
						<tbody>
							@php $confirm = $payment->payment_confirmation @endphp
							<tr>
								<td class="text-center">{{ $confirm->dateFormatted() }}</td>
								<td class="text-center">{{ $confirm->admin_bank_name }}</td>
								<td class="text-center">{{ $confirm->user_bank_name }}</td>
								<td class="text-center">{{ $confirm->bank_account }}</td>
								<td class="text-center">{{ $confirm->under_the_name }}</td>
								<td class="text-right">{{ $confirm->amountStringFormatted() }}</td>
								<td class="text-center">
									<a href="{{ url('payment-confirmation/'.$confirm->id.'/edit') }}" class="btn btn-warning btn-xs">Edit</a>
									<form method="post" action="{{ url('payment-confirmation/'.$confirm->id) }}">
										{{ csrf_field() }}
										{{ method_field('delete') }}
										<button type="submit" class="btn btn-danger btn-xs">Hapus</button>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
	<script>
		$('body').on('click', '.tbody-toggle', function(){
			var tbody = $(this).parent().parent().parent().parent().find('tbody');
			tbody.fadeToggle();
		});

		$('#detailPesananBtn').on('click', function(){
			$('#detailPesanan').fadeToggle();
		})
	</script>
@endpush