@extends('front.master')
@section('title', 'Edit ' . $product->name)
@section('breadcrumb')
	<li><a href="{{ url('product/yours') }}">Produk Saya</a></li>
	<li class="active">Edit {{ $product->name }}</li>
@endsection
@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="box box-solid">
				<form method="post" action="{{ url('product/'.$product->id) }}" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<div class="box-header with-border">
						<h3 class="box-title">Form Isian {{ $product->name }}</h3>
					</div>
					<div class="box-body">
							<div class="row">
								<div class="col-sm-6">
									{{--product_name--}}
									<div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
										<label>Nama Produk</label>
										<input type="text" name="product_name" value="{{ $product->name }}"
										class="form-control" autofocus="on" required autocomplete="off">
										@if($errors->has('product_name'))
										<span class="help-block">
											{{ $errors->first('product_name') }}
										</span>
										@endif
									</div>
									{{--category_id--}}
									<div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
										<label>Kategori</label>
										<select class="form-control" name="category_id" required>
											<option>Pilih Kategori</option>
											@foreach($categories as $cat)
												<option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
													{{ $cat->name }}
												</option>
											@endforeach
										</select>
										@if($errors->has('category_id'))
										<span class="help-block">
											{{ $errors->first('category_id') }}
										</span>
										@endif
									</div>
									{{--product_weight--}}
									<div class="form-group {{ $errors->has('product_weight') ? 'has-error' : '' }}">
										<label>Berat Produk (Gram)</label>
										<input type="text" name="product_weight" value="{{ $product->weight }}"
										class="form-control" required autocomplete="off">
										@if($errors->has('product_weight'))
										<span class="help-block">
											{{ $errors->first('product_weight') }}
										</span>
										@endif
									</div>
									{{--product_price--}}
									<div class="form-group {{ $errors->has('product_price') ? 'has-error' : '' }}">
										<label>Harga Produk (Rp)</label>
										<input type="text" name="product_price" value="{{ $product->price }}"
										class="form-control" required autocomplete="off">
										@if($errors->has('product_price'))
										<span class="help-block">
											{{ $errors->first('product_price') }}
										</span>
										@endif
									</div>
									{{--product_image--}}
									<div class="form-group {{ $errors->has('product_image') ? 'has-error' : '' }}">
										<label>Gambar Produk</label>
										<input type="file" name="product_image" class="form-control" required>
										@if($errors->has('product_image'))
										<span class="help-block">
											{{ $errors->first('product_image') }}
										</span>
										@else
										<span class="help-block">
											Gambar produk harus berformat jpeg, jpg, atau png berukuran kurang dari 200kb
										</span>
										@endif
									</div>
								</div>
								<div class="col-sm-6">
									{{--product_desc--}}
									<div class="form-group {{ $errors->has('product_desc') ? 'has-error' : '' }}">
										<label>Deskripsi Produk</label>
										<textarea rows="16" name="product_desc" class="form-control" required>{{ $product->description }}</textarea>
										@if($errors->has('product_desc'))
										<span class="help-block">
											{{ $errors->first('product_desc') }}
										</span>
										@endif
									</div>
								</div>
							</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn bg-orange btn-flat">
							<i class="fa fa-save"></i>
							Update
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection