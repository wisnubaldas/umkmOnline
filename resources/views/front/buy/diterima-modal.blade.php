{{--modal diterima--}}
<div class="modal" id="diterimaModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Pesanan Telah diterima</h4>
			</div>
			<div class="modal-body">
				Apakah anda yakin Pesanan anda <strong>sudah sampai</strong> dan <strong>anda terima?</strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn bg-purple" onclick="getElementById('diterimaForm').submit()">Ya</button>
				<form method="post" action="" id="diterimaForm">
					{{ csrf_field() }}
				</form>
			</div>
		</div>
	</div>
</div>