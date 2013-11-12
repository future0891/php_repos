(function($){
	$.fn.ProductTree = function(opts){
		     var settings = $.extend({
                data: {
                    simpleData: {
                        enable: true,
                        idKey: "id",
                        pIdKey: "pid",
                        rootPId: -1
                    }
                },
                async:{
                    enable:true,
                    url:'',
                },
               callback: {
                    onClick:showframe,
                    beforeClick:beforeClick,
               },	     	
		       refreshPage:"",
		       isChannel:true,
		     } ,opts||{});
			 
            function showframe(event , treeId , treeNode){
                $("#p_content").panel("refresh" , settings.refreshPage+ treeNode.id);
            }
            
			function beforeClick(treeId, treeNode) {
				var showNode = treeNode.isParent;
				if(!settings.isChannel) {
					showNode = !treeNode.isParent;
				}
				var check = (treeNode && showNode &&!treeNode.noadd);
				if (!check) {
					alert("只能选择不为空品种");
				}
				return check;
			}
            t = $.fn.zTree.init($("#tree") , settings);
            return t;
	}
	$.fn.delItem = function(){
               $(this).on("click" ,function(){
                   if(!confirm("该操作不可逆,是否删除!")) {
                       return false;
                   }
               });      
	}
})(jQuery)
