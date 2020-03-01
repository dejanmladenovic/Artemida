

var map;
var marker;
var radius;

function $(element){
  return document.querySelector(element);
}

refreshNotificationList(1);

function refreshNotificationList(page){
  var ajax = new XMLHttpRequest();
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  ajax.open("GET", baseUrl + "/notifications/pagination/" + page, true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      var data = JSON.parse(this.responseText)
      
      $(".notification-list ul").innerHTML = data.list;
      $(".list-pagination").innerHTML = data.links;
    }
  }
}

function loadNotificationView(id){
  var ajax = new XMLHttpRequest();
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  ajax.open("GET", baseUrl + "/notifications/get_notification/" + id, true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      showMap();
      viewNotification(JSON.parse(this.responseText));

    }
  }
}

loadNotificationView(6);


function showMap(){
    var location = {lat: 0, lng: 0};
    map = new google.maps.Map(
        document.getElementById('map'), {zoom: 15, center: location});
    marker = new google.maps.Marker({map: map, position: location});
    radius = new google.maps.Circle({map: map,
      radius: 100,
      fillColor: '#777',
      fillOpacity: 0.1,
      strokeColor: '#AA0000',
      strokeOpacity: 0.8,
      strokeWeight: 2,
    });
    radius.setCenter(location);
}

function viewNotification(notification){
  $(".notification-sender-segment  .notification-participant-image").style.backgroundImage = "url('" + notification.notification_sender.member_image.url_small + "')";
  $(".notification-sender-segment .notification-information span").innerHTML = notification.notification_sender.member_public_name;
  $(".notification-sender-segment .notification-date span").innerHTML = notification.notification_send_date;
  marker.setPosition({lat: parseFloat(notification.notification_lat), lng: parseFloat(notification.notification_lng)});
  radius.setCenter({lat: parseFloat(notification.notification_lat), lng: parseFloat(notification.notification_lng)});
  map.panTo(marker.position);
  $(".notification-sender-segment .notification-description p").innerHTML = notification.notification_description;
  var galleryField = $(".notification-sender-segment .notification-gallery .notification-gallery-wrapper");
  galleryField.innerHTML = "";
  notification.notification_gallery.forEach(function(image){
    galleryField.innerHTML += '<a href="' + image.url_full + '" style="background-image: url(' + "'" + image.url_small + "'" + ')" data-lightbox="full"></a>'
  });
  if(notification.notification_responder == null){
    $(".notification-responder-segment .notification-information").innerHTML = "Nema dostupnog odgovora."
  }

}






