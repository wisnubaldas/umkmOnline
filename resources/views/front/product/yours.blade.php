@extends('front.master')
@section('title', 'Produk Saya')
@section('breadcrumb')
	<li class="active">Produk Saya</li>
@endsection
@section('content')
	@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check"></i> Sukses!</h4>
		{{ session('success') }}
	</div>
	@endif
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">Daftar Produk Saya</h3>
					<div class="box-tools">
						<a href="{{ url('product/create') }}" class="btn bg-orange btn-sm">
							<i class="fa fa-plus"></i>
							Tambah Produk
						</a>
					</div>
				</div>
				<div class="box-body">
				@if($products->count() > 0)
					<div class="row">
						@foreach($products as $product)
						<div class="col-sm-2">
							<table 
							url="{{ url('product/'.$product->id.'?src=yours') }}"
							class="table table-bordered product-item" style="cursor: pointer">
								<tbody>
									<tr>
										<td>
											<img 
											src="{{ $product->hasImage() ? asset('img/product/'.$product->image):
											asset('img/product/null.jpg') }}" 
											class="img-responsive">
											<p class="text-center text-orange">
												{{ $product->name }}
											</p>
											
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						@endforeach
					</div>
				@else
					Belum ada produk
				@endif
				</div>
				<div class="box-footer">
					{{ $products->links() }}
				</div>
			</div>
		</div>
	</div>
	{{-- show product modal --}}
	<div class="modal" id="showProductModal">
		<div class="modal-dialog modal-lg"></div>
	</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click dblclick', '.product-item', function(){
			var url = $(this).attr('url');
			$.ajax({
				method: 'get',
				url: url,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					var modal = $('#showProductModal');
					modal.find('.modal-dialog').html(data);
					modal.modal('show');
				}
			});
		});

		$('body').on('click', '.kosongTersediaBtn', function(){
			var url = $(this).attr('url');
			$.ajax({
				method: 'get',
				url: url,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					var modal = $('#showProductModal');
					modal.find('.modal-dialog').html(data);
				}
			})
		});
	});
</script>
@endpush