{{--Edit Desc Modal--}}
<div class="modal" id="editDescModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Tentang Toko</h4>
			</div>
			<div class="modal-body">
				<form class="editStoreForm" method="post" action="{{ url('store/'.$store->id.'?attr=desc') }}">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group store_description">
						<textarea class="form-control" rows="8" 
						name="store_description">{{ $store->description }}</textarea>
						<span class="help-block store_description_error"></span>
					</div>
					<button type="submit" class="btn btn-block btn-flat bg-orange">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</div>