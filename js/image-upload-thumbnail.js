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