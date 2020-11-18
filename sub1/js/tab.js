// JavaScript Document

$(document).ready(function(){
  var cnt=$('.tabs .tab').length;  //탭메뉴개수  *** $(.tab의 개수를 따라감)
  $('.tabs .tab1').addClass('on');
  
  $('.tabs .tab').each(function (index) {  // index=> 0 1 2
    $(this).click(function(){   //각각의 탭메뉴를 클릭하면 
	  
	  for(var i=1;i<=cnt;i++){
           $('.tab'+i).removeClass('on');
      } //모든 탭메뉴 비활성화 상태로 만들기
      $(this).addClass('on'); //선택되는 탭메뉴만 활성화 상태 만들기
   });
  });
});