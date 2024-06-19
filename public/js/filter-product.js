// Gestion du toggle de la nav
const filterToggleBtn = document.querySelector(".filter-toggle-container button");
const filterContainer = document.querySelector(".filter-container");
const filterCloseBtn = document.querySelector('.filter-container > button');
const fullScreenBlur = document.querySelector('.filter-full-screen-blur');
filterToggleBtn.addEventListener("click", () => {
    filterContainer.classList.toggle('open-filter')
    fullScreenBlur.classList.toggle('hide')
    setTimeout(() => {
        fullScreenBlur.style.opacity = "0.4";
      }, 10);
    document.body.classList.add("no-scroll");
});

filterCloseBtn.addEventListener("click", () => {
    filterContainer.classList.toggle('open-filter')
    fullScreenBlur.classList.toggle('hide')
    setTimeout(() => {
        fullScreen.style.opacity = "0";
      }, 10);
    document.body.classList.remove("no-scroll");
});
fullScreenBlur.addEventListener('click', () => {
    filterContainer.classList.toggle('open-filter')
    fullScreenBlur.classList.toggle('hide')
    setTimeout(() => {
        fullScreen.style.opacity = "0";
      }, 10);
    document.body.classList.remove("no-scroll");
})
// Récupération de tous les filters.

const allFiltersProduct = document.querySelectorAll(".filter");

allFiltersProduct.forEach((filterProduct) => {
  const filterBtn = filterProduct.querySelector("button");
  filterBtn.addEventListener("click", () => {
    filterProduct.classList.toggle("close");
  });
});
