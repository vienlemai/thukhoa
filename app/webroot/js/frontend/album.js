$(document).ready(function() {
	$('.fancybox-buttons').fancybox({
		openEffect: 'none',
		closeEffect: 'none',
		prevEffect: 'none',
		nextEffect: 'none',
		closeBtn: false,
		helpers: {
			title: {
				type: 'inside'
			},
			buttons: {}
		},
		afterLoad: function() {
			this.title = 'Ảnh ' + (this.index + 1) + '/' + this.group.length + (this.title ? ' - ' + this.title : '');
		}
	});
});