$('.checkAll').click(function() {
	if($(this).attr('checked')) {
		$('.check').attr('checked', 'checked');
	} else {
		$('.check').removeAttr('checked');
	}
});

$('.check').click(function(){
	update_parent_checkbox();
});
	
function update_parent_checkbox() {
	var checkboxesCount    = $('.check').length;
	var clickedCheckboxesCount  = $('.check').filter(':checked').length;

	if(checkboxesCount != clickedCheckboxesCount || checkboxesCount == 0){
		$('.checkAll').removeAttr('checked');
	} else {
		$('.checkAll').attr('checked','checked');
	}
}
	
$(document).ready( function () {
	update_parent_checkbox();
});
