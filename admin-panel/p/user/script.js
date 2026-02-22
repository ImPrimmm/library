const checkbox = document.getElementById("menu-check");
const profileMenu = document.getElementById("profile-menu");
const subMenu = document.getElementById("sub-menu-wrap");

document.addEventListener("DOMContentLoaded", async () => {
  await getdata();
  showData();
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

const urlParam = new URLSearchParams(location.search);

function showData() {
  const tbody = document.getElementById("tbody");
  let no = 0;
  for (const data of arr) {
    no += 1;

    const tr = document.createElement("tr");
    tr.setAttribute("data-no", `${no}`);

    const dataNum = document.createElement("td");
    dataNum.setAttribute("id", `user-num-${no}`);
    dataNum.innerText = `${no}`;

    const userId = document.createElement("td");
    userId.setAttribute("id", `user-id-${data.user_id}`);
    userId.innerText = `${data.user_id}`;

    const email = document.createElement("td");
    email.setAttribute("id", `user-email-${data.email}`);
    email.innerText = `${data.email}`;

    const username = document.createElement("td");
    username.setAttribute("id", `user-username-${data.username}`);
    username.innerText = `${data.username}`;

    const password = document.createElement("td");
    password.setAttribute("id", `user-password-${data.password}`);
    password.innerText = `${data.password}`;

    const phoneNumber = document.createElement("td");
    phoneNumber.setAttribute("id", `user-phoneNumber-${data.phone_number}`);
    if (data.phone_number == null) {
      phoneNumber.innerText = ``;
    } else {
      phoneNumber.innerText = `${data.phone_number}`;
    }

    const role = document.createElement("td");
    role.setAttribute("id", `user-role-${data.role}`);
    role.innerText = `${data.role}`;

    const verifyToken = document.createElement("td");
    verifyToken.setAttribute("id", `user-verifyToken${data.verify_token}`);
    verifyToken.innerText = `${data.verify_token}`;

    const action = document.createElement("td");
    action.setAttribute("class", "button-wrapper");

    const edit = document.createElement("a");
    edit.addEventListener("click", (e) => {
      e.preventDefault();
    });

    const deleted = document.createElement("a");
    deleted.addEventListener("click", (e) => {
      e.preventDefault();
    });

    const editButton = document.createElement("button");
    editButton.classList.add("update");
    editButton.innerText = "Edit";
    editButton.addEventListener("click", () => {
      location.href = `../update/user/index.php?updateId=${data.user_id}`;
    });

    const deleteButton = document.createElement("button");
    deleteButton.classList.add("delete");
    deleteButton.innerText = "Delete";
    deleteButton.addEventListener("click", () => {
      if (
        urlParam.has("status", "pending") == false &&
        urlParam.has("deleteId", data.user_id) == false
      ) {
        window.location.href = `index.php?locate=user&status=pending&deleteId=${data.user_id}`;
      }
    });

    edit.append(editButton);
    deleted.append(deleteButton);
    action.append(edit, deleted);
    tr.append(
      dataNum,
      userId,
      email,
      username,
      password,
      phoneNumber,
      role,
      verifyToken,
      action,
    );
    tbody.appendChild(tr);
  }
}

if (urlParam.has("status", "pending") == true && urlParam.has("deleteId")) {
  if (confirm("yakin mau menghapus akun?")) {
    if (String(urlParam.get("deleteId")) == sessionId) {
      alert("Anda tidak bisa menghapus akun yang sedang anda gunakan");
      location.href = "index.php?locate=user";
    } else {
      location.href = `index.php?locate=user&deleteId=${urlParam.get("deleteId")}`;
    }
  } else {
    location.href = `index.php?locate=user`;
  }
}
