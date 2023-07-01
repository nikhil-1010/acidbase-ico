var filters = {
    totalItems: 0,
    itemPerPage: 50,
    currentPage: 1,
    totalPages: 1,
};
var multipleFilter = [];
function changeRecordPerPage(url,table){
    var id = '';
    if(typeof table !== 'undefined'){
        id = '-'+table;
    }
    var recPp = $('#recordPerPage'+id).val();
    if(recPp == '' || recPp <= 0){
        Toast('Please select valid page limit');
        return false;
    }
    filters.currentPage = 1;
    filters.itemPerPage = recPp;
    
    if(typeof table === 'undefined'){
        table = 'vtable';
    }
    filterData(url,table);
}

function filterData(url,table){
    var token = $("#token").val();
    filters._token=token;
    
    if(typeof table === 'undefined'){
        table = 'vtable';
    }
    var flush = 1;
    if(typeof multipleFilter[table] !== 'undefined' && typeof multipleFilter[table]['filters'] !== 'undefined'){
        flush = 0;
        $.each(multipleFilter[table]['filters'],function(k,v){
            if(typeof filters[k] === 'undefined'){
                filters[k] = v;
            }
        });
    }else{
        multipleFilter[table] = {};
    }
    
    var jdata = filters;
    filter_url = url;

    $.ajax({
        type:'POST',
        url:url,
        // dataType: 'json',
        data:jdata,
        // contentType: "application/json",
        // async:false,
        success: function(res){
            if(res.flag === 0){
                console.log(res);
            }else{
                $("#"+table).html(res.blade);
                filters.totalItems = res['total_record'];
                filters.totalPages = filters.totalItems > 0 ? Math.ceil(filters.totalItems / filters.itemPerPage) : 0;
                setPagination(table);
            }
            
            multipleFilter[table]['filters'] = filters;
            multipleFilter[table]['filter_url'] = filter_url;
            //flushFilters(flush);
        }, 
    });
}
function flushFilters(keep){
	
    if(keep){
        filters = {
            totalItems: 0,
            itemPerPage: filters.itemPerPage,
            currentPage: 1,
            totalPages: 1
        };
    }else{
        filters = {};
    }
}
function prevPage(cp,tp,t){
    var p = 1;
    if(t){
        p = cp + 1 < tp ? cp + 1 : tp > 0 ? tp : 1;
    }else{
        p = cp - 1 > 0 ? cp - 1 : 1;
    }
    
    return p;
}

function nextDigit(cp,tp,t){
    if(t){
        for(i=cp;i<=tp;i++){
            if(i%7 == 0){
                return i;
            }
        }
        return tp;
    }else{
        for(i=cp;i>0;i--){
            if(i%7 == 0){
                return i;
            }
        }
        return 1;
    }
    
}
function setPagination(table){
    var tp = filters.totalPages;
    var cp = filters.currentPage;
    var base_url=$("#base_url").val();

    var p = prevPage(cp,tp,0);
    var li = '';
    var pp = '<div class="theme-pagination-box "><div class="theme-pagination-prev page_no" data-page="'+p+'" data-type="p"  data-table="'+table+'" ><span><img src="'+base_url +'public/assets/images/icon/arrowhead-left.png" alt=""> Previous</span></div><div class="pagination-item "><ul>';
    var p = prevPage(cp,tp,1);
    var np = ' </ul></div><div class="theme-pagination-next page_no" data-page="'+p+'" data-type="n"  data-table="'+table+'" ><span>Next <img src="'+base_url+'public/assets/images/icon/arrowhead-right.png" alt=""></span></div></div>';
    var ns = '';
    var ps = '';
    var prev = cp - 7;
    var next = cp + 7;
    var pflag = 1;
    var nflag = 1;
    if(prev < 0){
        pflag = 0;
    }
    if(next > tp){
        pflag = 0;
    }
    if(tp < 7){
        for(i = 1;i<=tp;i++){
            li+='<li href="#" data-page="'+i+'" data-type="'+i+'"  data-table="'+table+'" class="page_no" ><span>'+i+'</span></li>';
        }
    }else{
        var nd = nextDigit(cp,tp,1);
        var dp = nextDigit(cp,tp,0);
        if(nd<tp){
          ns='<li href="#" data-page="'+(nd+1)+'" data-type="'+(nd+1)+'"  data-table="'+table+'" class="page_no" ><span>...</span></li>';
        }
        
        if(dp == nd){
            dp = (nd-7) > 0 ? (nd-7) : 1;
        }
		if(dp>1){
            ps='<li href="#" data-page="'+(dp-1)+'" data-type="'+(dp-1)+'"  data-table="'+table+'" class="page_no" ><span>...</span></li>';
        }
        
        
        
        for(i=dp;i<=nd;i++){
            li +='<li href="#" data-page="'+i+'" data-type="'+i+'"  data-table="'+table+'" class="page_no" ><span>'+i+'</span></li>';
        }
    }
    
    li = pp+ps+li+ns+np;
    var cls1 = '';
    var cls2 = '';
    if($('.pagination').hasClass(table)){
        cls1 = '.'+table;
        cls2 = '.'+table;
    }
    
    $(cls1+'.pagination').html(li);

    $(cls1+' .page_no').each(function(){
        var tp = $(this).data('type');
        if(tp == cp){
            $(this).addClass('active');
        }
    });
    
    if(cp == 1){
        $(cls2+'.pagination a:first-child').removeClass('page_no').addClass('pagination-disable');
        $(cls2+'.pagination a:nth-child(2)').removeClass('page_no').addClass('pagination-disable');
    }
    if(cp == tp){
        $(cls2+'.pagination a:last-child').removeClass('page_no').addClass('pagination-disable');
        $(cls2+'.pagination a:nth-last-child(2)').removeClass('page_no').addClass('pagination-disable');
    }
    
    // if(tp == 0){
    //     $('.pagination').hide();
    // }
}


function Toast(val, time, flag) {
    $('#toast').remove();
    var id = "toast";
    var noti_html = document.createElement('div');
    var att = document.createAttribute("id");
    att.value = "toast";
    noti_html.setAttributeNode(att);
    var f_class = "";
    if (flag == 1) {
        f_class = "bg-success";
        strong = 'SUCCESS';
    }
    else if(flag == 0){
        f_class = "bg-danger";
        strong = 'ERROR';
    }
    else{
        f_class = "bg-warning";
        strong = 'WARNING';
    }
    msg = `<div class="toast-container position-fixed bottom-0 end-0 p-3" id="toast">
                <div class="toast align-items-center show `+f_class+` text-white border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex"><div class="toast-body">`+val+`</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    </div>
                    </div>`
    // msg = '<div class="oaerror '+f_class+'"><strong>'+strong+'</strong>  - '+val +'<div>';
    $('body').append(noti_html);
    $(noti_html).html(msg);
    var x = document.getElementById("toast");

    if (typeof time == 'undefined' || time == null) {
        time = 30000000;
    }
    setTimeout(function() {
        x.className = x.className.replace("show-msg", "");
        $('#toast').remove();
        time == null;
        setTimeout(() => {
            $('#toast').remove();
        }, 1000);
    }, time);
}


function getBaseURL(){
    var url = $("#base_url").val();
    return url;
}

function postAjax(url,data,cb){
    var token = $("#token").val();
    var jdata = {_token:token};
    
    for(var k in data){
        jdata[k]=data[k];
    }
    
    $.ajax({
        type:'POST',
        url:url,
        data:jdata,
        success: function(data){
            if(typeof(data)==='object'){
                if(data.flag==8){
                    window.location.replace("{{URL::to('login')}}");
                }
                cb(data);
            }
            else{
                cb(data);
            }
        }, 
    });
}

function getAjax(url,data,cb){
    var token = $("#token").val();
    var jdata = {_token:token};
    
    for(var k in data){
        jdata[k]=data[k];
    }
    
    $.ajax({
        type:'GET',
        url:url,
        data:jdata,
        dataType:'JSON',
        success: function(data){
            if(typeof(data)==='object'){
                if(data.flag==8){
                    window.location.replace("{{URL::to('login')}}");
                }
                cb(data);
            }
            else{
                cb(data);
            }
        }, 
    });
}

function number_format(value){
    var vall = value;
    value =value.toString();
    if(value.indexOf('.') > -1){
        var vlaues = parseFloat(value).toFixed(8).split('.');
        var floatValue=parseFloat(vlaues[1]);
        // console.log(floatValue);
        if(floatValue > 0){
            var val = vlaues[1].rtrim();
            // console.log(val);
            if(val.length > 8){
                return parseFloat(vall).toFixed(8);
            }else{
                return vlaues[0] + "." + val;
            }
        }else{
            return vlaues[0];
        }
    }else{
        return value;
    }
}
String.prototype.rtrim = function() {
    var trimmed = this.replace(/0+$/g, '');
    return trimmed;
};

function Clock(countdown, callback) {
	countdown = countdown ? new Date(Date.parse(countdown)) : false;
	callback = callback || function () { };

	var updateFn = getTimeRemaining;

	this.el = document.createElement('div');
	this.el.className = 'flip-clock';

	var trackers = {},
		t = updateFn(countdown),
		key, timeinterval;

	for (key in t) {
		if (key === 'Total') { continue; }
		trackers[key] = new CountdownTracker(key, t[key]);
		this.el.appendChild(trackers[key].el);
	}

	var i = 0;
	function updateClock() {
		timeinterval = requestAnimationFrame(updateClock);

		// throttle so it's not constantly updating the time.
		if (i++ % 10) { return; }

		var t = updateFn(countdown);
		if (t.Total < 0) {
			cancelAnimationFrame(timeinterval);
			for (key in trackers) {
				trackers[key].update(0);
			}
			callback();
			return;
		}

		for (key in trackers) {
			trackers[key].update(t[key]);
		}
	}

	setTimeout(updateClock, 500);
}