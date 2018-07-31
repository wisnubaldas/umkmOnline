{{--Ganti nama shop--}}
<div class="modal" id="gantiNamaModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Ganti Nama</h4>
			</div>
			<div class="modal-body">
				<form class="editStoreForm" method="post" action="{{ url('store/'.$store->id.'?attr=name') }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group store_name">
						<input type="text" name="store_name" class="form-control" required autocomplete="off"
						value="{{ $store->name }}">
						<span class="help-block store_name_error"></span>
					</div>
					<button type="submit" class="btn btn-block btn-flat bg-orange">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</div>