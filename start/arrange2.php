<!DOCTYPE html>
<html>
<head>
<style>
#dropHere {
    width:400px;
    height: 400px;
    border: dotted 1px black;
    
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
 <body>
         <div class="dragImg"><img class="img" src="http://www.thumbshots.com/Portals/0/Images/Feature%20TS%201.jpg">
             </div>

       <div id="dropHere"></div>
	   
	   <script>
	   $(function(){
  
 //Make every clone image unique.  
   var counts = [0];
    var resizeOpts = { 
      handles: "all" ,autoHide:true
    };    
   $(".dragImg").draggable({
                         helper: "clone",
                         //Create counter
                         start: function() { counts[0]++; }
                        });

$("#dropHere").droppable({
       drop: function(e, ui){
               if(ui.draggable.hasClass("dragImg")) {
     $(this).append($(ui.helper).clone());
   //Pointing to the dragImg class in dropHere and add new class.
         $("#dropHere .dragImg").addClass("item-"+counts[0]);
            $("#dropHere .img").addClass("imgSize-"+counts[0]);
                
   //Remove the current class (ui-draggable and dragImg)
         $("#dropHere .item-"+counts[0]).removeClass("dragImg ui-draggable ui-draggable-dragging");

$(".item-"+counts[0]).dblclick(function() {
$(this).remove();
});     
	make_draggable($(".item-"+counts[0])); 
      $(".imgSize-"+counts[0]).resizable(resizeOpts);     
       }

       }
      });


var zIndex = 0;
function make_draggable(elements)
{	
	elements.draggable({
		containment:'parent',
		start:function(e,ui){ ui.helper.css('z-index',++zIndex); },
		stop:function(e,ui){
		}
	});
}    


    
   });
	   </script>
     </body>
</html>