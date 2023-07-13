@extends('layout.admin')
@section('content')
<input type="hidden" id="base_url" value="{{url('')}}">
<div class="p-4 p-md-5">

    <div class="form-floating mb-3">
        <select class="form-select bg-transparent" id="site_page" aria-label="Floating label select example">
            <option value="about_us">About Us</option>
            <option value="terms">Terms</option>
            <option value="privacy_policy">Privacy Policy</option>
        </select>
        <label for="floatingSelect">Works with selects</label>
    </div>

    <textarea id="editor"></textarea>

    <button type="button" id="save_content_btn" class="btn btn-lg gradient-btn text-white text-uppercase w-100 rounded-pill mt-3">Update</button>
</div>
@endsection
@section('footer')
<script>
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
    // tinymce.activeEditor.execCommand('mceInsertContent', false, "some text");
</script>
@stop