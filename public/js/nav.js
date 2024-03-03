// Scroll de la nav

const navBar = document.querySelector("nav");

let lastScrollPosition = 0;

window.addEventListener("scroll", () => {
  let currentPositionScroll = window.scrollY;

  if (
    currentPositionScroll > lastScrollPosition &&
    currentPositionScroll > 150 &&
    !containerNavLinks.classList.contains("open-links")
  ) {
    // Si on scroll vers le bas fais remonter la navBar
    navBar.classList.add("scroll");
  } else {
    // Sinon la fais déscendre
    navBar.classList.remove("scroll");
  }
  lastScrollPosition = currentPositionScroll;

  if (currentPositionScroll > 150) {
    navBar.style.backgroundColor = "#fff";
  } else {
    navBar.style.backgroundColor = "transparent";
  }
});

// Toggle de la nav

const toggleBtnNav = document.querySelector(".burger-btn button");

const containerNavLinks = document.querySelector(".container-nav-links");

const allNavSvg = document.querySelectorAll(".burger-btn button svg");

const fullScreen = document.querySelector(".full-screen");

toggleBtnNav.addEventListener("click", () => {
  if (!containerNavLinks.classList.contains("open-links")) {
    containerNavLinks.classList.add("open-links");
    allNavSvg[0].classList.add("hide");
    allNavSvg[1].classList.remove("hide");

    fullScreen.classList.remove("hide");
    setTimeout(() => {
      fullScreen.style.opacity = "0.4";
    }, 10);

    if (window.scrollY < 150) {
      navBar.style.backgroundColor = "#fff";
    }
    document.body.classList.add("no-scroll");
    navBar.style.backgroundColor = "#fff";
  } else if (
    containerNavLinks.classList.contains("open-links") &&
    !baseNavLinks.classList.contains("hide")
  ) {
    containerNavLinks.classList.remove("open-links");
    allNavSvg[0].classList.remove("hide");
    allNavSvg[1].classList.add("hide");
    fullScreen.classList.add("hide");
    fullScreen.style.opacity = "0";

    if (window.scrollY < 150) {
      navBar.style.backgroundColor = "transparent";
    }
    document.body.classList.remove("no-scroll");
  } else if (
    containerNavLinks.classList.contains("open-links") &&
    baseNavLinks.classList.contains("hide")
  ) {
    baseNavLinks.classList.remove("hide");
    watchesNavLinks.classList.add("hide");
    allNavSvg[1].classList.remove("hide");
    allNavSvg[2].classList.add("hide");
  }
});

const watchBtnNav = document.querySelector(".container-base-nav-links button");
const baseNavLinks = document.querySelector(".container-base-nav-links");
const watchesNavLinks = document.querySelector(".container-watches-nav-links");

watchBtnNav.addEventListener("click", () => {
  baseNavLinks.classList.add("hide");
  watchesNavLinks.classList.remove("hide");

  allNavSvg[1].classList.add("hide");
  allNavSvg[2].classList.remove("hide");
});

fullScreen.addEventListener("click", () => {
  if (
    containerNavLinks.classList.contains("open-links") &&
    !baseNavLinks.classList.contains("hide")
  ) {
    containerNavLinks.classList.remove("open-links");
    allNavSvg[0].classList.remove("hide");
    allNavSvg[1].classList.add("hide");
    fullScreen.classList.add("hide");
    fullScreen.style.opacity = "0";

    if (window.scrollY < 150) {
      navBar.style.backgroundColor = "transparent";
    }
    document.body.classList.remove("no-scroll");
  }
  else if (
    containerNavLinks.classList.contains("open-links") &&
    baseNavLinks.classList.contains("hide")
  ) {
    containerNavLinks.classList.remove("open-links");
    baseNavLinks.classList.remove("hide");
    watchesNavLinks.classList.add("hide");
    allNavSvg[0].classList.remove("hide");
    allNavSvg[1].classList.add("hide");
    allNavSvg[2].classList.add("hide");
    fullScreen.classList.add("hide");
    fullScreen.style.opacity = "0";
    document.body.classList.remove("no-scroll");
  }
});
