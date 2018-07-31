{{--Ganti Gambar Modal--}}
<div class="modal" id="gantiGambarModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Ganti Gambar</h4>
			</div>
			<div class="modal-body">
				<form class="editStoreForm" method="post" action="{{ url('store/'.$store->id.'?attr=image') }}"
				enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group store_image">
						<input type="file" name="store_image" class="form-control" required>
						<span class="help-block store_image_error"></span>
					</div>
					<button type="submit" class="btn btn-block btn-flat bg-orange">
						Update
					</button>
				</form>
			</div>
		</div>
	</div>
</div>