function $(element){
	return document.querySelector(element);
}

var Foo = function(a) {
  this.x = a;
};


$("[name='email']").onblur = function(){validateEmail()};
$("[name='user-name']").onblur = function(){validateUserName()};
$("[name='submit']").onclick = function(){editMember()};

function fill_in_form($id){
	var ajax = new XMLHttpRequest();
		ajax.open("GET", "http://localhost/artemida/AdminController/returnMember/?id=" + $id, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){

				var member = JSON.parse(ajax.responseText);
				Foo.mem = member;
				$("#src_profile_image").src = member.member_image.url_small;
				$("[name='email']").value = member.member_email;
				$("[name='password']").value =  member.member_password;
				$("[name='user-name']").value = member.member_public_name;
				$("[name='contact-mail']").value = member.member_contact_mail;
				$("[name='contact-phone']").value = member.memeber_contact_phone;

			}
		}
	}

function validateEmail(){
	if($("[name='email']").value != "")
	{
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "http://localhost/artemida/registration/registration_email_exists/?email=" + $("[name='email']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error" || $("[name='email']").value == Foo.mem.member_email){
					$("[name='email']").style.borderColor = "#dedce0";
					$("[name='submit']").disabled = false;
					return false;
				}
				else{
					//alert("Postoji nalog sa unetom e-mail adresom");
					$("[name='submit']").disabled = true;
					$("[name='email']").style.borderColor = "#ff0000";
					return true;
				}
			}
		}
	}
	else{
		$("[name='submit']").disabled = true;
	}
}

function validateUserName(){
	if($("[name='user-name']").value!=""){
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "http://localhost/artemida/registration/registration_member_name_exists/?member_name=" + $("[name='user-name']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error"  || $("[name='user-name']").value == Foo.mem.member_public_name){
					$("[name='user-name']").style.borderColor = "#dedce0";
					$("[name='submit']").disabled = false;
					return false;
				}
				else{
					$("[name='user-name']").style.borderColor = "#ff0000";
					$("[name='submit']").disabled = true;
					return true;
				}
			}
		}
	}
	else{
		$("[name='submit']").disabled = true;
	}
}

function editMember(){
	if(!verification_validity()){
			alert("Proverite da li su sva neophodna polja popunjena!");
			return;
	}
	if( validateEmail() || validateUserName()){
		alert("Molimo Vas proverite validnost unetih podataka.")
	}
	else{
		var ajax = new XMLHttpRequest();
		var formData = new FormData();
		formData.append("email", $("[name='email']").value);
		formData.append("password", $("[name='password']").value);
		formData.append("member_name", $("[name='user-name']").value);
		formData.append("member_contact_mail",$("[name='contact-mail']").value);
		formData.append("member_contact_phone",$("[name='contact-phone']").value);
		formData.append("member_image_id", Foo.mem.member_image_id);
		formData.append("member_id", Foo.mem.member_id);
		for(let i =0; i < $("[name='images-profile']").files.length; i++){
			formData.append("images[]", $("[name='images-profile']").files[i]);
		}
		formData.append("images[]", $("[name='images-profile']").files);
		ajax.open("POST", "http://localhost/artemida/AdminController/editMember");
		ajax.send(formData);

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){
				var txt = ajax.responseText;
				console.log(txt);
				if(txt == "Vise od jedne slike je izabrano za dodavanje")
					alert(txt);
				else{
					window.location.assign("http://localhost/artemida/AdminController/edit/?id=" + Foo.mem.member_id);
				}
			}
		}
	}
}

function verification_validity(){
	if(	$("[name='email']").value == "" ||
		$("[name='password']").value ==  "" ||
		$("[name='user-name']").value == ""
		)
		return false;
	else 
		return true;
}
