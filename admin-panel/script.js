const checkbox = document.getElementById("menu-check");
const profileMenu = document.getElementById("profile-menu");
const subMenu = document.getElementById("sub-menu-wrap");

document.addEventListener("DOMContentLoaded", () => {
  profileMenu.addEventListener("click", () => {
    if (checkbox.checked) {
      checkbox.checked = false;
      subMenu.style.maxHeight = "0";
      subMenu.style.padding = "0em 1em";
    } else {
      checkbox.checked = true;
      subMenu.style.maxHeight = "500px";
      subMenu.style.padding = "1em 1em";
    }
  });
});
