function $(element){
	return document.querySelector(element);
}



$("[name='show_worker']").onclick = function(){showMemberOne("employee")};
$("[name='show_members']").onclick = function(){showMemberOne("member")};
$("[name='add_members']").onclick = function(){show_add_worker_form()};
$("[name='submit']").onclick = function(){add_worker()};
$("[name='email']").onblur = function(){registration_email_exists()};
$("[name='user-name']").onblur = function(){registration_member_name()};
$("[name='show_members_dropdown']").onclick =  function(){showMemberOne("member")};
$("[name='show_worker_dropdown']").onclick = function(){showMemberOne("employee")};
$("[name='add_members_dropdown']").onclick = function(){show_add_worker_form()};
$("[name='buttonNext']").onclick = function(){showMemberOne($("[name='buttonNext']").name)};
$("[name='buttonPrev']").onclick = function(){showMemberOne($("[name='buttonPrev']").name)};


function registration_email_exists(){
	if($("[name='email']").value != "")
	{
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "registration/registration_email_exists/?email=" + $("[name='email']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error"){
					$("[name='email']").style.borderColor = "#dedce0";
					$("[name='submit']").disabled = false;
				}
				else{
					//alert("Postoji nalog sa unetom e-mail adresom");
					$("[name='submit']").disabled = true;
					$("[name='email']").style.borderColor = "#ff0000";
				}
			}
		}
	}
	else{
		$("[name='submit']").disabled = true;
	}
}


function registration_member_name(){
	if($("[name='user-name']").value!=""){
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "registration/registration_member_name_exists/?member_name=" + $("[name='user-name']").value, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				if(this.responseText == "error"){
					$("[name='user-name']").style.borderColor = "#dedce0";
					$("[name='submit']").disabled = false;
				}
				else{
					$("[name='user-name']").style.borderColor = "#ff0000";
					$("[name='submit']").disabled = true;
				}
			}
		}
	}
	else{
		$("[name='submit']").disabled = true;
	}
}




function add_worker(){
		registration_email_exists();
		registration_member_name();
		registration_member_name();
		if($("[name='submit']").disabled == true){
			alert("Molimo Vas proverite validnost unetih podataka.")
		}
		else{
			var ajax = new XMLHttpRequest();
			var formData = new FormData();
			formData.append("member_type", "employee");
			formData.append("email", $("[name='email']").value);
			formData.append("password", $("[name='password']").value);
			formData.append("member_name", $("[name='user-name']").value);
			formData.append("member_contact_mail",$("[name='contact-mail']").value);
			formData.append("member_contact_phone",$("[name='contact-phone']").value);
			for(let i =0; i < $("[name='images-profile']").files.length; i++){
				formData.append("images[]", $("[name='images-profile']").files[i]);
			}
			formData.append("images[]", $("[name='images-profile']").files);
			ajax.open("POST", "registration/add_member");
			ajax.send(formData);

			ajax.onreadystatechange = function(){
				if(this.readyState == 4 && this.status ==200)
				var odg = ajax.responseText;
				if(odg == "Vise od jedne slike je izabrano za dodavanje"){
					alert(odg);
				}
				else{
					console.log(odg);
					window.location.assign("http://localhost/artemida/AdminController");
				}

		}
	}
}

function show_add_worker_form(){
		$(".table_member").style.display = "none";
		//$(".div_for_data_show").style.display = "none";
		$(".add_worker").style.display = "inline";
}	
var k;
var mem;
function deleteMember($id){
		var ajax = new XMLHttpRequest();
		ajax.open("GET", "AdminController/deleteMember/?id=" + $id, true);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status == 200){
				console.log(ajax.responseText);
				showMemberOne(mem);
			}
		}
}

function editMember($id){
		window.location.assign("http://localhost/artemida/AdminController/edit/?id=" + $id);
}

function showMember($num, $member){
	var ajax = new XMLHttpRequest();
		ajax.open("GET", "AdminController/showMember/?num="+$num+"&member="+$member, true);
		//console.log("AdminController/showMember/?num="+$num+"&member="+$member);
		ajax.send();

		ajax.onreadystatechange = function(){
			if(this.readyState == 4 && this.status ==200){

				var txt = ajax.responseText;
				$("[name='table_member']").innerHTML = txt;
					$(".add_worker").style.display = "none";
				$(".table_member").style.display = "flex";
				var buttons = document.querySelectorAll("[name='edit']");
				buttons.forEach((button) => {
				  		button.addEventListener('click', () => {
				    	editMember(button.value);  //za izmenu podataka o radniku ili korinsiku
				  });
				});
				var buttonsDel = document.querySelectorAll("[name='delete']");
				buttonsDel.forEach((button) => {
				  		button.addEventListener('click', () => {
				    	deleteMember(button.value);
				  });
				});
			}
		}
}

function showMemberOne($pom){
	if($pom=="member"){
		k=parseInt(0);
		mem=$pom;
		showMember(k, $pom);
		}
	if($pom=="employee"){
		k=parseInt(0);
		mem=$pom;
		showMember(k, $pom);
		}
	if($pom == "buttonNext"){
		k=k+1;
		showMember(k, mem);
	}
	if($pom == "buttonPrev"){
		if(k>0){
			k=k-1;
		}
		showMember(k, mem);
	}

}

