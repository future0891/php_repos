<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>showChannel</title><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/table.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/admin.css"><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.excheck-3.5.js"></script><script type="text/javascript" src="__PUBLIC__/easyui/easyloader.js"></script><script type="text/javascript" src="__PUBLIC__/Js/formTree.js"></script><script type="text/javascript" src="__PUBLIC__/Js/ProductTree.js"></script><script type="text/javascript">
        var t;
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
            var p_re = "<?php echo U('Channel/showInfo?pid=');?>";
             $("#tree").ProductTree({async:{enable:true,url:p_as} , refreshPage:p_re   } );
                   
           $("#p_content").ajaxSuccess(function(){
               if(!$.isEmptyObject('.updatebtn') ) {
                   $(".delbtn").delItem();
                   $(".updatebtn").on("click",function(){
                       $("#p_content").panel("refresh" , "<?php echo U('Channel/update?id=');?>"+$(this).attr("title"));
                   });    
               }
               
               var channel = <?php echo ($channel); ?>;
                    $("#treeDemo").formTree({zNodes:channel}).expandAll(true);
                    $("#channel").click(showMenu);

           });
            
        });

        </script><script></script><style type="text/css"></style></head><body><div  id = "p_wrap" style="width:900px;height:500px;padding:10px;"><div id="p_layout" ><div data-options="region:'west',split:true" style="width:170px;padding:10px" id ="leftTree"><ul id="tree" class="ztree"></ul></div><div data-options="region:'center' , <?php if(!empty($page)): ?>href: '<?php echo U('Channel/showInfo?pid='); echo ($page); ?>'<?php endif; ?> " style="padding:10px" id="p_content">
                选择品种
            </div></div></div><div id="menuContent" class="menuContent"><ul id="tree" class="ztree" style="margin-top:0; width:160px;"></ul></div><div id="menuWrap" class="menuContent" ><ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul></div></body></html>