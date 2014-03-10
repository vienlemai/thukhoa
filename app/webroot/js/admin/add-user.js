$(".root-category").on('change', 'input[type=checkbox]', function() {
	var checked = $(this).is(':checked');
	var $divParrent = $(this).parent().parent();
	var $children = $divParrent.children('div.child-category');
	$children.children().each(function() {
		console.log($(this).children());
		$(this).children().prop('checked', checked);
	});
});