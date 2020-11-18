var xhr = new XMLHttpRequest();                 // XMLHttpRequest 객체를 생성한다.

xhr.onload = function() {                       // When readystate changes
 
  //if(xhr.status === 200) {                      // If server status was ok
    responseObject = JSON.parse(xhr.responseText);  //서버로 부터 전달된 json 데이터를 responseText 속성을 통해 가져올 수 있다.
	                                                 // parse() 메소드를 호출하여 자바스크립트 객체로 변환한다.
    var newContent = '';
    for (var i = 0; i < responseObject.donate.length; i++) { 
      newContent += '<section>';
      newContent += '<h3>' + responseObject.donate[i].title + '</h3>';
      newContent += '<p>' + responseObject.donate[i].text1 + '</p>';
      newContent += '<p>' + responseObject.donate[i].text2 + '</p>';
      newContent += '<p>' + responseObject.donate[i].text3 + '</p>';
      newContent += '<ul>';
      newContent += '<li><div><img src="' + responseObject.donate[i].picture1 + '" alt=""></div></li>';
      newContent += '<li><div><img src="' + responseObject.donate[i].picture2 + '" alt=""></div></li>';
      newContent += '<li><div><img src="' + responseObject.donate[i].picture3 + '" alt=""></div></li>';
      newContent += '</ul>';
      newContent += '</section>';    
    }
    document.getElementById('donate').innerHTML = newContent;

  //}
};

xhr.open('GET', 'data/data4.json', true);        // 요청을 준비한다.
xhr.send(null);                                 // 요청을 전송한다

