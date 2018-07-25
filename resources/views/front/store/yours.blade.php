@extends('front.master')
@section('title', 'Toko Kamu')
@section('breadcrumb')
<li class="active">Toko Kamu</li>
@endsection
@section('content')

@if(session('success'))
	<div class="callout callout-success">
		<h4>Sukses!</h4>
		<p>{{ session('success') }}</p>
	</div>
@endif

@if(!$store->isActive())
	<div class="callout callout-warning">
		<h4>Pending!</h4>
		<p>Toko anda Belum aktif, Admin sedang verifikasi data toko anda</p>
	</div>
@endif

@endsection