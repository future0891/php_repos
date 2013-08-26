<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd"><html lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>Document</title></head><link type="text/css" rel="stylesheet" href="__PUBLIC__/jquery-ui/themes/base/jquery-ui.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-ui/ui/jquery.ui.core.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-ui/ui/jquery.ui.widget.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-ui/ui/jquery.ui.mouse.js"></script><script type="text/javascript" src="__PUBLIC__/jquery-ui/ui/jquery.ui.sortable.js"></script><script type="text/javascript">    $(function() {
        $( "tbody" ).sortable({
            placeholder: "ui-state-highlight"
        });
        $( "#sortable" ).disableSelection();       
    })
    
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
</style><body><table width="580" cellspacing="0" cellPadding="0" class="listTable"><thead><tr><td>id</td><td>图片</td><td>操作</td></tr></thead><tbody><?php if(is_array($product)): $i = 0; $__LIST__ = $product;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><tr><td><?php echo ($p["id"]); ?></td><td><?php echo ($p["name"]); ?></td><td><?php echo ($p["inventory"]); ?></td></tr><?php endforeach; endif; else: echo "" ;endif; if(empty($product)): ?><tr><td colspan="3">没有数据</td></tr><?php endif; ?></tbody><tfoot></tfoot></table><ul id="sortable"><li class="ui-state-default">Item 1</li><li class="ui-state-default">Item 2</li><li class="ui-state-default">Item 3</li><li class="ui-state-default">Item 4</li><li class="ui-state-default">Item 5</li><li class="ui-state-default">Item 6</li><li class="ui-state-default">Item 7</li></ul></body></html>