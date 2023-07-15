
<footer class="p-4 mt-auto border-top border-secondary position-sticky bottom-0">
                <div class="container-fluid">
                    <div class="d-flex flex-wrap gap-3 align-items-center justify-content-between">
                        <h6 class="text-white m-0 fw-light">{{config('constant.PLATFORM_NAME')}} © All rights reserved. {{date('Y')}}</h6>
                        <div class="d-flex align-items-center gap-4 ms-auto">
                            <a target="_blank" href="https://www.facebook.com"><i
                                    class="fa-brands fa-facebook-f text-secondary fs-6"></i></a>
                            <a target="_blank" href="https://www.instagram.com"><i
                                    class="fa-brands fa-instagram text-secondary fs-6"></i></a>
                            <a target="_blank" href="https://www.linkedin.com"><i
                                    class="fa-brands fa-linkedin-in text-secondary fs-6"></i></a>
                            <a target="_blank" href="https://www.twitter.com"><i
                                    class="fa-brands fa-twitter text-secondary fs-6"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


</body>
<!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script src="{{url('assets/js/admin_app.min.js')}}"></script>
<?php
if (isset($footer['js'])) {
    for ($i = 0; $i < count($footer['js']); $i++) {
        if (strpos($footer['js'][$i], "https://") !== FALSE || strpos($footer['js'][$i], "http://") !== FALSE)
            echo '<script type="text/javascript" src="' . $footer['js'][$i] . '"></script>';
        else
            echo '<script type="text/javascript" src="' . \URL::to('/assets/js/' . $footer['js'][$i]) . '"></script>';
    }
}
?>
@yield('footer')

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>

</html>