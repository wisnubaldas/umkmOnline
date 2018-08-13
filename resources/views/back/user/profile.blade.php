@extends('back.master')
@section('title', 'Profile')
@section('breadcrumb')
<li><a href="{{ url('admin/user') }}">Pengguna</a></li>
<li class="active">{{ $user->name }}</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-4">
		<div class="box box-solid">
			<div class="box-body">
				<img src="{{ is_null($user->image) ? $user->nullphoto() : asset('img/user/'.$user->image) }}" 
				class="img-responsive">
			</div>
		</div>
		@if($user->isHaveStore())
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Toko</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-xs-4">
						<img src="{{ is_null($user->store->image) ? $user->store->nullimage() : asset('img/store/'.$user->store->image) }}" 
						class="img-responsive img-thumbnail">
					</div>
					<div class="col-xs-8">
						<h4 class="text-orange text-center">{{ $user->store->name }}</h4>
						<a href="{{ url('admin/store/'.$user->store->id) }}" class="btn btn-default btn-block btn-sm">
							Lihat Toko
						</a>
					</div>
				</div>
			</div>
		</div>
		@endif
	</div>
	<div class="col-sm-8">
		<div class="box box-solid">
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" style="margin-bottom: 0">
						<tbody>
							<tr>
								<td>Nama</td>
								<td><span class="text-orange">{{ $user->name }}</span></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><span class="text-orange">{{ $user->email }}</span></td>
							</tr>
							<tr>
								<td>Peran</td>
								<td>
									<span class="label {{ $user->role_id == 1 ? 'label-success' : ($user->role_id == 2 ? 'label-primary' : 'label-default') }}">
										{{ $user->role->name }}		
									</span>
								</td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td><span class="text-orange">{{ $user->address ? $user->address->address : '' }}</span></td>
							</tr>
							<tr>
								<td>Kota / Kab</td>
								<td><span class="text-orange">{{ $user->address ? $user->address->city->name : '' }}</span></td>
							</tr>
							<tr>
								<td>Provinsi</td>
								<td><span class="text-orange">{{ $user->address ? $user->address->province->name : '' }}</span></td>
							</tr>
							<tr>
								<td>Kode Pos</td>
								<td><span class="text-orange">{{ $user->address ? $user->address->postal_code : '' }}</span></td>
							</tr>
							<tr>
								<td>Telpon</td>
								<td><span class="text-orange">{{ $user->address ? $user->address->phone : ''}}</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection