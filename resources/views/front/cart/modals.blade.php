{{-- edit quantity modal --}}
<div class="modal fade" id="editQuantityModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Edit Keranjang Belanja</h4>
			</div>
			<div class="modal-body">
				<form id="editQuantityForm" method="post" action>
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="product_name" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Jumlah</label>
						<input type="number" name="quantity" class="form-control">
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
				<button id="editQuantitySubmitBtn" type="button" class="btn bg-purple btn-flat" 
				onclick="getElementById('editQuantityForm').submit()">Simpan</button>
			</div>
		</div>
	</div>
</div>

{{--delete detail cart--}}
<div class="modal fade" id="konfirmasiPembatalanModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Pembatalan Transaksi</h4>
			</div>
			<div class="modal-body">
				Pembatalan transaksi dari toko <strong id="storeName"></strong>
				untuk produk <strong id="productName"></strong>
				Senilai <strong id="prices"></strong>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn btn-flat bg-purple"
				onclick="getElementById('pembatalanForm').submit()">Ya</button>
				<form id="pembatalanForm" method="post">
					{{ csrf_field() }}
					{{ method_field('delete') }}
				</form>
			</div>
		</div>
	</div>
</div>

{{-- do payment modal --}}
<div class="modal fade" id="konfirmasiPembelianModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Pembelian</h4>
			</div>
			<div class="modal-body">
				<h4>Anda akan membayar senilai 
					<strong class="text-orange">
						Rp. {{ number_format($totalPembayaran, 0, '', '.') }}
					</strong>
				</h4>
				<p class="text-aqua">Untuk informasi nomor tujuan rekening anda, akan kami informasikan di halaman selanjutnya.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn btn-flat bg-purple"
				onclick="getElementById('konfirmasiPembelianForm').submit()">Ya</button>
				<form id="konfirmasiPembelianForm" method="post" action="{{ url('payment') }}">
					{{ csrf_field() }}
					<input type="hidden" name="amount" value="{{ $totalPembayaran }}">
				</form>
			</div>
		</div>
	</div>
</div>