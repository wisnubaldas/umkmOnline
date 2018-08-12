<div class="box-body">
	<div class="row">
		<div class="col-xs-3">
			<img src="{{ $product->hasImage() ? asset('img/product/'.$product->image) :
			asset('img/product/null.jpg') }}" class="img-responsive">
		</div>
		<div class="col-xs-9">
			<h3 class="text-muted">{{ $product->name }}</h3>
			<h5 class="text-orange">
				@if($productConversation->seller->id == Auth::id())
					{{ $productConversation->buyer->name }} (Pembeli)
				@else
					{{ $productConversation->seller->name }} (Penjual)
				@endif
			</h5>
		</div>
	</div>
</div>
<div class="box-footer box-comments" style="min-height: 250px;max-height: 250px; overflow: auto">
	@foreach($messages as $m)
		<div class="box-comment">
			<img class="img-circle img-sm" src="{{ is_null($m->user->image) ? $m->user->nullphoto() : asset('img/user/'.$m->user->image) }}" alt="User Image">
			<div class="comment-text">
				@if($productConversation->seller->id == Auth::id())
					<span class="username">
						@if($m->user->id == $productConversation->buyer->id)
						<span class="text-orange">{{ $m->user->name }} (Pembeli)</span>
						@else
							Saya
						@endif
						<span class="text-muted pull-right">{{ $m->created_at->diffForHumans() }}</span>
					</span>
				@else
					<span class="username">
						@if($m->user->id == $productConversation->seller->id)
						<span class="text-orange">{{ $m->user->name }} (Penjual)</span>
						@else
							Saya
						@endif
						<span class="text-muted pull-right">{{ $m->created_at->diffForHumans() }}</span>
					</span>
				@endif
				{{ $m->message }}
			</div>
		</div>
	@endforeach
</div>
<div class="box-footer">
	<form action="{{ url('product-conversation/'.$productConversation->id) }}" method="post"
	id="sendMessageForm">
		{{ csrf_field() }}
		{{ method_field('patch') }}
		<img class="img-responsive img-circle img-sm" 
		src="{{ is_null(Auth::user()->image) ? Auth::user()->nullphoto() : asset('img/user/'.Auth::user()->image) }}">
		<div class="img-push">
			<input type="text" id="inputMessage" name="message" class="form-control input-sm" placeholder="Tekan Enter untuk mengirim pesan" unreadCount="{{ $productConversation->unreadMessageCount() }}"
			url="{{ url('product-conversation/'.$productConversation->id.'/read') }}" required>
		</div>
	</form>
</div>