$(function() {
//schedule validator
	$.validator.setDefaults({
		highlight: function(element) {
			$(element).closest('.control-group').addClass('error');
		},
		unhighlight: function(element) {
			$(element).closest('.control-group').removeClass('error');
		},
		errorElement: 'span',
		errorClass: 'help-block'
	});
	$("#ScheduleAdminAddForm").validate();
	$("#ScheduleAdminEditForm").validate();
	$("#ScheduleTitle").rules('add', {
		required: true,
		messages: {
			required: "Nhập thông tin cho trường này"
		}
	});
	/**
	 * Upload file
	 * */
	var jqXHR = null;
	$('#schedule-input-file').fileupload({
		dataType: "json",
		add: function(e, data) {
			jqXHR = data.submit();
		},
		start: function(e) {
			$('#schedule-upload-progress').show();
			$("#schedule-alert").removeClass();
			$("#schedule-alert").hide();
			$('.progress .bar').css(
					"width",
					0 + '%'
					);
		},
		done: function(data) {
			$("#schedule-upload-progress").hide();
		},
		success: function(data) {
			if (data["status"] == 1) {
//show message
				$("#ScheduleFilePath").val(data["file_path"]);
				$("#ScheduleFileName").val(data["file_name"]);
				$("#ScheduleFileAbsolutePath").val(data["file_absolute_path"]);
				$("#ScheduleSize").val(data["file_size"]);
				$("#ScheduleExt").val(data["ext"]);
				$("#schedule-alert").removeClass();
				$("#schedule-alert").addClass("alert alert-success");
				$("#schedule-alert span").html(data["message"]);
				$("#schedule-alert").show(1000);
				//show file uploaded infor

				$("#schedule-input-file").hide();
				$("#schedule-file-uploaded-info").show();
				$("#schedule-uploaded-icon").attr("src", data["icon"]);
				$("#schedule-result-file-name").html(data["file_name"]);
				$("#schedule-result-file-size").html(data["file_size"]);
				$("#schedule-upload-result").show();
			}
			else {
				$("#schedule-alert").removeClass();
				$("#schedule-alert").addClass("alert alert-error");
				$("#schedule-alert span").html(data["message"]);
				$("#schedule-alert").show(1000);
			}

		},
		error: function(error) {
			$("#schedule-alert").removeClass();
			$("#schedule-alert").addClass("alert alert-error");
			$("#schedule-alert span").html('<strong>Lỗi:</strong>File quá lớn hoặc không đúng định dạng, vui lòng thử lại');
			$("#schedule-alert").show(1000);
		},
		progressall: function(e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$('.progress .bar').css(
					"width",
					progress + '%'
					);
		},
		fail: function(e, data) {
			if (data.errorThrown == "abort") {
				$("#schedule-upload-result").hide();
				$("#schedule-input-file").show();
				$("#schedule-alert").hide();
				$("#schedule-file-uploaded-info").hide();
			}
			return false;
		}
	});
	//cancel upload when uploading
	$('#schedule-btn-cancel').on("click", function() {
		jqXHR.abort();
	});
	//cancel after upload
	$("#schedule-btn-remove-uploaded").on('click', function() {
		$("#schedule-upload-result").hide();
		$("#schedule-input-file").show();
		$("#schedule-alert").hide();
		$("#schedule-file-uploaded-info").hide();
		var path = $("#ScheduleFileAbsolutePath").val();
		jQuery.ajax({
			url: base_url + "admin/schedules/removeUploaded",
			type: "POST",
			data: {"path": path},
			dataType: 'json',
			success: function(data) {

			},
			error: function() {
			}
		});
	});
	//submit form  scheduler
	$("#schedule-upload-submit").on("click", function() {
		$("#ScheduleAdminAddForm").submit();
		$("#ScheduleAdminEditForm").submit();
	});

});
