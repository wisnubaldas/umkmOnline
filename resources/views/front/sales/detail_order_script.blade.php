$('body').on('click', '.detailOrderBtn', function(){
	var url = $(this).attr('url');
	$.ajax({
		method: 'get',
		url: url,
		error: function(msg){
			console.log(msg.responseJSON);
		},
		success: function(data){
			$('#detailOrderModal .modal-dialog').html(data);
			$('#detailOrderModal').modal('show');
		}
	});
});
$('.showText').popover();