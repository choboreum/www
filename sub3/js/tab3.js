// JavaScript Document

$(document).ready(function(){
  $('.imglist .imgs:eq(0)').show(); //첫번째 내용만 보여라
    
  $('.pics .pic').each(function (index) {  // index=> 0 1 2
    $(this).click(function(){   //각각의 탭메뉴를 클릭하면 
      $('.imglist .imgs').hide(); // 모든 탭내용을 안보이게 한다  
      $('.imglist .imgs').attr('src','images/content3/nature'+(index+1)+'.png').show();
   });
  });
});