console.log("hello");

// ELEMENT ACCORDION

// const footerElements = document.querySelectorAll(".footer-element");

// footerElements.forEach((element) => {
//   const footerElementBtn = element.querySelector("button");

//   const allLinksElement = element.querySelectorAll(
//     ".container-elements-links a"
//   );
//   console.log(allLinksElement.length);

//   footerElementBtn.addEventListener("click", () => {
//     if (screen.width < 1000 && screen.width > 850) {
//       expandFooterElement(44);
//     } else if (screen.width < 850) {
//       expandFooterElement(39);
//     }
//   });

//   function expandFooterElement(allLinksHeight) {
//     const btnHeight = footerElementBtn.offsetHeight;
//     if (!element.classList.contains("expanded")) {
//       element.classList.add("expanded");
//       element.style.height =
//         btnHeight + allLinksHeight * allLinksElement.length + "px";
//     } else if (element.classList.contains("expanded")) {
//       element.classList.remove("expanded");
//       element.style.height = btnHeight + "px";
//     }
//   }
// });

const accordionElement = document.querySelector(".accordion-element");
const accordionElementBtn = document.querySelector(".accordion-element button");
const allListElement = document.querySelectorAll(
  ".container-accordion-links ul li"
);

accordionElementBtn.addEventListener("click", () => {
  const btnHeight = accordionElementBtn.offsetHeight;
  if (!accordionElement.classList.contains("expanded")) {
    accordionElement.classList.add("expanded");
    // Je donne la height à l'elément accordéon en fonction de la taille du boutton + la taille d'un <li> (44) par défault multiplié par le nombre de li
    accordionElement.style.height =
      btnHeight + 44 * allListElement.length + "px";
  } else if (accordionElement.classList.contains("expanded")) {
    accordionElement.classList.remove("expanded");
    accordionElement.style.height = btnHeight + "px";
  }
});

// CAROUSEL CHANGE IMAGE

const allCarouselBtn = document.querySelectorAll('.carousel-product button')

console.log(allCarouselBtn);

const imageProduct = document.querySelector('.product-image img')
console.log(imageProduct);

allCarouselBtn.forEach(carouselBtn => {
    const carouselImagePath = carouselBtn.querySelector('img').src
    console.log(carouselImagePath);

    carouselBtn.addEventListener('click', () => {
        imageProduct.src = carouselImagePath
    })
});
