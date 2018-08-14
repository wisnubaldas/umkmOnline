@extends('front.master')
@section('title', 'Error 404')
@section('breadcrumb')
<li class="active">Error 404</li>
@endsection
@section('content')
<div class="error-page">
	<h2 class="headline text-yellow"> 404</h2>
	<div class="error-content">
		<h3><i class="fa fa-warning text-yellow"></i> Oops! Halaman tidak ditemukan.</h3>
		<p>
		Kami tidak dapat menemukan halaman yang ada cari.
		Anda boleh <a href="{{ url('/') }}">Kembali ke Halaman Utama</a> atau <a href="{{ url('/belanja') }}">ke Halaman Belanja</a>.
		</p>
	</div>
</div>
@endsection