setFilters();
refreshResults(1);
loadPetTypes();

var getUrl = window.location;
var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

////////////filter values
var taxonomy = "adoption";
var petName = "";
var petType = "";
var petRace = "";
var petSize = "";
var petSex = "";
var filters;

window.onresize = function(){
	resizePuzzleBox();
}


if(parseInt(window.innerWidth) < 992){
	$(".pets-filters-wrapper").classList.add("hide-filters");
}

$("[name='pet-type']").onchange = function(){loadPetRaces()}


function $(element){
	return document.querySelector(element);
}

function resizePuzzleBox(){
	for(var box of document.querySelectorAll(".puzzle-box")) { 
		box.style.height = box.offsetWidth + "px";
	}
}

function refreshResults(page){
	var ajax = new XMLHttpRequest();
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

	ajax.open("GET", baseUrl + "/pets/pagination/all/" + page + "/"+ filters, true);
	ajax.send();

	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			var data = JSON.parse(this.responseText)
			
			$(".pets-grid").innerHTML = data.puzzle;
			resizePuzzleBox();
			$(".pagination-links").innerHTML = data.links;
		}
	}
}

function loadPage(element){
	refreshResults(element.querySelector("a").getAttribute("data-ci-pagination-page"));
}

function loadPetTypes(){
	var ajax = new XMLHttpRequest();
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	ajax.open("GET", baseUrl + "/petspost/allowed_pet_types", true);
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
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
	ajax.open("GET", baseUrl + "/petspost/allowed_pet_races/"+$("[name='pet-type']").value, true);
	ajax.send();

	ajax.onreadystatechange = function(){
		if (this.readyState == 4 && this.status == 200){
			var data = JSON.parse(this.responseText)
			
			$("[name='pet-race']").innerHTML = "<option value=''>Bilo koja</option>";
			data.forEach(function(element){
				if(element != 'nisam siguran')
					$("[name='pet-race']").innerHTML+="<option>"+element+"</option>"
			});
		}
	}
}

function setFilters(){
	filters = "?pet_taxonomy=" + $(".pet-taxonomy-wrapper .active").value;
	if($("[name='pet-name']").value != "")
		filters+="&pet_name=" + $("[name='pet-name']").value;
	if($("[name='pet-type']").value != "")
		filters+="&pet_type=" + $("[name='pet-type']").value;
	if($("[name='pet-race']").value != "")
		filters+="&pet_race=" + $("[name='pet-race']").value;
	if($("[name='pet-size']").value != "")
		filters+="&pet_size=" + $("[name='pet-size']").value;
	if($("[name='pet-sex']").value != "")
		filters+="&pet_sex=" + $("[name='pet-sex']").value;
	filters+="&per_page=" + $("[name='per-page']").value;
	refreshResults(1);
}

function changeTaxonomy(element){
	if(!element.classList.contains("active")){
		$(".pet-taxonomy-wrapper .active").classList.remove("active");
		element.classList.add("active");
		setFilters();
	}
}

function hideFilters(){
	filtersMenu = $(".pets-filters-wrapper");
	if(filtersMenu.classList.contains("hide-filters"))
		filtersMenu.classList.remove("hide-filters");
	else
		filtersMenu.classList.add("hide-filters");
}

