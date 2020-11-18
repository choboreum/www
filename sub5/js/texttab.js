// JavaScript Document

$(document).ready(function(){
  var cnt=$('.mainimg .imgs').length;  //탭메뉴개수  *** $(.tab의 개수를 따라감)
    
  $('.mainimg .imgs:eq(0)').show(); //첫번째 내용만 보여라
  $('.mainimg .imgs1').addClass('on');
  
  $('.tabs .tab').each(function (index) {  // index=> 0 1 2
    $(this).click(function(){   //각각의 탭메뉴를 클릭하면 
      $('.mainimg .imgs').hide();  
	  $('.mainimg .imgs').attr('src','images/content3/img'+index+'.jpg').show();
	  $('.info span').text('2019'-index+'년');
      $(this).addClass('on'); //선택되는 탭메뉴만 활성화 상태 만들기
   });
  }); 
});