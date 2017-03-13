$(function() {
    $('.insert').click(function() {
	$('#submit').val('insert');
	$('#form').submit();
    });
    $('.update').click(function() {
    	var update_id = $(this).parent().siblings().first().html();
	$('#id').val(update_id);
	$('#submit').val('update');
	$('#form').submit();
    });
    $('.delete').click(function() {
    	var delete_id = $(this).parent().siblings().first().html();
	$('#id').val(delete_id);
	$('#submit').val('delete');
	$('#form').submit();
    });
});
