function $(element){
	return document.querySelector(element);
}

$("[name='notification-description']").value = "";

 var marker;
 var radius;

function initMap(){
  // The location of Uluru
  var nis = {lat: 43.318520, lng: 21.894919};
  // The map, centered at Uluru
  var map = new google.maps.Map(
      document.getElementById('map'), {zoom: 15, center: nis});
  // The marker, positioned at Uluru
  
	marker = new google.maps.Marker({map: map});
		radius = new google.maps.Circle({map: map,
		radius: 100,
		fillColor: '#777',
		fillOpacity: 0.1,
		strokeColor: '#AA0000',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		editable: true      // Resizable
	});

  google.maps.event.addListener(map, "click", function (event) {
    var latitude = event.latLng.lat();
    var longitude = event.latLng.lng();
    

    marker.setPosition(event.latLng);
    radius.setCenter(event.latLng);

    // Center of map
    map.panTo(new google.maps.LatLng(latitude,longitude));

  }); 
}


$("[name='submit']").onclick = function(){
  var ajax = new XMLHttpRequest();
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  var ajax = new XMLHttpRequest();
  var formData = new FormData();

  formData.append("notification_tittle", $("[name='notification-tittle']").value);
  formData.append("notification_description", $("[name='notification-description']").value);
  formData.append("notification_lat", marker.position.lat());
  formData.append("notification_lng", marker.position.lng());
  formData.append("notification_radius", radius.radius);
  
  for(let i =0; i < $("#images-input").files.length; i++){
    formData.append("notification_images[]", $("#images-input").files[i]);
  }

  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  //ajax.addEventListener("error", completeHandler, false);
  //ajax.addEventListener("abort", completeHandler, false);


  ajax.open("POST", baseUrl + "/notifications/save_new_notification");
  ajax.send(formData);
  ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      if(this.responseText == "error"){
        $(".notification-form form").classList.remove("posting");
        $(".notification-form").classList.add("posting-error");
      }
      else{
        $(".notification-form form").classList.remove("posting");
        $(".notification-form").classList.add("posting-success");
      }
    }
  }
}

function progressHandler(event){
  $(".notification-form form").classList.add("posting");
}

function completeHandler(event){
  $(".notification-form form").classList.remove("posting");
}

