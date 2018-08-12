@extends('back.master')
@section('title', 'Notifikasi')
@section('breadcrumb')
<li class="active">Notifikasi</li>
@endsection
@section('content')
<div class="row">
	<div class="col-sm-12">
		<ul class="timeline">
			@foreach($notifications as $n)
			<li>
				<i class="{{ $n->data['icon'] }}"></i>
				<div class="timeline-item">
					<span class="time">
						<i class="fa fa-clock-o"></i>
						{{ $n->created_at->diffForHumans() }}
					</span>
					<h3 class="timeline-header">
						{{ $n->data['title'] }}
					</h3>
					<div class="timeline-body">
						{{ $n->data['message'] }}
					</div>
					<div class="timeline-footer">
						<a href="{{ $n->data['link'] }}" class="btn btn-info btn-xs">Detail</a>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
@endsection