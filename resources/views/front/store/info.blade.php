<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#about_store" data-toggle="tab" aria-expanded="true">Tentang Toko</a></li>
		<li class=""><a href="#address" data-toggle="tab" aria-expanded="false">Alamat Toko</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="about_store" style="min-height: 350px">
			<h3 style="margin-top: 0">
				<i class="fa fa-shopping-bag"></i>
				{{ $store->name }}
			</h3>
			<p class="text-justify">{{ $store->description }}</p>
		</div>
		<div class="tab-pane" id="address" style="min-height: 350px">
			<address>
				<strong>{{ $store->name }}</strong><br>
				{{ $store->address->address }} <br>
				{{ $store->address->city->name }}, {{ $store->address->province->name }}
				{{ $store->address->postal_code }}<br>
				{{ $store->address->phone }}
			</address>
		</div>
	</div>
</div>