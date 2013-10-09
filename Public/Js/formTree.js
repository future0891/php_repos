(function($){
	$.fn.formTree = function(opts){
		var settings = $.extend({
			data: {
                    simpleData: {
                        enable: true,
                        idKey: "id",
                        pIdKey: "pid",
                        root:-1
                    }
                },
             callback: {
                    onClick: onClick,
                    beforeClick:beforeClick
             },
             
             zNodes:"",
             showChannel:true,
		}, opts||{});
		
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
            
        var zNodes =settings.zNodes;
        
		var tree = this;
     	var t = $.fn.zTree.init($(tree), settings, zNodes);
     	return t;            
            		
	}
	
})(jQuery);

		    function onClick(e, treeId, treeNode) {
		        var zTree = $.fn.zTree.getZTreeObj("treeDemo"),
		        nodes = zTree.getSelectedNodes(),
		        v = nodes[0].name;
		        var cObj = $("#channel");
		        cObj.attr("value", v);
		        if($("#pid"))
		        	$("#pid").attr("value" , nodes[0].id);
		        if($("#cid"))
		        	$("#cid").attr("value" , nodes[0].id);
		    }		
        
            function showMenu() {
                var cObj = $("#channel");
                var cOffset = $("#channel").offset();
                $("#menuContent").css({left:(cOffset.left-190)+ "px", top:cOffset.top - cObj.outerHeight() + "px"}).slideDown("fast");
                if($("#menuWrap")) {
                	$("#menuWrap").css({left:cOffset.left+ "px", top:cOffset.top + cObj.outerHeight() + "px"}).slideDown("fast");
                }
                
                $("body").bind("mousedown", onBodyDown);

            }
            function hideMenu() {
            	if($("#menuContent")) {
            		$("#menuContent").fadeOut("fast");
            	}
            	if($("#menuWrap")) {
            		$("#menuWrap").fadeOut("fast");
            	}
                
                $("body").unbind("mousedown", onBodyDown);
            }
            function onBodyDown(event) {
                if (!(event.target.id == "menuBtn" || event.target.id == "menuContent"||event.target.id == "menuWrap" || $(event.target).parents("#menuContent").length>0 ||$(event.target).parents("#menuWrap").length>0)) {
                    hideMenu();
                }
            }