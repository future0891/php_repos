<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"><html lang="en"><head><meta http-equiv="Content-Type" content="text/html;charset=UTF-8" /><title>商品添加</title><link rel="stylesheet" type="text/css" href="__PUBLIC__/ztree/css/zTreeStyle/zTreeStyle.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css"><link rel="stylesheet" type="text/css" href="__PUBLIC__/uploadify/uploadify.css" /><link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/table.css" /><script type="text/javascript" src="__PUBLIC__/Js/jquery.min.js"></script><script type="text/javascript" src="__PUBLIC__/ztree/js/jquery.ztree.core-3.5.min.js"></script><script type="text/javascript" src="__PUBLIC__/uploadify/jquery.uploadify.js"></script><script type="text/javascript" src="__PUBLIC__/easyui/easyloader.js"></script><script type="text/javascript" src="__PUBLIC__/Js/admin.js"></script><script type="text/javascript" src="__PUBLIC__/Js/formTree.js"></script></head><script>            var zNodes =<?php echo ($channel); ?>;
             $(function(){
                easyloader.theme="bootstrap";
                var t = $("#treeDemo").formTree({zNodes:zNodes });
                t.expandAll(true);
                $("#channel").click(showMenu );
                
                
                $("#pic").uploadify({
                    'auto':false,
                    'buttonText' : '请选择文件',
                    'swf': '__PUBLIC__/uploadify/uploadify.swf',
                    'uploader' : '__URL__/getImage',
                    'button_image_url':'__APP__',
                    'fileTypeExts' : '*.gif; *.jpg; *.png',
                    'onUploadSuccess' : function(file, data, response) {
                        var resp = "<tr><td><img src=__PUBLIC__/Upload/Thumb/s_"+data + "  alt='无图片' /></td>";
                        resp +="<td>是否推荐<input type='checkbox'  name='recommend[]' value='1'/><input type='hidden' name='path[]' value ='" +data+"' ></td>";
                        resp +="<td><a href='#' class='delbtn' >删除</a></td></tr>";

                        $('#u_pic').append(resp);
                        $(".delbtn").linkbutton({
                            iconCls: 'icon-cancel'
                        }).click(function(){
                            var col = this;
                            $.post('__URL__/delPic' , {'pic': data} ,function(r){
                                $(col).parents("tr").remove();
                            });
                        });
                    }
                });
                
                
            });  
</script><body><form action="__URL__/addProcess" method="post" ><label>商品名称:</label><input type="text" name="name" id="" /><br/><label>商品种类:</label><input type="text" readonly="readonly"  id="channel" /><br/><label>商品价格:</label><input type="text" name="price" id="price" /><br/><label>尺码</label><input type="text" name="p_size" /><br/><label>商品存量:</label><input type="text" name="inventory" id="inventory" /><br/><label>商品描述:</label><textarea name="description" id="" cols="30" rows="5" ></textarea><br/><input type="hidden" name="cid" id="cid" value=""/><div id="file_wrap"><input type="file" name="pic" id="pic" /></div><a href="#" class="easyui-linkbutton" data-options="iconCls:'icon-tip'" onclick="javascript: $('#pic').uploadify('upload' , '*')">上传</a><br/><table width="580" cellspacing="0" cellPadding="0" class="listTable"><thead><tr><td>上传图片</td><td>图片属性</td><td>删除</td></tr></thead><tbody id="u_pic"></tbody><tfoot></tfoot></table><input  type="submit" value="提交"/></form><div id="menuWrap" class="menuContent" style="display:none; position: absolute;background-color: #5FC6DA"><ul id="treeDemo" class="ztree" style="margin-top:0; width:160px;"></ul></div></body></html>