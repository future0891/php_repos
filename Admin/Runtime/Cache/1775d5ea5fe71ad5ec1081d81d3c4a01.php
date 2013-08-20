<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>Document</title><link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/easyui/easyloader.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript">    	   var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        idKey: "id",
                        pIdKey: "pid",
                    }
                },
                callback: {
                    beforeClick: beforeClick,
                    onClick: onClick
                }
            };
    
            var zNodes =<?php echo ($channel); ?>;
            
            function beforeClick(treeId, treeNode) {
                var check = (treeNode && treeNode.isParent);
                if (!check) alert("只能品种...");
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
            });
    	    parent.refreshTree();   
    	</script></head><body><form action="__URL__/addProcess" method="post"><label for="">添加名字</label><input type="text" name="name" id="" /><br/><label for="">选择种类</label><input type="text" readonly="readonly" name="pname" id="channel" />&nbsp;<input type="hidden" id = "pid" name="pid" value="" /><input type="submit" id="ss" value="提交"  /></form><div id="menuContent" class="menuContent" style="display:none; position: absolute;z-index: 999"><ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul></div></body></html>