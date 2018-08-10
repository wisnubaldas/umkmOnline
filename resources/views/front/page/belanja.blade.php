@extends('front.master')
@section('title', 'Belanja')
@section('content')
@if(Auth::check())
	@if(!Auth::user()->isHaveAddress())
	<div class="callout bg-gray">
		<p>
			Sebelum berbelanja silahkan lengkapi dulu profil anda.
			<a href="{{ url('profile') }}" class="text-orange">Lengkapi Profil Saya</a> 
		</p>
		
	</div>
	@endif
@endif
<div class="row">
	<div class="col-sm-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title text-muted">
					<strong>
						<i class="fa fa-search"></i>
						Cari Produk
					</strong>
				</div>
			</div>
			<div class="box-body">
				<div class="form-group">
					<input type="text" id="query" name="query" class="form-control" placeholder="Cari Produk"
					value="{{ request('query') }}">
				</div>
			</div>
		</div>
		<div class="box box-solid">
			<div class="box-header with-border">
				<div class="box-title text-muted">
					<strong>
						<i class="fa fa-tags"></i>
						Kategori
					</strong>
				</div>
			</div>
			<div class="box-body">
				<div class="form-group">
					<select id="category_id" name="category_id" class="form-control">
						<option value="0">Pilih Semua</option>
						@foreach($categories as $cat)
						<option value="{{ $cat->id }}">{{ $cat->name }}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div id="productList">
			
		</div>
	</div>
</div>

@endsection
@push('style')
	<style type="text/css">
		.pagination .active span {
			background-color: #605ca8 !important;
			border-color: #605ca8 !important;
		}
	</style>
@endpush
@push('scripts')
<script>
	$(function(){
		
		//onload
		var query = $('#query').val();
		var category_id = $('#category_id').val();
		var url = "{{ url('belanja') }}" + '?query=' + query + '&category_id=' + category_id;
		$.ajax({
			method: 'get',
			url: url,
			beforeSend: function() {
				$('#productList').html('<i class="fa fa-cog fa-spin fa-2x text-orange">');
			},
			error: function(msg){
				console.log(msg.responseJSON);
			},
			success: function(data){
				setTimeout(function(){
					$('#productList').html(data);
				}, 1000);
			}
		});

		$('body').on('change', '#query', function(){
			var query = $(this).val();
			var category_id = $('#category_id').val();
			var url = "{{ url('belanja') }}" + '?query=' + query + '&category_id=' + category_id ;
			$.ajax({
				method: 'get',
				url: url,
				beforeSend: function() {
					$('#productList').html('<i class="fa fa-cog fa-spin fa-2x text-orange">');
				},
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					setTimeout(function(){
						$('#productList').html(data);
					}, 1000);
				}
			});
		});

		$('body').on('change', '#category_id', function(){
			var query = $('#query').val();
			var category_id = $(this).val();
			var url = "{{ url('belanja') }}" + '?query=' + query + '&category_id=' + category_id ;
			$.ajax({
				method: 'get',
				url: url,
				beforeSend: function() {
					$('#productList').html('<i class="fa fa-cog fa-spin fa-2x text-orange">');
				},
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					setTimeout(function(){
						$('#productList').html(data);
					}, 1000);
				}
			});
		});

		$('body').on('click', '.pagination a', function(e){
			e.preventDefault();
			var url = $(this).attr('href');
			$.ajax({
				method: 'get',
				url: url,
				beforeSend: function() {
					$('#productList').html('<i class="fa fa-cog fa-spin fa-2x text-orange">');
				},
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					setTimeout(function(){
						$('#productList').html(data);
					}, 1000);
				}
			});

		});
		
	});
</script>
@endpush