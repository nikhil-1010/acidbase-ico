filterData(url,'whitelist-table');
function emptyModal(){
  $("#add_food_form")[0].reset();
  $("#id").val('');
  $(".pip").remove();
  $("#category_id option:selected").prop("selected",false);
  $('#category_id option:contains("All menu items")').prop("selected",true);
  $("#btn_food").html('Add <span id="spinner" style="display:none"><i class="fa fa-spinner fa-spin"></i></span>');
}
function _search(){
   var category_id=$("#filter_category_id").val();
   var name=$("#filter_name").val();
   var search_match=$("#search_match").val();
   var meta_title=$("#filter_meta_title").val();
   var meta_description=$("#filter_meta_description").val();
   var meta_keywords=$("#filter_meta_keywords").val();
   
   filters.category_id = category_id;
   filters.name = name;
   filters.search_match = search_match;
   filters.meta_title = meta_title;
   filters.meta_description = meta_description;
   filters.meta_keywords = meta_keywords;
   filters.currentPage = 1;
   filterData(url,'whitelist-table');
    
}
$("#filter_name_search").keyup(function(){
  filters.name = this.value;
  filters.currentPage = 1;
  filterData(url,'whitelist-table');
});
$(document).on('click','#name-sort',function(){
    if(typeof filters.sort == "undefined"){
      console.log('fist');
      filters.sort= "asc";
    }else{
      if(filters.sort =="desc"){
        filters.sort = "asc";
      }else{
        filters.sort = "desc";
      }
  }
  filterData(url,'whitelist-table');
})
// function _search_name(val)
// {
//   debugger
//   // var name=$("#filter_name").val();
//   filters.name = val;
//   filters.currentPage = 1;
//   filterData(url,'whitelist-table');
// }
function _reset(){
   $('#filter_category_id,#filter_name,#filter_meta_description,#filter_meta_title,#filter_meta_keywords').val('');
   filters.category_id = '';
   filters.name = '';
   filters.meta_title = '';
   filters.meta_description = '';
   filters.meta_keywords = '';
   filterData(url,'whitelist-table');
}


