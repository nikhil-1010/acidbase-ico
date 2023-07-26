
$(document).on('click','#submit_forgot',function(){
    $("#submit_forgot").attr("disabled", true);
    $('#reset_password_form').ajaxForm(function (res) {
        Toast(res.msg, 3000, res.flag);
        $('#spinner_forgot').hide();
        $("#submit_forgot").attr("disabled", false);
        if (res.flag == 1) {
            base_url = $("#base_url").val();
            setTimeout(function () {
                window.location.href = base_url;
            }, 500);
        }
    }).submit();
})