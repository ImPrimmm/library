const sidebar = document.getElementById("side-navbar");

const makeSidebar = (currPage = "", role = "admin") => {
  const divLogo = document.createElement("div");

  const anchorLogo = document.createElement("a");
  anchorLogo.setAttribute("href", "#");

  divLogo.append(anchorLogo);

  const nav = document.createElement("nav");

  const ul = document.createElement("ul");

  const liDashboard = document.createElement("li");

  const anchorDashboard = document.createElement("a");
  anchorDashboard.setAttribute("href", "/philib/admin-panel/index.php");
  anchorDashboard.dataset.page = "dashboard";
  anchorDashboard.innerHTML = "Dashboard";

  liDashboard.append(anchorDashboard);

  const liLogBook = document.createElement("li");

  const anchorLogBook = document.createElement("a");
  anchorLogBook.setAttribute("href", "#");
  anchorLogBook.dataset.page = "logBook";
  anchorLogBook.innerHTML = "Log Buku";

  liLogBook.append(anchorLogBook);

  if (role == "admin") {
    const liUser = document.createElement("li");

    const anchorUser = document.createElement("a");
    anchorUser.setAttribute("href", "/philib/admin-panel/p/user/index.php?locate=user");
    anchorUser.dataset.page = "user";
    anchorUser.innerHTML = "User";

    liUser.append(anchorUser);
    ul.append(liDashboard, liLogBook, liUser);
  } else {
    ul.append(liDashboard, liLogBook);
  }

  const liBook = document.createElement("li");

  const anchorBook = document.createElement("a");
  anchorBook.setAttribute("href", "#");
  anchorBook.dataset.page = "book";
  anchorBook.innerHTML = "Buku";

  liBook.append(anchorBook);

  ul.append(liBook);

  nav.append(ul);

  sidebar.append(divLogo, nav);

  const arrPage = Array.from(document.querySelectorAll("[data-page]")).map(
    (data) => data.dataset.page,
  );

  for (const data of arrPage) {
    if (currPage.toLowerCase() == data.toLowerCase()) {
      document.querySelector(`[data-page=${data}]`).classList.add("bgInfo");
      document.querySelector(`[data-page=${data}]`).style.color = "black";
    }
  }
};

export default makeSidebar;
