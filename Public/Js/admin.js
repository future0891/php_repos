(function($){
	
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
        
        $("#startSort").click(function() {
            if(!_isSort) {
                sortElement.sortable("enable");   
                $(this).linkbutton({disabled:true});
                $("#stopSort").linkbutton({disabled:false});
                $(".listTable thead tr").append("<td>顺序</td>");
                setOrder();
                $(".listTable tfoot tr").append("<td>拖动行开始排序</td>");
                _isSort  = true;
                } else {
                    return false;
                }
        });
        
        $("#stopSort").click(function(){
            if (_isSort) {
                var id_Arr = $( "tbody" ).sortable("toArray");
                $(this).linkbutton({disabled:true});
                sortElement.sortable("disable");
                $("#startSort").linkbutton({disabled:false});
                $(_col).find("tr").each(function(index){
                    $(this).children().last().remove();
                });
                
                $.post(settings.url, {"sort":id_Arr},function(data){
                    alert(data);
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

        
})(jQuery)
