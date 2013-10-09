<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>Document</title><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/table.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/admin.css"><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.excheck-3.5.js"></script><script type="text/javascript" src="__PUBLIC__/easyui/easyloader.js"></script><script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.js"></script><script type="text/javascript" src="__PUBLIC__/Js/formTree.js"></script><script type="text/javascript" src="__PUBLIC__/Js/ProductTree.js"></script><script type="text/javascript">         var t;
        $(function(){
            easyloader.theme = "bootstrap";
            using(['panel' ,'layout'] , function(){
                $("#p_wrap").panel({title:"面板"});
                $("#p_layout").layout({fit:true});
            });

            $("#ss").on("click" , function(){
                $("#leftTree").panel("refresh");
            });

            var p_as = "<?php echo U('Channel/channelInfo');?>";
            var p_re = "<?php echo U('Product/addAtt?pid=');?>"; 
            $("#tree").ProductTree({ 
                async:{enable:true,url:p_as} , 
                refreshPage:p_re,
                isChannel:false 
             });
            
            
            $("#p_content").ajaxSuccess(function(event, xhr, settings) {
                using('linkbutton' , function(){
                   $('.attr_update').linkbutton({
                        iconCls: 'icon-edit'    
                   });
                   
                   $('.attr_del').linkbutton({
                       iconCls: 'icon-cancel'    
                   }).click(function(){
                       var col = this;
                       var pid = $(this).attr("title");
                       $.post("<?php echo U('Product/attr_delete');?>" , {'pid':pid} , function(data){
                           if(!data) {
                               alert("删除失败")
                           } else {
                               $(col).parents("tr").remove();
                           }
                           
                       } );
                       
                   });
                   
                });
            });

            
            
        })
        </script></head><body><div  id = "p_wrap" style="width:900px;height:700px;padding:10px;"><div id="p_layout" ><div data-options="region:'west',split:true" style="width:170px;padding:10px" id ="leftTree"><ul id="tree" class="ztree"></ul></div><div data-options="region:'center'" style="padding:10px" id="p_content" <?php if(!empty($flag)): ?>href="<?php echo U('Product/addAtt');?>"<?php endif; ?> ></div></div></div><div id="menuContent" class="menuContent"><ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul></div></body></html>