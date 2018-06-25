$(function(){
   /*$(".right_redian_zan").click(function(){
      var s=parseInt($(this).find("em").text());
	  $(".right_redian_zan").find("em").text(s+1);
   })
   */  
   //首页点击左侧，右侧显示对应页面
   //     $(".left li").on("click",function(){
	//        var index=$(this).index();
	// 	   $(this).addClass("on").siblings("li").removeClass("on");
	//
	//
	// 	   //左侧例表对应右侧页面
	// 	   var r_con=new Array();
	// 	       r_con[0]="./热点推荐.html";
	//            r_con[1]="./1.html";
	// 		   r_con[2]="./大学排名.html";
	//        $(".right").load(r_con[index]);
	//    })
    $(document).delegate(".right_redian_zan","click",function(){
        var THIS = $(this);
        var postid = $(this).attr('postid');
        var count = parseInt($(this).children('em').html());
        $.post("/post/laud.html",{id:postid},function(result){
        	if (result==1){
        	    var count1 = parseInt(count+1);
        	    THIS.children('em').html(count1);
                THIS.addClass('right_redian_zan1').removeClass('right_redian_zan');
			} else if (result==2){
                var count2 = parseInt(count-1);
                THIS.children('em').html(count2);
                THIS.addClass('right_redian_zan').removeClass('right_redian_zan1');
			} else {
                if(confirm(result))location.href="/site/login.html"
			}
        });

    });

    $(document).delegate(".right_redian_zan1","click",function(){
        var THIS = $(this);
        var postid = $(this).attr('postid');
        var count = parseInt($(this).children('em').html());
        $.post("/post/laud.html",{id:postid},function(result){
            if (result==1){
                var count1 = parseInt(count+1);
                THIS.children('em').html(count1);
                THIS.addClass('right_redian_zan1').removeClass('right_redian_zan');
            } else if (result==2){
                var count2 = parseInt(count-1);
                THIS.children('em').html(count2);
                THIS.addClass('right_redian_zan').removeClass('right_redian_zan1');
            } else {
                if(confirm(result))location.href="/site/login.html"
            }
        });

    });

    $(document).delegate(".right_redian_cang","click",function(){
        var THIS = $(this);
        var postid = $(this).attr('postid');
        var count = parseInt($(this).children('em').html());
        $.post("/post/favorite.html",{id:postid},function(result){
            if (result==1){
                var count1 = parseInt(count+1);
                THIS.children('em').html(count1);
                THIS.addClass('right_redian_cang1').removeClass('right_redian_cang');
            } else if (result==2){
                var count2 = parseInt(count-1);
                THIS.children('em').html(count2);
                THIS.addClass('right_redian_cang').removeClass('right_redian_cang1');
            } else {
                if(confirm(result))location.href="/site/login.html"
            }
        });
    })

    $(document).delegate(".right_redian_cang1","click",function(){
        var THIS = $(this);
        var postid = $(this).attr('postid');
        var count = parseInt($(this).children('em').html());
        $.post("/post/favorite.html",{id:postid},function(result){
            if (result==1){
                var count1 = parseInt(count+1);
                THIS.children('em').html(count1);
                THIS.addClass('right_redian_cang1').removeClass('right_redian_cang');
            } else if (result==2){
                var count2 = parseInt(count-1);
                THIS.children('em').html(count2);
                THIS.addClass('right_redian_cang').removeClass('right_redian_cang1');
            } else {
                if(confirm(result))location.href="/site/login.html"
            }
        });
    })
});
