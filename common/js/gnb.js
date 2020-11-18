$(document).ready(function() {

    $('ul.dropdownmenu').hover(
        function() { 
            $('ul.dropdownmenu li.menu ul').fadeIn('normal',function(){$(this).stop();}); //모든 서브를 열어라!
	       $('#headerArea').animate({height:380},'fast').clearQueue(); //서브가 열렸을 때의 헤더의 높이
                 },
        function() {
	       $('ul.dropdownmenu li.menu ul').fadeOut('fast'); //모든 서브를 닫아라!
          $('#headerArea').animate({height:130},'fast').clearQueue(); //서브가 닫혔을 때의 헤더의 높이
    });
               
       //tab키처리
         $('ul.dropdownmenu li.menu .depth1').on('focus', function () {        
                $('ul.dropdownmenu li.menu ul').slideDown('fast');
                $('#headerArea').animate({height:380},'fast').clearQueue(); //서브가 열렸을 때의 헤더의 높이
          });

         $('ul.dropdownmenu li.m6 li:last').find('a').on('blur', function () {        
                  $('ul.dropdownmenu li.menu ul').slideUp('fast');
                 $('#headerArea').animate({height:130},'fast').clearQueue(); //서브가 닫혔을 때의 헤더의 높이
         });
       
});
