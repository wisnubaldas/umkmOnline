{{--Edit Address Modal--}}
<div class="modal" id="editAddressModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Alamat Toko</h4>
			</div>
			<div class="modal-body">
				<form class="editStoreForm" method="post" action="{{ url('store/'.$store->id.'?attr=address') }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group address">
						<label>Alamat</label>
						<textarea class="form-control" rows="6" 
						name="address">{{ $store->address->address }}</textarea>
						<span class="help-block address_error"></span>
					</div>
					<div class="form-group city_id">
						<label>Kota/Kabupaten</label>
						<select name="city_id" class="form-control">
							@foreach($cities as $city)
								<option value="{{ $city->id }}" 
								{{ $city->id == $store->address->city_id ? 'selected' : '' }}>
									{{ $city->type . ' ' . $city->name }}
								</option>
							@endforeach
						</select>
						<span class="help-block city_id_error"></span>
					</div>
					<div class="form-group province_id">
						<label>Provinsi</label>
						<select name="province_id" class="form-control">
							@foreach($provinces as $province)
								<option value="{{ $province->id }}" 
								{{ $province->id == $store->address->province_id ? 'selected' : '' }}>
									{{ $province->name }}
								</option>
							@endforeach
						</select>
						<span class="help-block province_id_error"></span>
					</div>
					<div class="form-group postal_code">
						<label>Kode Pos</label>
						<input type="text" name="postal_code" class="form-control" value="{{ $store->address->postal_code }}">
						<span class="help-block postal_code_error"></span>
					</div>
					<div class="form-group phone">
						<label>Telpon</label>
						<input type="text" name="phone" class="form-control" value="{{ $store->address->phone }}">
						<span class="help-block phone_error"></span>
					</div>
					<button type="submit" class="btn btn-block btn-flat bg-orange">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</div>