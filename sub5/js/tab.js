// JavaScript Document

$(document).ready(function(){
  var cnt=$('.tabs .tab').length;  //탭메뉴개수  *** $(.tab의 개수를 따라감)
  var cnt=$('.list_veiw li a').length;  //탭메뉴개수  *** $(.tab의 개수를 따라감)
    
  $('.content_area .contlist:eq(0)').show(); //첫번째 내용만 보여라
  $('.tabs .tab1').addClass('on');
  
  $('.tabs .tab').each(function (index) {  // index=> 0 1 2
    $(this).click(function(){   //각각의 탭메뉴를 클릭하면 
      $('.content_area .contlist').hide();  
	  $('.content_area .contlist:eq('+index+')').show();
      for(var i=1;i<=cnt;i++){
           $('.tab'+i).removeClass('on');
      }    
      $(this).addClass('on'); //선택되는 탭메뉴만 활성화 상태 만들기
   });
  });   

  $('.list_view li .view1').click(function(){
     $('#list_content').removeClass('view2');
     $('#list_content').removeClass('view3');
  });
    
  $('.list_view li .view2').click(function(){
     $('#list_content').addClass('view2');
     $('#list_content').removeClass('view3');
  });
    
  $('.list_view li .view3').click(function(){
     $('#list_content').addClass('view3');
     $('#list_content').removeClass('view2');
  });

});