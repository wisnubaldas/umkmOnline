@extends('front.master')
@section('title', 'Obrolan Produk')
@section('breadcrumb')
<li class="active">Obrolan Produk</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-6">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#buyerTab" data-toggle="tab" aria-expanded="true">
						Dengan Penjual
						@if(Auth::user()->buyerUnreadMessageCount() > 0)
						<span class="label label-warning">
							{{ Auth::user()->buyerUnreadMessageCount() }}
						</span>
						@endif
					</a>
				</li>
				<li>
					<a href="#sellerTab" data-toggle="tab" aria-expanded="false">
						Dengan Pembeli
						@if(Auth::user()->sellerUnreadMessageCount() > 0)
						<span class="label label-warning">
							{{ Auth::user()->sellerUnreadMessageCount() }}
						</span>
						@endif
					</a>
				</li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="buyerTab">
					<div class="table-responsive mailbox-messages">
						<table class="table table-hover">
							<tbody>
								@if($buyerConversations->count() > 0)
									@foreach($buyerConversations as $con)
										<tr url="{{ url('product-conversation/'.$con->id) }}" 
										class="conv-row {{ $con->unreadMessageCount() > 0 ? 'bg-gray' : '' }}"
										style="cursor: pointer">
											<td class="text-orange">{{ $con->product->name }}</td>
											<td class="text-purple">
												{{ $con->seller->name }}
												@if($con->unreadMessageCount() > 0)
												<span class="label label-warning">
													{{ $con->unreadMessageCount() }}
												</span>
												@endif
											</td>
											<td class="text-right">{{ $con->getLastMessage()->created_at->diffForHumans() }}</td>
										</tr>
									@endforeach
								@else
								<tr><td colspan="3">Tidak ada Obrolan</td></tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane" id="sellerTab">
					<div class="table-responsive mailbox-messages">
						<table class="table table-hover">
							<tbody>
								@if($sellerConversations->count() > 0)
									@foreach($sellerConversations as $con)
										<tr url="{{ url('product-conversation/'.$con->id) }}" 
										class="conv-row {{ $con->unreadMessageCount() > 0 ? 'bg-gray' : '' }}"
										style="cursor: pointer">
											<td class="text-orange">{{ $con->product->name }}</td>
											<td class="text-purple">
												{{ $con->buyer->name }}
												@if($con->unreadMessageCount() > 0)
												<span class="label label-warning">
													{{ $con->unreadMessageCount() }}
												</span>
												@endif
											</td>
											<td class="text-right">{{ $con->getLastMessage()->created_at->diffForHumans() }}</td>
										</tr>
									@endforeach
								@else
								<tr><td colspan="3">Tidak ada Obrolan</td></tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6">
		<div class="box box-solid" id="messageBox" style="min-height: 450px; max-height: 450px"></div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	$(function(){
		$('body').on('click', '.conv-row', function(){
			var url = $(this).attr('url');
			$.ajax({
				method: 'get',
				url: url,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					var messageBox = $('#messageBox');
					messageBox.html(data);
				}
			})
		});

		$('body').on('submit', '#sendMessageForm', function(e){
			e.preventDefault();
			var url = $(this).attr('action');
			var data = $(this).serialize();
			$.ajax({
				method: 'patch',
				url: url,
				data: data,
				error: function(msg){
					console.log(msg.responseJSON);
				},
				success: function(data){
					var messageBox = $('#messageBox');
					messageBox.html(data);
				}
			})
		});

		$('body').on('click', '#inputMessage', function(){
			var unreadCount = $(this).attr('unreadCount');
			if (parseInt(unreadCount) > 0) {
				var url = $(this).attr('url');
				$.ajax({
					method: 'get',
					url: url,
					error: function(msg){
						console.log(msg.responseJSON);
					},
					success: function(data){
						var messageBox = $('#messageBox');
						messageBox.html(data);
						$('#inputMessage').focus();
					}
				});
			}
		});
	});
</script>
@endpush