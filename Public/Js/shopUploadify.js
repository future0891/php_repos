(function($){
	$.fn.shpUploadify = function(){
		var settings = $.extend({
                'auto':false,
                'buttonText' : '请选择文件',
                'swf': '__PUBLIC__/uploadify/uploadify.swf',
                'uploader' : '__URL__/getImage',
                'button_image_url':'__APP__',
                'fileTypeExts' : '*.gif; *.jpg; *.png',
                'onUploadSuccess' : function(file, data, response) {
                    var resp = "<tr><td><img src=__PUBLIC__/Upload/Thumb/s_"+data + "  alt='无图片' /></td>";
                    resp +="<td>是否推荐<input type='checkbox'  name='recommend' value='1'/><input type='hidden' name='path[]' value ='" +data+"' ></td>";
                    resp +="<td><a href='#' class='delbtn' >删除</a></td></tr>";

                    $('#u_pic').append(resp);
                    $(".delbtn").linkbutton({
                        iconCls: 'icon-cancel'
                    }).click(function(){
                        var col = this;
                        $.post('__URL__/delPic' , {'pic': data} ,function(r){
                            $(col).parents("tr").remove();
                        });
                    });
                }} , opts||{});
         $(this).uploadify(settings)
		
	}	
})(jQuery)
