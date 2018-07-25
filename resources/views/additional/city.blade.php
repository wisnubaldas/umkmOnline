@foreach($cities as $c)
	<option value="{{ $c->id }}" {{ Auth::user()->address->city_id == $c->id ? 'selected' : '' }}>
		{{ $c->type }} {{ $c->name }}
	</option>
@endforeach