meunuSelectedId = 0;
menuSelectedTitle = '';
function openKCFinder_singleFile(div) {
	//alert('click');return false;
	window.KCFinder = {
		callBack: function(url) {
			window.KCFinder = null;
			div.innerHTML = '<div style="margin:5px">Đang tải ảnh...</div>';
			var img = new Image();
			img.src = url;
			img.onload = function() {
				base_url_str = url.replace(base_url + 'app/webroot', '');
				div.innerHTML = '<img id="img" src="' + base_url_str + '" />';
				//$("#image_path").val(base_url_str);
				var thumbnail = document.getElementById('post-thumbnail');
				thumbnail.value = base_url_str;
				var img = document.getElementById('img');
				img.style.visibility = "visible";
			};
		}
	};
	window.open(base_url + 'app/webroot/js/ckeditor/kcfinder/browse.php?type=images&dir=images',
			'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
			'directories=0, resizable=1, scrollbars=0, width=800, height=600'
			);
}
//posts filter
$("#admin-posts-filter").on("change", function() {
	$("#admin-form-posts-filter").submit();
});

//Choose menu
$("#MenuMenuType").on("change", function() {
	var type = $(this).val();
	var menuItem = menus[type];
	//console.log(menus[type]);return false;
	if (menuItem['menu_action'] != '') {
		var ajaxUrl = base_url + 'admin/menus/' + menuItem['menu_action'];
		$.get(ajaxUrl, function(data) {
			$("#menu-modal .modal-body").html(data);
			$("#menu-modal .modal-header h3").html('Chọn danh mục cho menu');
			loadDataTable();
			$("#menu-modal").modal();
			getMenuSelected();
		});
	} else {
		menuSelectedTitle = menus[type]['title'];
		meunuSelectedId=0;
		$("#MenuContent").val(menuSelectedTitle);
		$("#MenuExt").val(0);
	}

//		} else if (type == 3) {
//			$("#MenuContent").val('Album ảnh');
//		} else if (type == 4) {
//			$("#MenuContent").val('Video');
//		}
	//}
});

$('#menu-modal').on('hidden.bs.modal', function() {
	var menuContent = '';
	var menuType = $("#MenuMenuType").val();
	menuContent += menus[menuType]['title'] + ' : ' + menuSelectedTitle;
	$("#MenuContent").val(menuContent);
	$("#MenuExt").val(meunuSelectedId);
});

function getMenuSelected() {
	$(".menu-check-item").on('click', function() {
		var id = $(this).val();
		$(this).prop('checked', true);
		$td = $(this).parent();
		$tdTitle = $td.siblings('.select-name');
		menuSelectedTitle = $tdTitle.html();
		meunuSelectedId = id;
		$(".menu-check-item").each(function() {
			var iid = $(this).val();
			if (iid != id) {
				$(this).prop('checked', false);
			}
		});
	});
}

function loadDataTable() {
	$('.table-data').dataTable({
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sLengthMenu": "_MENU_ dòng mỗi trang",
			"sInfo": "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",
			"sNext": "Trang sau",
			"sPrevious": "Trang trước",
			"sInfoFiltered": "",
			"sEmptyTable": "Không có dữ liệu",
		}
	});
}
