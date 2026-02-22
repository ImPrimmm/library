const option = document.getElementById("roleOption");
const userId = document.getElementById("id");
const checkbox = document.getElementById("menu-check");
const profileMenu = document.getElementById("profile-menu");
const subMenu = document.getElementById("sub-menu-wrap");
document.addEventListener("DOMContentLoaded", async () => {
  await getdata();
  fixId();
  option.addEventListener("change", () => {
    fixId();
  });

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
const arr = [];
async function getdata() {
  try {
    const response = await fetch(
      "http://localhost/philib/admin-panel/auth/userData.php",
    );

    if (!response.ok) {
      throw new Error("Could not fetch resource");
    }
    const data = await response.json();
    for (const i in data) {
      arr.push(data[i]);
    }
  } catch (error) {
    console.error(error);
  }
}

function randomNum() {
  return String(Math.floor(Math.random() * 90000) + 10000);
}

function makeId() {
  return option.value + randomNum();
}

function checkDupId() {
  id = makeId();
  for (const data of arr) {
    if (data.user_id == id) {
      return fixId("", true);
    } else {
      return fixId(id, false);
    }
  }
}

function fixId(id, status = true) {
  if (status == true) {
    checkDupId();
  } else if (status == false) {
    userId.value = id;
  }
}
