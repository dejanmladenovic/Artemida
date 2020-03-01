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
      
      $(".notification-list").innerHTML = data.list;
      resizePuzzleBox();
      $(".list-pagination").innerHTML = data.links;
    }
  }
}
