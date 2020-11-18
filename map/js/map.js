// JavaScript Document

 function initialize() {
  var myLatlng = new google.maps.LatLng(37.4962964,126.9090949);
  var myOptions = {
   zoom: 15,
   center: myLatlng

  }
  var map = new google.maps.Map(document.getElementById("map_home"), myOptions);
 
  var marker = new google.maps.Marker({
   position: myLatlng, 
   map: map, 
   title:"(주)우리집"
  });   
  
 
  var infowindow = new google.maps.InfoWindow({
   content: "(주)우리집주소, 전화전호, sns 등등"
  });
 
  infowindow.open(map,marker);
 }
 
 
 window.onload=function(){
  initialize();
 }

