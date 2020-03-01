console.log("aaa");

function openSubMenu(element){
  var parent = element.parentElement
  if(parent.classList.contains("open-mobile-submenu"))
    parent.classList.remove("open-mobile-submenu");
  else
    parent.classList.add("open-mobile-submenu")
}

function openMobileMenu(){
  var menu = document.querySelector(".mobile-navigation");
  if(menu.classList.contains("show-mobile-navigation"))
    menu.classList.remove("show-mobile-navigation");
  else
    menu.classList.add("show-mobile-navigation")

}