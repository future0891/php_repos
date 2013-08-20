<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>Document</title></head><link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/easyui/easyloader.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript">        $(function(){
            easyloader.theme = "bootstrap";
            $(".delbtn").click(function(){
               if(!confirm("该操作不可逆,是否删除!")) {
                   return false;
               }
            });
        });
        parent.refreshTree();
    </script><style type="text/css">table {
    margin-top:15px;
    margin-left:30px;
    font-size:12px;
    border-top:1px solid #999;
    border-left:1px solid #999;
    padding:0px;
}


table tr td {
    padding:6px;
    padding-right:0px;
    border-right:1px solid #999;
    border-bottom:1px solid #999;

}

table thead td{
    background:#336d9b;
    color:#fff;
    margin:0px;
}    
.oddClm {
    background-color: #5FC6DA;
}
</style><body><table width="580" cellspacing="0" cellPadding="0" class="listTable"><thead><tr><td>编号</td><td>名称</td><td>操作</td></tr></thead><tbody><?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr <?php if(($mod) == "1"): ?>class ="oddClm"<?php endif; ?> ><td><?php echo ($vo["id"]); ?></td><td><?php echo ($vo["name"]); ?></td><td><a href="__URL__/update/id/<?php echo ($vo["id"]); ?>" class="easyui-linkbutton" data-options="iconCls:'icon-edit'">更新</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="__URL__/delete/id/<?php echo ($vo["id"]); ?>"  class="easyui-linkbutton delbtn" data-options="iconCls:'icon-remove'">删除</a></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody><tfoot></tfoot></table></body></html>