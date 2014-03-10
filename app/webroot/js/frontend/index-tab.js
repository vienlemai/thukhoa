//editor
tinymce.init({
	selector: "#confidential-editor",
	menubar: false,
	statusbar: false,
	height: "350px",
	plugins: "paste",
	paste_as_text: true,
	toolbar: "bold italic | bullist numlist",
	setup: function(ed)
	{
		ed.on('init', function()
		{
			this.getDoc().body.style.fontSize = '13px';
			this.getDoc().body.style.lineHeight = '1.5';
		});
	}
});
//load ajax content for news tab for default
$.ajax({
	dataType: "html",
	evalScripts: true,
	url: 'posts/allPosts',
	cache: true,
	success: function(data, textStatus) {
		$("#tabs-news-content").html(data);
		confidentialValidate();
	},
});

//load ajax content for news tab when click
$("#tab-news").on('click', function() {
	if ($("#tabs-news-content").html().trim() === '') {
		$.ajax({
			dataType: "html",
			evalScripts: true,
			url: 'posts/allPosts',
			cache: true,
			success: function(data, textStatus) {
				$("#tabs-news-content").html(data);
				confidentialValidate();
			},
		});
	}
});
//load ajax content for confidential tab
$("#tab-confidential").on('click', function() {
	console.log($("#list-confidentials").html());
	if ($("#list-confidentials").html().trim() === '') {
		$.ajax({
			dataType: "html",
			evalScripts: true,
			url: 'confidentials/index',
			cache: true,
			success: function(data, textStatus) {
				$("#list-confidentials").html(data);
				confidentialValidate();
			},
		});
	}


});
$("body").on('click', '#btn-add-confidential', function() {
	$("html, body").animate({ scrollTop: $(document).height()-200 }, "slow");
	$("#confidential-content").show(500);
});
$("body").on('click', '#btn-confidential-cancel', function() {
	$("#confidential-content").hide(500);
});



function confidentialValidate() {
	$.validator.setDefaults({
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block'
	});

	$("#form-confidential").validate({
		rules: {
			"data[Confidential][email]": {
				required: true,
				email: true,
			},
			"data[Confidential][title]": "required",
		},
		messages: {
			"data[Confidential][email]": {
				required: "Bạn chưa nhập email",
				email: "Địa chỉ email không hợp lệ"
			},
			"data[Confidential][title]": "Bạn chưa nhập tiêu đề",
		},
	});
}

//submit handler
$("#btn-confidential-submit").on("click", function() {
	tinyMCE.triggerSave();
	if ($("#form-confidential").valid()) {
		var data = $("#form-confidential").serialize();
		$.ajax({
			url: 'confidentials/add',
			type: 'post',
			dataType: 'json',
			data: data,
			success: function(result) {
				$("#confidential-alert .alert-content").html(result['message']);
				if (result['status'] == 1) {
					$("#confidential-alert .alert-success .alert-content").html(result['message']);
					$("#confidential-alert .alert-success").show();
					$("#form-confidential").trigger('reset');
					$("#confidential-content").hide();
				}
				else {
					$("#confidential-alert .alert-danger .alert-content").html(result['message']);
					$("#confidential-alert .alert-danger").show();

				}
			},
			error: function(e) {

			},
		});
	}

});


