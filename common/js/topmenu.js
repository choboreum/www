$(document).ready(function () {
        var th=$('header').height()+$('.visual').height();
      $('.top_move').hide();

    console.log(th);
    //console.log($('header').height()) ;
    //console.log($('.main').height()) ;
    
     $(window).on('scroll',function(){ //scroll의 주최는 늘 window
          var scroll = $(window).scrollTop(); //scrollTop=스크롤의 거리값 / 스크롤이 움직이면 그 해당 스크롤의 거리값(스크롤탑)이 저장된다

          if(scroll>th){
              $('.top_move').fadeIn('slow');
          }else{
              $('.top_move').fadeOut('fast');
          }
     });

      $('.top_move').click(function(){
          //상단으로 스르륵 이동합니다.
         $("html,body").stop().animate({"scrollTop":0},1000); 
      }); //여기까지 공통js => commom js에 놓고 쓰면 됨
});