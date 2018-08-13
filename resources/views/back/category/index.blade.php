<div class="table-responsive">
	<table class="table table-striped table-hover" style="margin-bottom: 0">
		<tbody>
			@if($categories->count() > 0)
				@foreach($categories as $index => $cat)
				<tr>
					<td style="width: 10px">{{ $index + $categories->firstItem() }}</td>
					<td>{{ $cat->name }}</td>
					<td>
						<button class="btn btn-danger btn-xs delCatBtn"
						url="{{ url('admin/category/'.$cat->id) }}">
							<i class="fa fa-trash"></i>
						</button>
					</td>
				</tr>
				@endforeach
			@endif
		</tbody>
	</table>
</div>
{{ $categories->links() }}