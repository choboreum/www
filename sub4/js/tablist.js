// JavaScript Document

 $(document).ready(function () {
	//var article = $('.target');
	
	$('.target .trigger').click(function(){  
	   var myArticle = $(this).parent('div').next('.info'); //클릭한 해당 질문의 답변
	
        if(myArticle.hasClass('hide')){   
            //article.find('.info').slideUp(745);
            //article.find('.info').removeClass('show').addClass('hide'); 
            $(this).find('img').attr('src','images/content1/minus.png'); 
             
            myArticle.removeClass('hide').addClass('show');  
            myArticle.slideDown(745);  
            
         } else {  //'show'상태 체킹
           myArticle.removeClass('show').addClass('hide');  
           myArticle.slideUp(745); 
           $(this).find('img').attr('src','images/content1/add.png'); 
         }  
      });    
	
	$('.close').click(function(){    
	   $('.info').slideUp(500);
       $('.target .trigger').find('img').attr('src','images/content1/add.png');   
	});
});  