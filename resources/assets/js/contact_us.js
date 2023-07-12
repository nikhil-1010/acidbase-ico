$(document).on('click', '#contact-btn', function () {
    $("#spinner").show();
    $("#contact-btn").attr('disabled', true);
    $('#contact_form').ajaxForm(function (res) {
        Toast(res.msg, 3000, res.flag);
        if (res.flag == 1) {
            $('#contact_form')[0].reset();
        }
        $("#spinner").hide();
        $("#contact-btn").attr('disabled', false);
    }).submit();
})