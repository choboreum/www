$(document).ready(function () {

    $('.news a').click(function(){
      var value=0;
      // *(this).is('.link1') : is는 다음 선택자가 class/id 상관없이 다 잡을 수 있음
      //$(this).hasClass('link1') => hasClass는 class만 찾아낼 수 있기 때문에 "."을 안붙이고 클래스명만 작성
      value=$('.content_area').offset().top-150;
        

    $("html,body").stop().animate({"scrollTop":value},500);
      //부드럽게 올라갈 수 있게 해주는 값 / value=목적지
  });
});