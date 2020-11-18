// JavaScript Document

$(document).ready(function(){
  var cnt=$('.main .imgs').length;  //탭메뉴개수  *** $(.tab의 개수를 따라감)
  $('.main .imgs:eq(0)').show(); //첫번째 내용만 보여라
  $('.main .imgs').addClass('on1');
  
  $('.imgbox .img').each(function (index) {  // index=> 0 1 2
    $(this).click(function(){   //각각의 탭메뉴를 클릭하면 
	  $('.main .imgs').hide(); // 모든 탭내용을 안보이게 한다
	  $('.main .imgs:eq('+index+')').show();
	  for(var i=1;i<=cnt;i++){
           $('.tab'+i).removeClass('on1');
      } //모든 탭메뉴 비활성화 상태로 만들기
      $(this).addClass('on1'); //선택되는 탭메뉴만 활성화 상태 만들기
        
   });
  });
});