@extends('back.master')
@section('title', 'Dashboard')
@section('content')
<div class="row">
	<div class="col-sm-4 col-xs-6">
		<div class="small-box bg-orange">
			<div class="inner">
				<h3>Pembayaran</h3>
				<p>Masuk</p>
			</div>
			<div class="icon">
				<i class="fa fa-usd"></i>
			</div>
			<a href="{{ url('admin/payment') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-sm-4 col-xs-6">
		<div class="small-box bg-blue">
			<div class="inner">
				<h3>Pembayaran</h3>
				<p>Keluar</p>
			</div>
			<div class="icon">
				<i class="fa fa-usd"></i>
			</div>
			<a href="{{ url('admin/admin-payment') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-sm-4 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h3>Pengembalian</h3>
				<p>Dana</p>
			</div>
			<div class="icon">
				<i class="fa fa-usd"></i>
			</div>
			<a href="{{ url('admin/refund') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-sm-4 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>Info</h3>
				<p>Toko</p>
			</div>
			<div class="icon">
				<i class="fa fa-building"></i>
			</div>
			<a href="{{ url('admin/store') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-sm-4 col-xs-6">
		<div class="small-box bg-purple">
			<div class="inner">
				<h3>Info</h3>
				<p>Pengguna</p>
			</div>
			<div class="icon">
				<i class="fa fa-user"></i>
			</div>
			<a href="{{ url('admin/user') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-sm-4 col-xs-6">
		<div class="small-box bg-navy">
			<div class="inner">
				<h3>Pengaturan</h3>
				<p>Aplikasi</p>
			</div>
			<div class="icon">
				<i class="fa fa-sliders"></i>
			</div>
			<a href="{{ url('admin/setting') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
@endsection