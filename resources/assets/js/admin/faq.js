filters.currentPage = 1;
filters.itemPerPage = 10;
filterData(url, 'faq-table');
function emptyModal() {
    $("#add_food_form")[0].reset();
    $("#id").val('');
    $(".pip").remove();
    $("#category_id option:selected").prop("selected", false);
    $('#category_id option:contains("All menu items")').prop("selected", true);
    $("#btn_food").html('Add <span id="spinner" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>');
}

$('#add_faq_modal').click(function () {
    $('#add_faq').modal('show');
})

$(document).on('click', '#add-faq-btn', function () {
    $("#spinner").show();
    $("#add-faq-btn").attr('disabled', true);
    $('#add_faq_form').ajaxForm(function (res) {
        Toast(res.msg, 3000, res.flag);
        if (res.flag == 1) {
            $('#add_faq').modal('hide');
            filterData(url, 'faq-table');
        }
        $("#spinner").hide();
        $("#add-faq-btn").attr('disabled', false);
    }).submit();
})
function updateFaq(id,query,content,sort_order){
    $("#add-faq-btn").text('Update Faq');
    $("#faq_label").text('Update Faq');
    $('#update_id').val(id);
    $('#query').val(query);
    $('#content').text(content);
    $('#sort_order').val(sort_order);
    $('#add_faq').modal('show');

}

function _search() {
    var category_id = $("#filter_category_id").val();
    var name = $("#filter_name").val();
    var search_match = $("#search_match").val();
    var meta_title = $("#filter_meta_title").val();
    var meta_description = $("#filter_meta_description").val();
    var meta_keywords = $("#filter_meta_keywords").val();

    filters.category_id = category_id;
    filters.name = name;
    filters.search_match = search_match;
    filters.meta_title = meta_title;
    filters.meta_description = meta_description;
    filters.meta_keywords = meta_keywords;
    filters.currentPage = 1;
    filterData(url, 'faq-table');

}
$("#filter_name_search").keyup(function () {
    filters.name = this.value;
    filters.currentPage = 1;
    filterData(url, 'faq-table');
});
$(document).on('click', '#name-sort', function () {
    if (typeof filters.sort == "undefined") {
        console.log('fist');
        filters.sort = "asc";
    } else {
        if (filters.sort == "desc") {
            filters.sort = "asc";
        } else {
            filters.sort = "desc";
        }
    }
    filterData(url, 'faq-table');
})
// function _search_name(val)
// {
//   debugger
//   // var name=$("#filter_name").val();
//   filters.name = val;
//   filters.currentPage = 1;
//   filterData(url,'faq-table');
// }
function _reset() {
    $('#filter_category_id,#filter_name,#filter_meta_description,#filter_meta_title,#filter_meta_keywords').val('');
    filters.category_id = '';
    filters.name = '';
    filters.meta_title = '';
    filters.meta_description = '';
    filters.meta_keywords = '';
    filterData(url, 'faq-table');
}

function displayRecordForUpdate(id, category_id, name, title, meta_description, keywords, images, description, search_matches) {
    console.log(id, category_id, name, title, description, keywords, images)
    $("#id").val(id);
    $('#images').val('');
    $("#name").val(name);
    $(".pip").remove();
    $("#category_id").val(category_id);
    $("#meta_title").val(title);
    $("#meta_description").val(meta_description);
    $("#meta_keywords").val(keywords);
    $("#description").val(description);
    $("#search_matches").val(search_matches);
    $("#btn_food").html('Update <span id="spinner" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>')
    var images = JSON.parse(images);
    var listing = "";
    var i = 0
    $.each(images, function (index, item) {
        console.log(item);
        listing += "<span class='pip' id='" + i + "'>" +
            "<img class='imageThumb' src='" + item + "'/>" +
            "<br/><span class='remove' onclick='removeImage(`" + i + "`,`" + id + "`)' >Remove image</span>" +
            "</span>";
        i++;
    });


    var data = {};
    postAjax(category_url, data, async function (res) {
        if (res.flag == 1) {
            options = '';
            response = res.data;
            console.log(response);
            for (i = 0; i < response.length; i++) {
                flag = category_id.includes(response[i]['id']);
                console.log('category_id : ', response[i]['id']);
                console.log('flag : ', flag);
                if (flag == 1) {
                    select = "selected";
                } else {
                    select = "";
                }
                options += '<option value="' + response[i]['id'] + '" ' + select + '>' + response[i]['name'] + '</option>'
                console.log(options);
                // return true;
            }
            console.log('===options===');
            console.log(options);
            $('#category_id').html(options);
        }
    });
    $(".gallery").html(listing);
}
function removeImage(index, id) {
    // ajaxPost()
    var data = { id: id, index: index };
    postAjax(remove_image_url, data, function (res) {
        Toast(res.msg, 3000);
        $("#" + index).remove();
        console.log($('#images').val());
    });
}
function addFood() {
    $("#spinner").show();
    $("#btn_food").attr('disabled', true);
    $('#add_food_form').ajaxForm(function (res) {
        Toast(res.msg, 3000, res.flag);
        if (res.flag == 1) {
            $('.close').trigger('click');
            $('.close').trigger('click');
            filterData(url, 'faq-table');
        }
        $("#spinner").hide();
        $("#btn_food").attr('disabled', false);
    }).submit();
}

function deleteRecord() {
    $('#delete_form').ajaxForm(function (res) {
        Toast(res.msg, 3000, res.flag);
        if (res.flag == 1) {
            filterData(url, 'faq-table');
            $('.close').trigger('click');
            $('.close').trigger('click');
        }
    }).submit();
}
function displayRecordForDelete(id, type) {
    $("#delete_id").val(id);
    $("#type").val(type);
}

$("#images").on("change", function (e) {
    var files = e.target.files,
        filesLength = files.length;
    console.log(filesLength);
    $(".pip").remove();

    for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function (e) {
            var file = e.target;
            console.log(file);
            $("<span class='pip' data-id='" + i + "'>" +
                "<img class='imageThumb' src='" + e.target.result + "' title='" + file.name + "'/>" +
                "<br/><span class='remove' >Remove image</span>" +
                "</span>").insertAfter(".gallery");
            $(".remove").click(function () {
                console.log('remove....');
                $(this).parent(".pip").remove();

                // var id = $(this).parent(".pip").data('id');
                // var input = '<input name="delete[]" type="hidden" value="'+ id +'" >';
                // $('#add_food_form').append(input);
            });
        });
        fileReader.readAsDataURL(f);
    }
});



