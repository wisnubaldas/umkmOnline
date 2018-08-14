@extends('back.master')
@section('title', 'Daftar Pengguna')
@section('breadcrumb')
<li class="active">Daftar Pengguna</li>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	{{ session('success') }}
</div>
@endif
<div class="row">
	<div class="col-sm-12">
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="row">
					<div class="col-sm-6">
						<a href="{{ url('admin/user/print') }}" target="_blank" class="btn bg-navy">
							<i class="fa fa-print"></i>
							Cetak
						</a>
					</div>
					<div class="col-sm-6">
						<form method="get" action="{{ url('admin/user') }}">
							<div class="input-group input-group">
				                <input type="text" class="form-control" name="user_name" value="{{ request('user_name') }}" 
				                placeholder="Cari nama pengguna" required autocomplete="off">
			                    <span class="input-group-btn">
			                      <button type="submit" class="btn btn-info btn-flat">
			                      	<i class="fa fa-search"></i>
			                      </button>
			                    </span>
				             </div>
						</form>
					</div>
				</div>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered table-sm table-hover">
						<thead class="bg-info">
							<th class="text-center">#</th>
							<th class="text-center">Nama Pengguna</th>
							<th class="text-center">Email</th>
							<th class="text-center">Peran</th>
							<th class="text-center">#</th>
						</thead>
						<tbody>
							@if($users->count() > 0)
								@foreach($users as $index => $user)
									<tr>
										<td class="text-right">{{ $index + $users->firstItem() }}</td>
										<td class="text-info"><strong>{{ $user->name }}</strong></td>
										<td>{{ $user->email }}</td>
										<td>{{ $user->role->name }}</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('admin/user/'.$user->id.'/profile') }}" class="btn bg-orange btn-xs">
													<i class="fa fa-user"></i>
													Profil
												</a>
												<button class="btn btn-danger btn-xs delUserBtn"
												url="{{ url('admin/user/'.$user->id) }}">
													<i class="fa fa-trash"></i>
													Hapus
												</button>
											</div>
										</td>
									</tr>
								@endforeach
							@else
								<tr>
									<td colspan="4">
										@if(request('user_name'))
											Tidak ditemukan
										@else
											Belum ada Toko
										@endif
									</td>
								</tr>
							@endif
						</tbody>
					</table>
				</div>
				{{ $users->links() }}
			</div>
		</div>
	</div>
</div>
{{--modal konfirmasi hapus--}}
<div class="modal fade" id="delUserModal">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header bg-purple">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Konfirmasi Hapus</h4>
			</div>
			<div class="modal-body">
				Yakin Hapus User?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn btn-primary" onclick="getElementById('delUserForm').submit()">Ya</button>
				<form id="delUserForm" method="post" action="">
					{{ csrf_field() }}
					{{ method_field('delete') }}
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
	<script>
		$('body').on('click', '.delUserBtn', function(){
			var form = $('#delUserForm');
			var modal = $('#delUserModal');
			form.attr('action', $(this).attr('url'));
			modal.modal('show');
		});
	</script>
@endpush