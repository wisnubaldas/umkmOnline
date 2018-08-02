{{--ktp modal--}}
<div class="modal" id="ktpModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">KTP {{ $store->user->name }}</h4>
			</div>
			<div class="modal-body">
				<img src="{{ asset('img/store/ktp/'.$store->ktp) }}" class="img-responsive">
			</div>
		</div>
	</div>
</div>
{{-- acivate / nonactivate --}}
<div class="modal" id="activateNonActivateModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi</h4>
			</div>
			<div class="modal-body">
				Apakah anda yakin <strong id="act"></strong> Toko <strong>{{ $store->name }}</strong>?
			</div>
			<div class="modal-footer">
	            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
	            <button type="button" class="btn btn-primary" 
	            onclick="getElementById('activateNonActivateForm').submit()">Ya</button>
	            <form id="activateNonActivateForm" method="post">
	            	{{ csrf_field() }}
	            	{{ method_Field('patch') }}
	            </form>
	        </div>
		</div>
	</div>
</div>