function general_save() {
    
}

$(document).on('click','#change_password_btn',function(){
    $('#change_password_btn').prop('disabled',true);
    $('#change_password_form').ajaxForm(function(res) {
        Toast(res.msg, 3000, res.flag);
        if(res.flag == 1) {
            $('#change_password_form').reset();
        }
      $('#change_password_btn').prop('disabled',false);
    }).submit();
})
$(document).on('click','#update_profile_btn',function(){
    $('#update_profile_btn').prop('disabled',true);
    $('#update_profile_form').ajaxForm(function(res) {
        Toast(res.msg, 3000, res.flag);
        $('#update_profile_btn').prop('disabled',false);
        setTimeout(() => {
            location.reload();
        }, 2000);
    }).submit();
})