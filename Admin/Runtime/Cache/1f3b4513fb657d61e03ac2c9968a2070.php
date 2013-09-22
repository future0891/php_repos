<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>商品添加</title></head><script>            var zNodes =<?php echo ($channel); ?>;
            var pro_id = <?php echo ($product['cid']); ?>;
            var nodes;
            
             $(function(){
                easyloader.theme="bootstrap";
                
                var t = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
                t.expandAll(true);
                $("#channel").click(showMenu );
                
                var tree = $.fn.zTree.getZTreeObj("treeDemo");
                node = tree.getNodeByParam('id' , pro_id , null);
                $("#channel").attr("value",node['name']);
                $("cid").attr("value" , node['id']);
                
                $("#pic").uploadify({
                    'auto':false,
                    'buttonText' : '请选择文件',
                    'swf': '__PUBLIC__/uploadify/uploadify.swf',
                    'uploader' : '__URL__/getImage',
                    'button_image_url':'__APP__',
                    'fileTypeExts' : '*.gif; *.jpg; *.png',
                    'onUploadSuccess' : function(file, data, response) {
                        var resp = "<tr><td><img src=__PUBLIC__/Upload/Thumb/s_"+data + "  alt='无图片' /></td>";
                        resp +="<td>是否推荐<input type='checkbox'  name='recommend' value='1'/><input type='hidden' name='path[]' value ='" +data+"' ></td>";
                        resp +="<td><a href='#' class='delbtn' >删除</a></td></tr>";

                        $('#u_pic').append(resp);
                        $(".delbtn").linkbutton({iconCls: 'icon-cancel'});

                    }
                });
        
            });  
</script><body><form action="__URL__/updateProcess" method="post" ><input type="hidden" name="id"  value="<?php echo ($product["id"]); ?>" /><label>商品名称:</label><input type="text" name="name" value="<?php echo ($product["name"]); ?>" /><br/><label>商品种类:</label><input type="text" name=""  value="" id="channel" /><br/><input type="hidden" name="cid" id="cid" value="<?php echo ($product["cid"]); ?>"/><div id="file_wrap"><input type="file" name="pic" id="pic" /></div><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-tip'" onclick="javascript: $('#pic').uploadify('upload' , '*')">上传</a><br/><table width="580" cellspacing="0" cellPadding="0" class="listTable"><thead><tr><td>上传图片</td><td>图片属性</td><td>删除</td></tr></thead><tbody id="u_pic"><?php if(is_array($product["pic"])): $i = 0; $__LIST__ = $product["pic"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$p): $mod = ($i % 2 );++$i;?><tr><td><img src="__PUBLIC__/Upload/Thumb/s_<?php echo ($p["path"]); ?>" alt="无图片" /></td><td>是否推荐<input type='checkbox' <?php if($p["recommend"] == 1): ?>checked = "checked"<?php endif; ?> name='recommend' value='1'/><input type='hidden' name='path[]' value ='' ></td><td><a href='__URL__/delExistPic/pid/<?php echo ($p["id"]); ?>' class='pic_delbtn' >删除</a></td></td></tr><?php endforeach; endif; else: echo "" ;endif; ?></tbody><tfoot></tfoot></table><input  type="submit" value="提交"/></form><div id="menuContent" class="menuContent" style="display:none; position: absolute;background-color: #5FC6DA"><ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul></div></body></html>