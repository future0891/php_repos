<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>Document</title><link rel="stylesheet" href="__PUBLIC__/Css/rbac.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript">        $(function(){
           $("input[level=1]").click(function(){
               var inputs =$(this).parents(".app").find("input:checkbox");
               if($(this).attr("checked") ) {
                    inputs.attr("checked" , "checked");
                } else {
                    inputs.removeAttr("checked");
                }
           });
           $("input[level=2]").click(function() {
                var inputs = $(this).parents("dl").find("input:checkbox");
                if($(this).attr("checked")) {
                    inputs.attr("checked" , "checked");
                } else {
                    inputs.removeAttr("checked");
                }
                 
           });
           
        });
    </script></head><body>    角色[<?php echo ($remark); ?>]配置权限<br ><form action="<?php echo U('Rbac/roleAccessProcess');?>" method="post"><div id="wrap"><a href="<?php echo U('Rbac/roleAccess');?>" class="add-app">返回角色管理</a><?php if(is_array($node)): $i = 0; $__LIST__ = $node;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$app): $mod = ($i % 2 );++$i;?><div class="app"><p><strong><?php echo ($app["remark"]); ?></strong><input type="checkbox" name="access[]" value="<?php echo ($app["id"]); ?>_1" level="1" <?php if($app['access'] == 1): ?>checked="checked"<?php endif; ?> /></p><?php if(is_array($app['child'])): $i = 0; $__LIST__ = $app['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$action): $mod = ($i % 2 );++$i;?><dl><dt><strong><?php echo ($action["remark"]); ?></strong><input type="checkbox" name="access[]" value="<?php echo ($action["id"]); ?>_2" level="2" <?php if($action['access'] == 1): ?>checked="checked"<?php endif; ?> /></dt><?php if(is_array($action['child'])): $i = 0; $__LIST__ = $action['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$method): $mod = ($i % 2 );++$i;?><dd><strong><?php echo ($method["remark"]); ?>(<?php echo ($method["name"]); ?>)</strong><input type="checkbox" name="access[]" value="<?php echo ($method["id"]); ?>_3" level="3" <?php if($method['access'] == 1): ?>checked="checked"<?php endif; ?>/></dd><?php endforeach; endif; else: echo "" ;endif; ?></dl><?php endforeach; endif; else: echo "" ;endif; ?></div><?php endforeach; endif; else: echo "" ;endif; ?></div><input type="hidden" name="rid" value="<?php echo ($rid); ?>" /><input type="submit" value="修改权限" /></form></body></html>