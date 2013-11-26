<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>添加用户</title><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript">	    $(function(){
	        $("#repwd").blur(function(){
    	        if($("#pwd").val() != $("#repwd").val()) {
                    $("#repwd").after("<div id='error-tips'>两次密码不一样</div>");
                    $(":submit").attr("disabled" , "disabled");
                } else {
                    $("#error-tips").remove();
                    $(":submit").removeAttr("disabled");
                }
	        });
            
	    });
	</script></head><body><form action="<?php echo U('Rbac/addUserProcess');?>" method="post">	    用户&nbsp;&nbsp;名:  <input type="text" name="username" id="" /><br/>	    用户密码:  <input type="password" name="password" id="pwd" /><br/>	    确认密码:  <input type="password" name="repwd" id="repwd" /><br/>	    用户所属组:  <select name="role_id" id="role"><option value="">请选择用户组</option><?php if(is_array($role)): foreach($role as $key=>$r): ?><option value="<?php echo ($r["id"]); ?>">[<?php echo ($r["remark"]); ?>]</option><?php endforeach; endif; ?></select><br><input type="submit" value="提交" /></form></body></html>