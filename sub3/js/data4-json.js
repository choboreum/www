var xhr = new XMLHttpRequest();                 // XMLHttpRequest 객체를 생성한다.

xhr.onload = function() {                       // When readystate changes
 
  //if(xhr.status === 200) {                      // If server status was ok
    responseObject = JSON.parse(xhr.responseText);  //서버로 부터 전달된 json 데이터를 responseText 속성을 통해 가져올 수 있다.
	                                                 // parse() 메소드를 호출하여 자바스크립트 객체로 변환한다.
    var newContent = '';
    for (var i = 0; i < responseObject.list.length; i++) { 
      newContent += '<section class="contlist">';
      newContent += '<h3>' + responseObject.list[i].title + '</h3>';
      newContent += '<p>' + responseObject.list[i].text1 + '</p>';
      newContent += '<p>' + responseObject.list[i].text2 + '</p>';
      newContent += '<ul class="arrow">';
      newContent += '<li><i class="fas fa-chevron-left"></i></li>';
      newContent += '<li><i class="fas fa-chevron-right"></i></li>';  
      newContent += '</ul>';
      newContent += '<ul class="imgbox">';
      newContent += '<li><div><img src="' + responseObject.list[i].picture1 + '" alt="'+responseObject.list[i].title+'이미지"></div></li>';
      newContent += '</ul>';
      newContent += '<ul class="imgtext">';
      newContent += '<li>'+responseObject.list[i].title+'</li>';
      newContent += '</ul>';
      newContent += '</section>';    
    }
    document.getElementById('tablist').innerHTML = newContent;

  //}
};

xhr.open('GET', 'data/data4.json', true);        // 요청을 준비한다.
xhr.send(null);                                 // 요청을 전송한다

