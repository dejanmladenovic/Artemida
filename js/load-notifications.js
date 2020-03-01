
var map;
var marker;
var radius;
var type = $("[pagination-type]").getAttribute("pagination-type");
var currentPage;

function $(element){
  return document.querySelector(element);
}

refreshNotificationList(1);

function refreshNotificationList(page){
  var ajax = new XMLHttpRequest();
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  ajax.open("GET", baseUrl + "/notifications/pagination/" + type + "/" + page, true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      var data = JSON.parse(this.responseText)
      
      $(".notification-list ul").innerHTML = data.list;
      $(".list-pagination").innerHTML = data.links;
      currentPage = page;
    }
  }
}

function loadPage(element){
  refreshNotificationList(element.querySelector("a").getAttribute("data-ci-pagination-page"));
}

function loadNotificationView(id){
  var ajax = new XMLHttpRequest();
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  ajax.open("GET", baseUrl + "/notifications/get_notification/" + id, true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      console.log(this);
      showMap();
      viewNotification(JSON.parse(this.responseText));
      $(".notification-pop-up").classList.add("show-popup");
    }
  }
}

function closePopUp(){
  $(".notification-pop-up").classList.remove("show-popup");
}


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
  $(".notification-sender-segment .notification-participant-image").style.backgroundImage = "url('" + notification.notification_sender.member_image.url_small + "')";
  $(".notification-sender-segment .notification-information span").innerHTML = notification.notification_sender.member_public_name;
  $(".notification-sender-segment .notification-date span").innerHTML = notification.notification_send_date;
  var location = {lat: parseFloat(notification.notification_lat), lng: parseFloat(notification.notification_lng)};
  marker.setPosition(location);
  radius.setCenter(location);
  console.log(notification.notification_radius);
  radius.setRadius(parseFloat(notification.notification_radius));
  map.setCenter(location);
  $(".notification-sender-segment .notification-description p").innerHTML = notification.notification_description;
  var galleryField = $(".notification-sender-segment .notification-gallery .notification-gallery-wrapper");
  galleryField.innerHTML = "";
  notification.notification_gallery.forEach(function(image){
    galleryField.innerHTML += '<a href="' + image.url_full + '" style="background-image: url(' + "'" + image.url_small + "'" + ')" data-lightbox="full"></a>'
  });

  if(notification.notification_responder != null){
    $(".notification-responder-segment .notification-participant-image").style.backgroundImage = "url('" + notification.notification_responder.member_image.url_small + "')";
    $(".notification-responder-segment .notification-information span").innerHTML = notification.notification_responder.member_public_name;
    $(".notification-responder-segment .notification-date span").innerHTML = notification.notification_respond_date;
  }

  responseField = $("[name='notification-response']");

  if(notification.notification_responder == null){
    responseField.value = "";
    responseField.setAttribute("placeholder", "Unesite odgovor...");
  }
  else{
    responseField.value = notification.notification_response;
  }
  if(type == "personal"){
    responseField.readOnly = true;
    responseField.setAttribute("placeholder", "Nema dostupnog odgovora.");
  }
  if($(".notification-respond-button button") != null){
    $(".notification-respond-button button").onclick = function(){respondToNotification(notification.notification_id)}
  }
  
}

function respondToNotification(id){
  var ajax = new XMLHttpRequest();
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  var ajax = new XMLHttpRequest();
  var formData = new FormData();

  formData.append("notification_id", id);
  formData.append("notification_response", $("[name='notification-response']").value);

  ajax.open("POST", baseUrl + "/notifications/save_response");
  ajax.send(formData);
  ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      closePopUp();
      if(this.responseText == "error"){
        alert("Došlo je do greške");
      }
      else{
        refreshNotificationList(currentPage);
      }
    }
  }
}


