<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>list</title><meta name="author" content="Administrator" /></head><link  rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"/><link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/easyui/easyloader.js"></script><script type="text/javascript">
        $(function(){
            var result = false;
             easyloader.theme = "bootstrap";
             easyloader.locale = "zh-CN";
             using(['linkbutton' , 'messager'] ,function(){
                $(".delbtn").linkbutton({iconCls:'icon-cancel'}).click(function(){

                 if(!confirm("该操作不可逆,是否删除!")) return false;

                });
                
                
                 
             });
        });
    </script><style type="text/css">
table {
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
</style><body><table width="580" cellspacing="0" cellPadding="0" class="listTable"><thead><tr><td>商品名称</td><td>商品价格</td><td>操作</td></tr></thead><tbody><?php if(is_array($product)): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($v["name"]); ?></td><td><?php echo ($v["price"]); ?></td><td><a href="__URL__/delete/pid/<?php echo ($v["id"]); ?>" class="delbtn" >删除</a></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody><tfoot></tfoot></table></body></html>