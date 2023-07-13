tinymce.init({
	selector: '#editor',
	menubar: false,
	statusbar: false,
	plugins: 'autoresize anchor autolink charmap code codesample directionality fullpage help hr image imagetools insertdatetime link lists media nonbreaking pagebreak preview print searchreplace table template textpattern toc visualblocks visualchars',
	toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help fullscreen ',
	skin: 'bootstrap',
	toolbar_drawer: 'floating',
	min_height: 200,
	autoresize_bottom_margin: 16,
	setup: (editor) => {
		editor.on('init', () => {
			editor.getContainer().style.transition = "border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out"
		});
		editor.on('focus', () => {
			editor.getContainer().style.boxShadow = "0 0 0 .2rem rgba(0, 123, 255, .25)",
				editor.getContainer().style.borderColor = "#fff"
		});
		editor.on('blur', () => {
			editor.getContainer().style.boxShadow = "",
				editor.getContainer().style.borderColor = ""
		});
	}
});

$(document).on('change', '#site_page', function () {
	getContent();
})
$(document).on('click', '#save_content_btn', function () {
	content_page = $("#site_page").val();
	content = $("#editor").text();
	content = tinyMCE.activeEditor.getContent({format: "text"});
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
				tinyMCE.activeEditor.setContent(res.data)
			} else {
				tinyMCE.activeEditor.setContent('')
			}
		} else {
			Toast(res.msg, 3000, res.flag);
		}
	});
}
getContent();