<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>商品添加</title><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/table.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.excheck-3.5.js"></script><script type="text/javascript" src="__PUBLIC__/easyui/easyloader.js"></script><script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.js"></script><script type="text/javascript" src="__PUBLIC__/Js/formTree.js"></script><script type="text/javascript" src="__PUBLIC__/Js/ProductTree.js"></script></head><script>             $(function(){
                easyloader.theme="bootstrap";
                
                
            using(['panel' ,'layout' ,'linkbutton'] , function(){
                $("#p_wrap").panel({title:"面板"});
                $("#p_layout").layout({fit:true});
            });

            $("#ss").on("click" , function(){
                $("#leftTree").panel("refresh");
            });
            var p_as = "<?php echo U('Channel/channelInfo');?>";
            var p_re = "<?php echo U('Product/add?pid=');?>";
             $("#tree").ProductTree({async:{enable:true,url:p_as} , refreshPage:p_re , isChannel:false   } );
             
             $("#p_content").ajaxSuccess(function(){
                 
                $("#pic").uploadify({
                    'auto':false,
                    'buttonText' : '请选择文件',
                    'swf': '__PUBLIC__/uploadify/uploadify.swf',
                    'uploader' : '<?php echo U("Product/getImage");?>',
                    'button_image_url':'__APP__',
                    'fileTypeExts' : '*.gif; *.jpg; *.png',
                    'onUploadSuccess' : function(file, data, response) {
                        var resp = "<tr><td><img src='__PUBLIC__/Upload/Thumb/s_"+data + " ' alt='无图片' /></td>";
                        resp +="<td>是否推荐<input type='checkbox'  name='recommend[]' value='1'/><input type='hidden' name='path[]' value ='" +data+"' ></td>";
                        resp +="<td><a href='#' class='delbtn' >删除</a></td></tr>";

                        $('#u_pic').append(resp);
                        $(".delbtn").linkbutton({
                            iconCls: 'icon-cancel'
                        }).click(function(){
                            var col = this;
                            $.post("<?php echo U('Product/delPic');?>" , {'pic': data} ,function(r){
                                $(col).parents("tr").remove();
                            });
                        });
                    }
                });     
                
                            
             using('linkbutton' , function(){
                 $(".pic_delbtn").linkbutton({
                     iconCls: 'icon-cancel'
                 }).click(function(){
                     var col = this;
                     $.post("<?php echo U('Product/delExistPic');?>",{'pid': $(col).attr('title')} ,function(e){
                         $(col).parents("tr").remove();
                     } );
                 });    
             });

                 
             });      

                
            });  
</script><body><div  id = "p_wrap" style="width:900px;height:722px;padding:10px;"><div id="p_layout" ><div data-options="region:'west',split:true" style="width:170px;padding:10px" id ="leftTree"><ul id="tree" class="ztree"></ul></div><div data-options="region:'center'" style="padding:10px" id="p_content" <?php if($pid != 0): ?>href="<?php echo U('Product/productInfo?pid='.$pid);?>"<?php endif; ?>  ></div></div></div></body></html>