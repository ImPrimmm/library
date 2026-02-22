const option = document.getElementById("roleOption");
const userId = document.getElementById("id");
document.addEventListener("DOMContentLoaded", async () => {
  await getdata();
  getUrlParam();
  option.addEventListener("change", () => {
    fixId();
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

const email = document.getElementById("email");
const username = document.getElementById("username");
const phoneNumber = document.getElementById("phoneNumber");

function getUrlParam() {
  let urlParam = new URLSearchParams(location.search);

  userId.value = urlParam.get("updateId");
  for (const data of arr) {
    if (data.user_id == urlParam.get("updateId")) {
      if (data.role == "admin") {
        option.value = "admin";
      } else if (data.role == "staff") {
        option.value = "staff";
      } else if (data.role == "guest") {
        option.value = "guest";
      }
      email.value = data.email;
      username.value = data.username;
      if (data.phone_number == null) {
        phoneNumber.value = "";
      } else {
        phoneNumber.value = data.phone_number;
      }
    }
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
