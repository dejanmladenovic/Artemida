
console.log($("[name='email']").value);

$("[name='email']").onblur = function(){email_exists()};
$("[name='submit']").onclick = function(){check_user()};
$("[name='registration_href']").onclick = function(){
	window.location.assign("http://localhost/artemida/registration");
}

function $(element){
	return document.querySelector(element);
}

function email_exists(){
	var ajax = new XMLHttpRequest();
	ajax.open("GET", "login/email_exists/?email=" + $("[name='email']").value, true);
	ajax.send();

	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			if(this.responseText != "error"){
				$("[name='email']").style.borderColor = "#dadce0";
				$("#member-name").innerHTML = this.responseText;
				$(".login-form-header-wrapper").style.transform = "translateX(-50%)";
			}
			else{
				$("[name='email']").style.borderColor = "#ff0000";
			}	
		}
	}
	
}

function check_user(){
	var ajax = new XMLHttpRequest();
	var formData = new FormData();
	formData.append("email", $("[name='email']").value);
	formData.append("password", $("[name='password']").value);
	ajax.open("POST", "login/check_user");
	ajax.send(formData);

	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			if(ajax.response == "error"){
				$(".login-field input").style.borderColor = "#ff0000";
			}
			else{
				$(".login-field input").style.borderColor = "#dadce0";
				//setTimeot(function(){location = location}, 1500);
				//location = location;
				window.location.assign("http://localhost/artemida/home");
			}
		}
	}
}