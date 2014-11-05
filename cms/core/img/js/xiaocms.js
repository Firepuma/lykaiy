function omnipotent(id, linkurl, title, close_type, w, h) {
    if (!w) w = 550;
    if (!h) h = 385;
    art.dialog.open(linkurl, {
        id: id,
        title: title,
        width: w,
        height: h,
        lock: true,
        fixed: true,
        background:"#CCCCCC",
        opacity:0,
        button: [{
            name: '确定',
            callback: function () {
                if (close_type == 1) {
                    return true;
                } else {
                    var d = this.iframe.contentWindow;
                    var form = d.document.getElementById('dosubmit');
                    form.click();
                }
                return false;
           },
           focus: true
        }]
    });
}

function remove_relation(sid, id, name) {
	var relation_ids = $('#'+name).val();
	if(relation_ids !='' ) {
		$('#'+sid).remove();
		var r_arr = relation_ids.split(',');
		var newrelation_ids = '';
		$.each(r_arr, function(i, n){
			if(n!=id) {
				if(i==0) {
					newrelation_ids = n;
				} else {
				    newrelation_ids = newrelation_ids+','+n;
				}
			}
		});
		$('#'+name).val(newrelation_ids);
	}
}

function showImg(_this) {
	if(!_this.value) return false; 
      $("body").append("<div id='Previewthumb' style='position: absolute; z-index:2; '><img src=" + _this.value + " style='max-width:450px;min-width:150px;border:2px #ccc solid;'></div>");
      $("#"+_this.id).mousemove(function(e){
      $("#Previewthumb").css({
          "top" :(e.pageY+5) + "px",
          "left" :(e.pageX+2) + "px"
          });
      });
}

function hideImg(_this) { 
	$("#Previewthumb").remove();
}

function confirmurl(url,message) {
	if(confirm(message)) redirect(url);
}

function redirect(url) {
	location.href = url;
}

function get_kw() {
	$.post('../index.php?c=api&a=ajaxkw&id='+Math.random(), { data:$('#title').val() }, function(data){ 
        if(data && $('#keywords').val()=='') $('#keywords').val(data); 
	});
}

function removediv(fileid) {
	$('#files_'+fileid).remove();
}

function add_null_file(obj) {
    var id= parseInt(Math.random()*1000);
    var c = '<li id="files_'+id+'">';
	c += '<input type="text" class="input-text" style="width:310px;" value="" name="data['+obj+'][fileurl][]">';
	c +='<input type="text" class="input-text" style="width:160px;" value="" name="data['+obj+'][filename][]">';
	c += '<a href="javascript:removediv(\''+id+'\');">删除</a></li>';
	$('#'+obj+'-sort-items').append(c);
}


function htmlList(obj,data,file,p){
    var id= parseInt(Math.random()*1000);
    var html = '<li id="files_'+id+'">';
	html += '<input type="text" class="input-text" style="width:310px;" value="' + data + '" name="data['+obj+'][fileurl][]" '+ p +'>';
	html +='<input type="text" class="input-text" style="width:160px;" value="' + file.name + '" name="data['+obj+'][filename][]">';
	html += '<a href="javascript:removediv(\''+id+'\');">删除</a></li>';
	$('#'+obj+'-sort-items').append(html);
}

function setC() {
	if($("#deletec").attr('checked')==true) {
		$(".deletec").attr("checked",true);
	} else {
		$(".deletec").attr("checked",false);
	}
}

function confirm_delete(){
	$('#list_form').val('del'); 
	if(confirm('确认删除吗？')) $('#myform').submit();
}