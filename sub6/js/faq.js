// JavaScript Document

 $(document).ready(function () {
	var article = $('.faq .qa'); //선택자가 너무 길면 변수 안에 담아 사용할 수 있음/ var articale=>모든 리스트들!
	//article.find('.a').slideUp(100); //모든 답변 닫아라!
	$('dd').hide();
    $('.updown').html('<i class="fas fa-chevron-down"></i>');
	$('.qa:eq(0)').addClass('show');
	$('.qa:eq(0) dd').show();

	$('.faq .qa .trigger').click(function(){  
	var myArticle = $(this).parents('.qa'); //클릭한 해당 질문의 리스트
	
	if(myArticle.hasClass('hide')){   
	    article.find('dd').slideUp(300);
		article.removeClass('show').addClass('hide'); 
		article.find('.updown').html('<i class="fas fa-chevron-up"></i>');

	    myArticle.removeClass('hide').addClass('show');
        myArticle.find('dd').slideDown(500); 
	    myArticle.find('.updown').html('<i class="fas fa-chevron-down"></i>');
        
	 } else {  //'show'상태 체킹
       myArticle.removeClass('show').addClass('hide');  
	   myArticle.find('dd').slideUp(300);  
       myArticle.find('.updown').html('<i class="fas fa-chevron-up"></i>');
            
	}  
  });    
	
	$('.all').toggle(function(){ 
        article.find('dd').slideDown(500);
	    article.removeClass('hide').addClass('show');
        article.find('.updown').html('<i class="fas fa-chevron-up"></i>');
        $(this).text('모두 닫기');
        
        myArticle.removeClass('hide').addClass('show');
        myArticle.find('dd').slideDown(500); 
	    myArticle.find('.updown').html('<i class="fas fa-chevron-down"></i>');
        
	},function(){ 
	    article.find('dd').slideUp(300);
	    article.removeClass('show').addClass('hide');
        article.find('.updown').html('<i class="fas fa-chevron-down"></i>');
        $(this).text('모두 열기');
             
	});
});  