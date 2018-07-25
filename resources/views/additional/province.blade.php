@foreach($provinces as $p)
		@if(Auth::user()->address->province_id == $p->id)
			<option value="{{ $p->id }}" selected>{{ $p->name }}</option>
		@else
			<option value="{{ $p->id }}">{{ $p->name }}</option>
		@endif
@endforeach