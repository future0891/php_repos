(function($){
	
	//排序插件
	$.fn.shopsort = function(opts){
	     var _isSort =false;
	     var sortElement = $(this).find("tbody");
	     var _col = this;
	     var settings = $.extend({
	     	url:""
	     } , opts||{});
	     
        sortElement.sortable({
                placeholder: "ui-state-highlight",
                axis:"y",
                cursor: "move",
                helper:function(e ,element) {
                    var _original = element.children();
                    var _helper = element.clone();
                    _helper.children().each(function(index) {
                        $(this).width(_original.eq(index).width());
                    });
                    return _helper;
                },
                update:function(e , ui) {
                    setOrder();
                }
            });
        sortElement.sortable("disable");
        
        $("#startSort").on("click",function() {
            if(!_isSort) {
                sortElement.sortable("enable");   
                $(this).linkbutton({disabled:true});
                $("#stopSort").linkbutton({disabled:false});
                $(".listTable thead tr").append("<td>顺序</td>");
                setOrder();
                $(".listTable tfoot tr").append("<td id='notice'>拖动行开始排序</td>");
                _isSort  = true;
                } else {
                    return false;
                }
        });
        
        $("#stopSort").on("click",function(){
            if (_isSort) {
                var id_Arr = $( "tbody" ).sortable("toArray");
                $(this).linkbutton({disabled:true});
                sortElement.sortable("disable");
                $("#startSort").linkbutton({disabled:false});
                var addIndex = function(){
                	$(_col).find("tr").each(function(index){
                    $(this).children().last().remove();
                	});
                };
                
                $.post(settings.url, {"sort":id_Arr},function(data){
                	//清楚添加的行
                	addIndex();
                    alert(data);
                    //取消表格的左后一行,不然 重新开始由于两次ajax事件,会产生多个 td
                    $("#startSort").off();
                });
                $(".listTable").ajaxStart(function(){
                });
                _isSort = false;
            } else {
                return false;
            }
            
        });
        
        function setOrder() {
            $(_col).find("tbody tr").each(function(index){
                if(_isSort) {
                    $(this).find("td:last").html((index+1));
                } else {
                    $(this).append("<td>"+(index+1)+"</td>");
                }
                
            });
        }
        return sortElement;		
	}
	
	//固定的树插件
	$.fn.shoptree = function(opts) {
           var settings =$.extend({
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
                    // onClick:showWhat
                },
                nodes:"",
                showChannel:false,
                redirect:false
            } , opts||{});
            function beforeClick(treeId, treeNode) {
                var check = (treeNode && !treeNode.isParent);
                if(settings.showChannel)
                    check = (treeNode && treeNode.isParent);
                if (!check) {
                	if(!settings.showChannel)
                	{
                		alert("只能选择商品...");
                	} else {
                		alert("只能选择品种");
                	}
                }
                return check;
            }
            
	       // var showWhat;
           // if(!settings.redirect) {
           		// showWhat = onClick;
           // } else {
           		// showWhat = function(){alert("ttt")};
           // }
                       
            var zNodes =settings.nodes;
            
			var tree = this;
         	var t = $.fn.zTree.init($(tree), settings, zNodes);
         	return t;
	}

        
})(jQuery)
      function onClick(e, treeId, treeNode) {
            var zTree = $.fn.zTree.getZTreeObj("treeDemo");
            nodes = zTree.getSelectedNodes();
            v = nodes[0].name;
            var cObj = $("#channel");
            cObj.attr("value", v);
            $("#cid").attr("value" , nodes[0].id);
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
	//插件方法结束
