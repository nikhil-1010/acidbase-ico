
$(document).on('change','#maintennance_mode',function(){
    debugger
    let mode = 0;
    if($('#maintennance_mode').is(":checked")){
        mode = 1
    }
    var data = {maintenance_mode:mode};
    postAjax(maintenanceUrl,data,async function(res){
        Toast(res.msg, 3000, res.flag);
    });
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