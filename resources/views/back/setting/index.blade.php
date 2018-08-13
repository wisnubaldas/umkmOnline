@extends('back.master')
@section('title', 'Pengaturan')
@section('breadcrumb')
<li class="active">Pengaturan</li>
@endsection
@section('content')
<div class="row">
	{{--category--}}
	<div class="col-sm-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">
					Kategori Produk
				</h3>
				<div class="box-tools">
					<button class="btn bg-purple btn-sm" id="addCatBtn">
						<i class="fa fa-plus"></i>
						Tambah Kategori
					</button>
				</div>
			</div>
			<div class="box-body" id="categoryBody"></div>
		</div>
	</div>
	{{--admin bank--}}
	<div class="col-sm-6">
		<div class="box box-default">
			<div class="box-header with-border">
				<h3 class="box-title">
					Bank Admin
				</h3>
				<div class="box-tools">
					<button class="btn bg-purple btn-sm" id="addBankBtn">
						<i class="fa fa-plus"></i>
						Tambah Bank
					</button>
				</div>
			</div>
			<div class="box-body" id="bankBody">
				
			</div>
		</div>
	</div>
</div>

{{--modal tambah kategori--}}
<div class="modal" id="addCatModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Tambah Kategori</h4>
			</div>
			<div class="modal-body">
				<form id="addCatForm" method="post" action="{{ url('admin/category') }}">
					{{ csrf_field() }}
					<div class="form-group category_name">
						<label>Nama Kategori</label>
						<input type="text" name="category_name" class="form-control" required autocomplete="off">
						<span class="help-block category_name_error"></span>
					</div>
					<button type="submit" class="btn bg-orange">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

{{--modal konfirmasi hapus kategori--}}
<div class="modal fade" id="delCatModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Hapus Kategori</h4>
			</div>
			<div class="modal-body">
				<p>Yakin hapus kategori?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn bg-purple"
				onclick="getElementById('delCatForm').submit()">Yakin</button>
				<form id="delCatForm" method="post" action="">
					{{ csrf_field() }}
					{{ method_field('delete') }}
				</form>
			</div>
		</div>
	</div>
</div>

{{--modal tambah bank--}}
<div class="modal" id="addBankModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Tambah Bank</h4>
			</div>
			<div class="modal-body">
				<form id="addBankForm" method="post" action="{{ url('admin/admin-bank') }}">
					{{ csrf_field() }}
					<div class="form-group bank_name">
						<label>Nama Bank</label>
						<input type="text" name="bank_name" class="form-control" required autocomplete="off">
						<span class="help-block bank_name_error"></span>
					</div>
					<div class="form-group bank_account">
						<label>Rekening Bank</label>
						<input type="text" name="bank_account" class="form-control" required autocomplete="off">
						<span class="help-block bank_account_error"></span>
					</div>
					<div class="form-group under_the_name">
						<label>Atas Nama Bank</label>
						<input type="text" name="under_the_name" class="form-control" required autocomplete="off">
						<span class="help-block under_the_name_error"></span>
					</div>
					<button type="submit" class="btn bg-orange">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>

{{--modal konfirmasi hapus kategori--}}
<div class="modal" id="delBankModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Hapus Bank</h4>
			</div>
			<div class="modal-body">
				<p>Yakin hapus bank?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn bg-purple"
				onclick="getElementById('delBankForm').submit()">Yakin</button>
				<form id="delBankForm" method="post" action="">
					{{ csrf_field() }}
					{{ method_field('delete') }}
				</form>
			</div>
		</div>
	</div>
</div>

{{--modal edit bank--}}
<div class="modal" id="editBankModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">edit Bank</h4>
			</div>
			<div class="modal-body"></div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		//category
		var categoryUrl = "{{ url('admin/category') }}";
		getData(categoryUrl, '#categoryBody');

		$('body').on('click', '#categoryBody .pagination a', function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			getData(url, '#categoryBody');
		});

		$('body').on('click', '#addCatBtn', function(){
			var modal = $('#addCatModal');
			modal.modal('show');
		});
		//tambah kategori
		$('body').on('submit', '#addCatForm', function(e){
			e.preventDefault();
			var url = $(this).attr('action');
			var data = $(this).serialize();
			$.ajax({
				method: 'post',
				url: url,
				data: data,
				error: function(msg){
					var errors = msg.responseJSON.errors;
					$.each(errors, function(k, v){
						$('.'+k).addClass('has-error');
						$('.'+k+'_error').text(v);
						setTimeout(function(){
							$('.'+k).removeClass('has-error');
							$('.'+k+'_error').text('');
						}, 2000);
					});
				},
				success: function(data){
					$('#addCatForm').find('input[name="category_name"]').val('');
					$('#addCatModal').modal('hide');
					$('#categoryBody').html(data);
				}
			});
		});

		//hapus kategori
		$('body').on('click', '.delCatBtn', function(){
			var modal = $('#delCatModal');
			var form = $('#delCatForm');
			form.attr('action', $(this).attr('url'));
			modal.modal('show');
		});


		//bank
		var bankUrl = "{{ url('admin/admin-bank') }}";
		getData(bankUrl, '#bankBody');
		$('body').on('click', '#bankBody .pagination a', function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			getData(url, '#bankBody');
		});

		$('body').on('click', '#addBankBtn', function(){
			var modal = $('#addBankModal');
			modal.modal('show');
		});

		//tambah Bank
		$('body').on('submit', '#addBankForm', function(e){
			e.preventDefault();
			var url = $(this).attr('action');
			var data = $(this).serialize();
			$.ajax({
				method: 'post',
				url: url,
				data: data,
				error: function(msg){
					var errors = msg.responseJSON.errors;
					$.each(errors, function(k, v){
						$('.'+k).addClass('has-error');
						$('.'+k+'_error').text(v);
						setTimeout(function(){
							$('.'+k).removeClass('has-error');
							$('.'+k+'_error').text('');
						}, 2000);
					});
				},
				success: function(data){
					$('#addBankForm').find('input[name="category_name"]').val('');
					$('#addBankModal').modal('hide');
					$('#bankBody').html(data);
				}
			});
		});

		$('body').on('submit', '#editBankForm', function(e){
			e.preventDefault();
			var url = $(this).attr('action');
			var data = $(this).serialize();
			$.ajax({
				method: 'patch',
				url: url,
				data: data,
				error: function(msg){
					var errors = msg.responseJSON.errors;
					$.each(errors, function(k, v){
						$('.'+k).addClass('has-error');
						$('.'+k+'_error').text(v);
						setTimeout(function(){
							$('.'+k).removeClass('has-error');
							$('.'+k+'_error').text('');
						}, 2000);
					});
				},
				success: function(data){
					$('#editBankForm').find('input[name="category_name"]').val('');
					$('#editBankModal').modal('hide');
					$('#bankBody').html(data);
				}
			});
		});

		$('body').on('click', '.editBankBtn', function(){
			var url = $(this).attr('url');
			$.ajax({
				method: 'get',
				url: url,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data)
				{
					var modal = $('#editBankModal');
					modal.find('.modal-body').html(data);
					modal.modal('show');
				}
			});
		});

		//hapus Bank
		$('body').on('click', '.delBankBtn', function(){
			var modal = $('#delBankModal');
			var form = $('#delBankForm');
			form.attr('action', $(this).attr('url'));
			modal.modal('show');
		});
	});

	function getData(url, body)
	{
		$.ajax({
			method: 'get',
			url: url,
			error: function(msg){
				console.log(msg.responseJSON);
			},
			success: function(data){
				$(body).html(data);
			}
		});
	}
</script>
@endpush