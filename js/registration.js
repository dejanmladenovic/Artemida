function $(element){
	return document.querySelector(element);
}

$("[name='registration-password-replay']").onblur = function(){replay_password_ok()};
$("[name='registration-email']").onblur = function(){registration_email_exists()};
$("[name='registration-submit']").onclick = function(){registration_member()};
$("[name='registration-member-name']").onblur = function(){registration_member_name()};


function replay_password_ok(){
	if($("[name='registration-password-replay']").value != "")
	{
		if($("[name='registration-password-replay']").value != $("[name='registration-password']").value){
			$("[name='registration-password-replay']").style.borderColor = "#ff0000";
			$("[name='registration-submit']").disabled = true;
		}
		else{
		$("[name='registration-password-replay']").style.borderColor = "#dadce0";
		$("[name='registration-submit']").disabled = false;
		}
	}
	else{
		$("[name='registration-submit']").disabled = true;
	}
}
function registration_email_exists(){
	if($("[name='registration-email']").value != "")
	{
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "registration/registration_email_exists/?email=" + $("[name='registration-email']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error"){
					$("[name='registration-email']").style.borderColor = "#dedce0";
					$("[name='registration-submit']").disabled = false;
				}
				else{
					//alert("Postoji nalog sa unetom e-mail adresom");
					$("[name='registration-submit']").disabled = true;
					$("[name='registration-email']").style.borderColor = "#ff0000";
				}
			}
		}
	}
	else{
		$("[name='registration-submit']").disabled = true;
	}
}


function registration_member_name(){
	if($("[name='registration-member-name']").value!=""){
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "registration/registration_member_name_exists/?member_name=" + $("[name='registration-member-name']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error"){
					$("[name='registration-member-name']").style.borderColor = "#dedce0";
					$("[name='registration-submit']").disabled = false;
				}
				else{
					$("[name='registration-member-name']").style.borderColor = "#ff0000";
					$("[name='registration-submit']").disabled = true;
				}
			}
		}
	}
	else{
		$("[name='registration-submit']").disabled = true;
	}
}

function registration_member(){
	if(!verification_validity()){
			alert("Proverite da li su sva neophodna polja popunjena!");
			return;
	}
	registration_email_exists();
	registration_member_name();
	replay_password_ok();
	registration_member_name();
	if($("[name='registration-submit']").disabled == true){
		alert("Molimo Vas proverite validnost unetih podataka.")
	}
	else{
		var ajax = new XMLHttpRequest();
		var formData = new FormData();
		formData.append("member_type", "member");
		formData.append("email", $("[name='registration-email']").value);
		formData.append("password", $("[name='registration-password']").value);
		formData.append("member_name", $("[name='registration-member-name']").value);
		formData.append("member_contact_mail",$("[name='member-contact-mail']").value);
		formData.append("member_contact_phone",$("[name='member-contact-phone']").value);
		for(let i =0; i < $("[name='images-profile']").files.length; i++){
			formData.append("images[]", $("[name='images-profile']").files[i]);
		}
		formData.append("images[]", $("[name='images-profile']").files);
		ajax.open("POST", "registration/add_member");
		ajax.send(formData);

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200)
				var txt = ajax.responseText;
				if(txt=="Vise od jedne slike je izabrano za dodavanje")
					alert(txt);
				window.location.assign("http://localhost/artemida/login");
			}
	}
}


function verification_validity(){
	if(	$("[name='registration-email']").value == "" ||
		$("[name='registration-password']").value ==  "" ||
		$("[name='registration-member-name']").value == ""
		)
		return false;
	else 
		return true;
}


