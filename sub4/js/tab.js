// JavaScript Document

$(document).ready(function(){
  var cnt=$('.tabs .tab').length;  //탭메뉴개수  *** $(.tab의 개수를 따라감)
  $('.content_area .contlist:eq(0)').show(); //첫번째 내용만 보여라
  $('.tabs .tab1').addClass('on');
  
  $('.tabs .tab').each(function (index) {  // index=> 0 1 2
    $(this).click(function(){   //각각의 탭메뉴를 클릭하면 
	  $('.content_area .contlist').hide(); // 모든 탭내용을 안보이게 한다
	  $('.content_area .contlist:eq('+index+')').show();
	  for(var i=1;i<=cnt;i++){
           $('.tab'+i).removeClass('on');
      } //모든 탭메뉴 비활성화 상태로 만들기
      $(this).addClass('on'); //선택되는 탭메뉴만 활성화 상태 만들기
        
   });
  });
    
  var head = $('.content_area');
     
    var tmp=window.location; //호출된 현재창의 주소 sub.html?a=1
    tmp=String(tmp).split('?'); //?를 기준으로 짤린 덩어리들이 tmp변수의 배열에 담김=> tmp[0]='sub.html' , tmp[1]='a=1'
   //에러방지 String 추가함

  //=를 기준으로 짤린 덩어리들이 tmp2변수의 배열에 담김 => tmp2[0]='a' , tmp2[1]='1'
  
    if(tmp[1] != undefined){ //?변수=값 이 넘어올때만..!
        tmp2=tmp[1].split('=');
        
        if(tmp2[1]==1){
            head.find($('section')).hide();
            head.find($('section:eq(0)')).show();
            head.find($('.tab')).removeClass('on');
            head.find($('.tab:eq(0)')).addClass('on');

        }else if(tmp2[1]==2){
            head.find($('section')).hide();
            head.find($('section:eq(1)')).show();
            head.find($('.tab')).removeClass('on');
            head.find($('.tab:eq(1)')).addClass('on');
        }else if(tmp2[1]==3){
            head.find($('section')).hide();
            head.find($('section:eq(2)')).show();
            head.find($('.tab')).removeClass('on');
            head.find($('.tab:eq(2)')).addClass('on'); 
        }else if(tmp2[1]==4){
            head.find($('section')).hide();
            head.find($('section:eq(3)')).show();
            head.find($('.tab')).removeClass('on');
            head.find($('.tab:eq(3)')).addClass('on');
        } 
    if(tmp2[1]){
         $("html,body").stop().scrollTop(890); 
    }
   }     

    $('.btn').click(function(){   //각각의 탭메뉴를 클릭하면 
	  $('#contactForm').slideDown();
      $(this).hide();
      $('.btn-success').show();
        
        
   });
    
});