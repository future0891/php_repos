<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>商品添加</title><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.js"></script></head><script>           var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        idKey: "id",
                        pIdKey: "pid",
                        root:-1
                    }
                },
                callback: {
                    beforeClick:beforeClick,
                    onClick: onClick
                }
            };
    
            var zNodes =<?php echo ($channel); ?>;
            

            function beforeClick(treeId, treeNode) {
                var check = (treeNode && !treeNode.isParent);
                if (!check) alert("只能选择种类...");
                return check;
            }           
            function onClick(e, treeId, treeNode) {
                var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
                nodes = zTree.getSelectedNodes(),
                v = nodes[0].name;
                var cObj = $("#channel");
                cObj.attr("value", v);
                $("#pid").attr("value" , nodes[0].id);
            }
    
            function showMenu() {
                var cObj = $("#channel");
                var cOffset = $("#channel").offset();
                $("#menuContent").css({left:cOffset.left + "px", top:cOffset.top + cObj.outerHeight() + "px"}).slideDown("fast");
                $("body").bind("mousedown", onBodyDown);

            }
            function hideMenu() {
                $("#menuContent").fadeOut("fast");
                $("body").unbind("mousedown", onBodyDown);
            }
            function onBodyDown(event) {
                if (!(event.target.id == "menuBtn" || event.target.id == "menuContent" || $(event.target).parents("#menuContent").length>0)) {
                    hideMenu();
                }
            } 
             $(function(){
                var t = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
                t.expandAll(true);
                $("#channel").click(showMenu );
                
                
                $("#pic").uploadify({
                    'buttonText' : '请选择文件',
                    'swf': '__PUBLIC__/uploadify/uploadify.swf',
                    'uploader' : '__URL__/addProcess',
                    'button_image_url':'__APP__',
                });
            });  
</script><body><form action="" method="get" ><label>商品名称:</label><input type="text" name="" id="" /><br/><label>商品种类:</label><input type="text" name="" id="channel" /><br/><input type="file" name="pic" id="pic" /><input type="submit" value="提交"/></form><div id="menuContent" class="menuContent" style="display:none; position: absolute;background-color: #5FC6DA"><ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul></div></body></html>