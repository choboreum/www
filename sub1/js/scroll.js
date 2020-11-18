$(document).ready(function () {
        $('.content_area div:eq(0)').addClass('boxMove');
        //첫번째 내용글 애니메이션 처리
        var smh=$('.content_area').offset().top; //함수밖에서 smh의 높이를 한번 계산해야 높이들이 변하지 않음
        //함수 안에서 계산 할 경우 스크롤이 움직이면서 높이가 변해서 오류가 날 수 있음
        var h1= $('.content_area').offset().top+200;
        var h2= $('.content_area div:eq(1)').offset().top-200;
        var h3= $('.content_area div:eq(2)').offset().top-100;
 
         //스크롤의 좌표가 변하면.. 스크롤 이벤트
        $(window).on('scroll',function(){
            var scroll = $(window).scrollTop();
            //스크롤top의 좌표를 담는다
            
            //스크롤의 거리의 범위를 처리
            if(scroll>=0 && scroll<h1){
                 $('.content_area div:eq(0)').addClass('boxMove');
                //첫번째 내용 콘텐츠 애니메이
            }else if(scroll>=h1 && scroll<h2){
                 $('.content_area div:eq(1)').addClass('boxMove');
            }else if(scroll>=h2 && scroll<h3){
                 $('.content_area div:eq(2)').addClass('boxMove');
            }else if(scroll>=h3){
                 $('.content_area div:eq(3)').addClass('boxMove');
            }
    });
});    