$(document).ready(function () {
    var th=$('.title_area p').offset().top;

    $(window).on('scroll',function(){ //scroll의 주최는 늘 window
      var scroll = $(window).scrollTop(); //scrollTop=스크롤의 거리값 / 스크롤이 움직이면 그 해당 스크롤의 거리값(스크롤탑)이 저장된다
        
      if(scroll>th){
          $('.slide_menu').css({"position":"fixed","top":"180px","z-index":"10"});
      }else{
          $('.slide_menu').css({"position":"relative","top":"","z-index":"0"});
      }
       
     });    

    $('.slide_menu a').click(function(){
      var value=0;
      // *(this).is('.link1') : is는 다음 선택자가 class/id 상관없이 다 잡을 수 있음
      //$(this).hasClass('link1') => hasClass는 class만 찾아낼 수 있기 때문에 "."을 안붙이고 클래스명만 작성
      if($(this).hasClass('link1')){
        value= $('.history dl:eq(0)').offset().top-180; 
        //.offset().top : 선택자 위부터 header까지의 총거리 
      }else if($(this).hasClass('link2')){
        value= $('.history dl:eq(1)').offset().top-180;
      }else if($(this).hasClass('link3')){
        value= $('.history dl:eq(2)').offset().top-180;    
      }

    $("html,body").stop().animate({"scrollTop":value},1000);
      //부드럽게 올라갈 수 있게 해주는 값 / value=목적지
  });
});