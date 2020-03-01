function $(element){
	return document.querySelector(element);
}

$("[name='submit']").onclick = function(){
	var ajax = new XMLHttpRequest();
	var formData = new FormData();
	
	for(let i =0; i < $("[name='images']").files.length; i++){
		formData.append("images[]", $("[name='images']").files[i]);
	}
	formData.append("images[]", $("[name='images']").files);

	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	//ajax.addEventListener("error", completeHandler, false);
	//ajax.addEventListener("abort", completeHandler, false);


	ajax.open("POST", "uploadTest/upload_gallery");
	ajax.send(formData);
	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			if(ajax.response == "error"){
				console.log(ajax.responeText);
			}
			else{
				console.log(ajax.responeText);
			}
		}
	}
}

function progressHandler(event){
	var percent = (event.loaded/event.total) * 100;
	$("[name='upload-progress']").value = percent;
}

function completeHandler(event){
	alert("Otpremanje zavrseno");
	$("[name='upload-progress']").value = 0;
}