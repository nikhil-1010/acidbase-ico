
$(document).on('change', '#site_page', function () {
	getContent();
})
$(document).on('click', '#save_content_btn', function () {
	content_page = $("#site_page").val();
	content = $("#editor").text();
	content = CKEDITOR.instances.site_content_ck.getData();
	console.log(content);
	set_content_url = $('#base_url').val() + '/admin/set-content'
	postAjax(set_content_url, { 'name': content_page, 'content': content }, function (res) {
		Toast(res.msg, 3000, res.flag);
	});

})

function getContent() {
	content_page = $("#site_page").val();
	get_content_url = $('#base_url').val() + '/admin/get-content'
	postAjax(get_content_url, { 'name': content_page }, function (res) {
		if (res.flag == 1) {
			if (res.data != null) {
				debugger
				CKEDITOR.instances.site_content_ck.setData(res.data);
				// tinyMCE.activeEditor.setContent(res.data)
			} else {
				CKEDITOR.instances.site_content_ck.setData('');
				// tinyMCE.activeEditor.setContent('')
			}
		} else {
			Toast(res.msg, 3000, res.flag);
		}
	});
}
getContent();