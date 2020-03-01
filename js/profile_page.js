function $(element){
	return document.querySelector(element);
}

var Foo = function(a) {
  this.x = a;
};

$("[name='txtEmail']").onblur = function(){validateEmail()};
$("[name='txtUserName']").onblur = function(){validateUserName()};
$("[name='btnAddMore']").onclick = function(){editMember()};

function fill_in_form(){
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "http://localhost/artemida/Users/returnMember");
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){

				var member = JSON.parse(ajax.responseText);
				Foo.mem = member;
				$("#image_profile_src").src = member.member_image.url_small;
				$("#user_name").innerHTML = member.member_public_name;
				$("#type").innerHTML = member.member_type;
				$("[name='txtUserName']").value = member.member_public_name;
				$("[name='txtEmail']").value = member.member_email;
				$("[name='txtPassword']").value = member.member_password;
				$("#data_registration").innerHTML = member.member_register_date;
				$("[name='txtContactEmail']").value = member.member_contact_mail;
				$("[name='txtContactPhone']").value = member.memeber_contact_phone;
		}
	}
}

function validateEmail(){
	if($("[name='txtEmail']").value != "")
	{
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "http://localhost/artemida/registration/registration_email_exists/?email=" + $("[name='txtEmail']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error" || $("[name='txtEmail']").value == Foo.mem.member_email){
					$("[name='txtEmail']").style.color = "#0062cc";
					$("[name='btnAddMore']").disabled = false;
				}
				else{
					//alert("Postoji nalog sa unetom e-mail adresom");
					$("[name='btnAddMore']").disabled = true;
					$("[name='txtEmail']").style.color = "#ff0000";
				}
			}
		}
	}
	else{
		$("[name='btnAddMore']").disabled = true;
	}
}

function validateUserName(){
	if($("[name='txtUserName']").value!=""){
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "http://localhost/artemida/registration/registration_member_name_exists/?member_name=" + $("[name='txtUserName']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error"  || $("[name='txtUserName']").value == Foo.mem.member_public_name){
					$("[name='txtUserName']").style.color = "#0062cc";
					$("[name='btnAddMore']").disabled = false;
				}
				else{
					$("[name='txtUserName']").style.color = "#ff0000";
					$("[name='btnAddMore']").disabled = true;
				}
			}
		}
	}
	else{
		$("[name='btnAddMore']").disabled = true;
	}
}

function verification_validity(){
	if(	$("[name='txtEmail']").value == "" ||
		$("[name='txtPassword']").value ==  "" ||
		$("[name='txtUserName']").value == ""
		)
		return false;
	else 
		return true;
}



function editMember(){
	if(!verification_validity()){
			alert("Proverite da li su sva neophodna polja popunjena!");
			return;
	}
	validateEmail();
	validateUserName();
	if($("[name='btnAddMore']").disabled == true){
		alert("Molimo Vas proverite validnost unetih podataka.")
	}
	var ajax = new XMLHttpRequest();
	var formData = new FormData();
	formData.append("email", $("[name='txtEmail']").value);
	formData.append("password", $("[name='txtPassword']").value);
	formData.append("member_name", $("[name='txtUserName']").value);
	formData.append("member_contact_mail",$("[name='txtContactEmail']").value);
	formData.append("member_contact_phone",$("[name='txtContactPhone']").value);
	formData.append("member_image_id", Foo.mem.member_image_id);
	formData.append("member_id", Foo.mem.member_id);
	for(let i =0; i < $("[name='profile_image_edit']").files.length; i++){
		formData.append("images[]", $("[name='profile_image_edit']").files[i]);
	}
	formData.append("images[]", $("[name='profile_image_edit']").files);
	ajax.open("POST", "http://localhost/artemida/AdminController/editMember");
	ajax.send(formData);

	ajax.onreadystatechange = function(){
		if(this.readyState == 4 && this.status ==200){
			var txt = ajax.responseText;
			if(txt == "Vise od jedne slike je izabrano za dodavanje")
				alert(txt);
			window.location.assign("http://localhost/artemida/users/my_account");
		}
	}
}



refreshPetsList(1);

function refreshPetsList(page){
  var ajax = new XMLHttpRequest();
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

  ajax.open("GET", baseUrl + "/pets/pagination/personal/" + page, true);
  ajax.send();

  ajax.onreadystatechange = function(){
    if (this.readyState == 4 && this.status == 200){
      var data = JSON.parse(this.responseText)
      
      $(".pets-table tbody").innerHTML = data.list;
      $(".table-pegination").innerHTML = data.links;
      currentPage = page;
    }
  }
}

var currentPetsPage = 1;

function loadPetsPage(element){
  refreshPetsList(element.querySelector("a").getAttribute("data-ci-pagination-page"));
  currentPetsPage = element.querySelector("a").getAttribute("data-ci-pagination-page");
}

function updatePetStatus(petId){
	var ajax = new XMLHttpRequest();
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

	ajax.open("GET", baseUrl + "/pets/update_pet/" + petId, true);
	ajax.send();

	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			refreshPetsList(currentPetsPage);
		}
	}
}
