<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>showChannel</title><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript">
        data = <?php echo ($data); ?>;
        $(function(){
            var settings = {
            data: {
                simpleData: {
                    enable: true
                }
            },
           callback: {
                onClick:showInfo
           }
            
        };
        function showInfo(event , treeId , treeNode){
            alert(treeNode.name);
        }
        $.fn.zTree.init($("#tree") , settings , data);
        });
            
        </script><style type="text/css">
            #c_wrap {
                float:left;
                position:relative;
                width:38%;
                height:500px;
                border:#0081C2 dashed 1px;
            }
            #c_content {
                float:left;
                position:relative;
                width:61%;
                height:500px;
                border-right:#0081C2 dashed 1px;
                border-top:#0081C2 dashed 1px;
                border-bottom:#0081C2 dashed 1px;
            }
        </style></head><body><div id="c_wrap"><ul id="tree" class="ztree"></ul></div><div id="c_content"><iframe id="pc" src="__APP__/Channel/add" style="height: 100%;width: 100%"></iframe></div></body></html>