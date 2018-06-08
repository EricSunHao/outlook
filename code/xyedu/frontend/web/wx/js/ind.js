$(function(){
   /*$(".right_redian_zan").click(function(){
      var s=parseInt($(this).find("em").text());
	  $(".right_redian_zan").find("em").text(s+1);
   })
   */  
   //首页点击左侧，右侧显示对应页面
       $(".left li").on("click",function(){
	       var index=$(this).index();
		   $(this).addClass("on").siblings("li").removeClass("on");
		   
		   
		   //左侧例表对应右侧页面
		   var r_con=new Array();
		       r_con[0]="./热点推荐.html";
	           r_con[1]="./1.html";
			   r_con[2]="./大学排名.html";
	       $(".right").load(r_con[index]);
	   })
   
});
