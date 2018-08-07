<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#about_store" data-toggle="tab" aria-expanded="true">Tentang Toko</a></li>
		<li class=""><a href="#address" data-toggle="tab" aria-expanded="false">Alamat Toko</a></li>
		@if($store->user == Auth::user())
		<li class=""><a href="#bank" data-toggle="tab" aria-expanded="false">Info Bank</a></li>
		@endif
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="about_store" style="min-height: 350px">
			<div class="well">
				<p class="text-justify">
					{{ $store->description }}
					<button class="btn btn-link btn-xs text-orange editStoreBtn"
					target-modal="#editDescModal">
						<i class="fa fa-edit"></i>
					</button>
				</p>
			</div>
		</div>
		<div class="tab-pane" id="address" style="min-height: 350px">
			<div class="row">
				<div class="col-sm-6">
					<div class="well">
						<div class="table-responsive">
							<table class="table table-stripped">
								<tbody>
									<tr>
										<td>Alamat</td>
										<td>{{ $store->address->address }}</td>
									</tr>
									<tr>
										<td>Kota/Kab</td>
										<td>{{ $store->address->city->name }}</td>
									</tr>
									<tr>
										<td>Provinsi</td>
										<td>{{ $store->address->province->name }}</td>
									</tr>
									<tr>
										<td>Kode Pos</td>
										<td>{{ $store->address->postal_code }}</td>
									</tr>
									<tr>
										<td>Telp</td>
										<td>{{ $store->address->phone }}</td>
									</tr>
									<tr>
										<td colspan="2">
											<button class="btn btn-link btn-xs text-orange editStoreBtn"
											target-modal="#editAddressModal">
												<i class="fa fa-edit"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="bank" style="min-height: 350px">
			<div class="row">
				<div class="col-sm-6">
					<div class="well">
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<td>Nama Bank</td>
										<td>{{ $store->bank->bank_name }}</td>
									</tr>
									<tr>
										<td>Rekening Bank</td>
										<td>{{ $store->bank->bank_account }}</td>
									</tr>
									<tr>
										<td>Atas Nama</td>
										<td>{{ $store->bank->under_the_name }}</td>
									</tr>
									<tr>
										<td colspan="2">
											<button class="btn btn-link btn-xs text-orange editStoreBtn"
											target-modal="#editBankModal">
												<i class="fa fa-edit"></i>
											</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>