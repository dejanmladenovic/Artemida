
loadPetTypes();

$("[name='pet-type']").onchange = function(){loadPetRaces()}


function $(element){
	return document.querySelector(element);
}

function loadPetTypes(){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "petspost/allowed_pet_types", true);
	ajax.send();

	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			var data = JSON.parse(this.responseText)
			data.forEach(function(element){
				$("[name='pet-type']").innerHTML+="<option>"+element+"</option>"
			});
			loadPetRaces();
		}
	}

}

function loadPetRaces(){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "petspost/allowed_pet_races/"+$("[name='pet-type']").value, true);
	ajax.send();

	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			var data = JSON.parse(this.responseText)
			
			$("[name='pet-race']").innerHTML = "";
			data.forEach(function(element){
				$("[name='pet-race']").innerHTML+="<option>"+element+"</option>"
			});
		}
	}
}


$("#images-input").onchange = function(){
	if($("#images-input").files.length > 5){
		alert("Najvise je dozvoljeno 5 fotografija.")
		$("#images-input").files = null;
		return;
	}
	if($("#images-input").files.length = 0){
		return;
	}


	$(".upload-gallery-wrapper").innerHTML = "";
	
	
	for(let i = 0; i < this.files.length; i++){
		let reader  = new FileReader();
		reader.onload = function(e){
			
			$(".upload-gallery-wrapper").innerHTML+= "<div class='upload-image' style='background-image: url("+e.target.result+")'></div>";
			
		}
		reader.readAsDataURL(this.files[i]);
	}

}

$("[name='submit']").onclick = function(){
	var ajax = new XMLHttpRequest();
	var formData = new FormData();

	formData.append("pet_name", $("[name='pet-name']").value);
	formData.append("pet_description", $("[name='pet-description']").value);
	formData.append("pet_type", $("[name='pet-type']").value);
	formData.append("pet_race", $("[name='pet-race']").value);
	formData.append("pet_sex", $("[name='pet-sex']").value);
	formData.append("pet_size", $("[name='pet-size']").value);
	formData.append("pet_taxonomy", $("[name='pet-taxonomy']").value);
	
	for(let i =0; i < $("#images-input").files.length; i++){
		formData.append("pet_images[]", $("#images-input").files[i]);
	}

	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	//ajax.addEventListener("error", completeHandler, false);
	//ajax.addEventListener("abort", completeHandler, false);


	ajax.open("POST", "petspost/post_pet");
	ajax.send(formData);
	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			if(this.response == "error"){
				$(".pet-post-form form").classList.remove("posting");
				$(".pet-post-form").classList.add("posting-error");
			}
			else{
				$(".pet-post-form form").classList.remove("posting");
				$(".pet-post-form").classList.add("posting-success");
			}
		}
	}
}

function progressHandler(event){
	$(".pet-post-form form").classList.add("posting");
}

function completeHandler(event){
	$(".pet-post-form form").classList.remove("posting");
}