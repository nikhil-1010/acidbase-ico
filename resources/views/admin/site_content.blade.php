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
    
    <div class="md-form-group float-label ">
       <input type="text" class="md-input" name="email_broadcas" id="site_content_ck" />
    </div>

    <button type="button" id="save_content_btn" class="btn btn-lg gradient-btn text-white text-uppercase float-end rounded-pill mt-3">Update</button>
</div>
@endsection
@section('footer')
<script>
     CKEDITOR.replace('site_content_ck', {
       removePlugins: 'save'
   });
</script>
@stop