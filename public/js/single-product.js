console.log("hello");

// ELEMENT ACCORDION

const accordionElement = document.querySelector(".accordion-element");
const accordionElementBtn = document.querySelector(".accordion-element button");
const allListElement = document.querySelectorAll(
  ".container-accordion-links ul li"
);
if (accordionElementBtn) { // Vérifie si le produit contient un accordéon
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
  
}

// CAROUSEL CHANGE IMAGE

const allCarouselBtn = document.querySelectorAll('.carousel-product button')

const imageProduct = document.querySelector('.product-image img')

let imagesPathTable = []

allCarouselBtn.forEach(carouselBtn => {
    const carouselImagePath = carouselBtn.querySelector('img').src
    imagesPathTable.push(carouselImagePath)
    const carouselImageIndex = carouselBtn.querySelector('img').getAttribute('index');

    carouselBtn.addEventListener('click', () => {
        imageProduct.src = carouselImagePath
        imageProduct.setAttribute('index', carouselImageIndex)
    })
});

// ZOOM IMAGE
const fullScreenCarousel = document.querySelector('.full-screen-carousel')
const containerProductImage = document.querySelector('.product-image')
const carouselProductImage = document.querySelector('.full-screen-carousel-container-image img')
console.log(carouselProductImage);
const carouselAllIndexIndicator = document.querySelectorAll('.full-screen-carousel-info p span')
console.log(carouselAllIndexIndicator);

const carouselProgressLine = document.querySelector('.carousel-progress-line')
console.log(carouselProgressLine);
console.log(100 / allCarouselBtn.length);

// Actualisation de l'image et des indicateurs du full-size carousel
containerProductImage.addEventListener('click', () => {
    const imageIndex = imageProduct.getAttribute('index');

    fullScreenCarousel.classList.remove('hide')
    document.body.classList.add("no-scroll");
    carouselProductImage.src = imageProduct.src
    carouselProductImage.setAttribute('index', imageIndex)
    carouselAllIndexIndicator[0].textContent = imageIndex
    carouselAllIndexIndicator[1].textContent = allCarouselBtn.length

    // Donne la position de départ de la ligne d'indication du carousel
    // -100 pour mettre la barre de base à 0%
    // 100 / allCarouselBtn.length pour diviser la barre en fonction du nombre d'image et connaitre la progression que la barre dois avoir pour une image
    // * imageIndex Je multiplie le résultat de la division (la proggression pour une image) par l'index de l'image actuel

    carouselProgressLine.style.transform = `translateX(${-100 + 100 / allCarouselBtn.length * imageIndex}%)`

})

const fullScreenCarouselCloseBtn = document.querySelector('.full-screen-carousel button')

fullScreenCarouselCloseBtn.addEventListener('click', () => {
  fullScreenCarousel.classList.add('hide')
  document.body.classList.remove("no-scroll");
})


// GESTION DU SLIDE/CHANGEMENT D'IMAGE DU FULL-SIZE CAROUSEL

const fullScreenCarouselAllBtn = document.querySelectorAll('.full-screen-carousel-container-image button')
console.log(fullScreenCarouselAllBtn[1]);

console.log(imagesPathTable);

// // SUIVANT
// fullScreenCarouselAllBtn[1].addEventListener('click', () => {
//   let actualImageIndex = parseInt(carouselProductImage.getAttribute('index')) ;
//   console.log(actualImageIndex + "actual image index");
//   console.log(imagesPathTable.length);

//   if(actualImageIndex < imagesPathTable.length) {
//     carouselProductImage.setAttribute('index', actualImageIndex + 1)
  
//     carouselProductImage.src = imagesPathTable[actualImageIndex]
//     carouselAllIndexIndicator[0].textContent = actualImageIndex + 1

//     carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * (actualImageIndex + 1)}%)`


//   }else {
//     // console.log("not working");
//     carouselProductImage.setAttribute('index', 1)
  
//     carouselProductImage.src = imagesPathTable[0]

//     carouselAllIndexIndicator[0].textContent = "1"
//     carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * 1}%)`

//   }

// })

// // PRECEDENT

// fullScreenCarouselAllBtn[0].addEventListener('click', () => {
//   let actualImageIndex = parseInt(carouselProductImage.getAttribute('index'));
//   console.log(actualImageIndex + "actual image index");
//   console.log(imagesPathTable.length);

//   if (actualImageIndex > 1) {
//     carouselProductImage.setAttribute('index', actualImageIndex - 1);
  
//     carouselProductImage.src = imagesPathTable[actualImageIndex - 2];
//     carouselAllIndexIndicator[0].textContent = actualImageIndex - 1;

//     carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * (actualImageIndex - 1)}%)`;

//   } else {
//     carouselProductImage.setAttribute('index', imagesPathTable.length);
  
//     carouselProductImage.src = imagesPathTable[imagesPathTable.length - 1];

//     carouselAllIndexIndicator[0].textContent = imagesPathTable.length;
//     carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * imagesPathTable.length}%)`;
//   }
// });



function changeImage(direction) {
  let actualImageIndex = parseInt(carouselProductImage.getAttribute('index'));
  console.log(actualImageIndex + "actual image index");
  console.log(imagesPathTable.length);

  if (direction === "next") {
    if (actualImageIndex < imagesPathTable.length) {
      carouselProductImage.setAttribute('index', actualImageIndex + 1);
      carouselProductImage.src = imagesPathTable[actualImageIndex];
      carouselAllIndexIndicator[0].textContent = actualImageIndex + 1;
      carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * (actualImageIndex + 1)}%)`;
    } else {
      carouselProductImage.setAttribute('index', 1);
      carouselProductImage.src = imagesPathTable[0];
      carouselAllIndexIndicator[0].textContent = "1";
      carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * 1}%)`;
    }
  } else if (direction === "previous") {
    if (actualImageIndex > 1) {
      carouselProductImage.setAttribute('index', actualImageIndex - 1);
      carouselProductImage.src = imagesPathTable[actualImageIndex - 2];
      carouselAllIndexIndicator[0].textContent = actualImageIndex - 1;
      carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * (actualImageIndex - 1)}%)`;
    } else {
      carouselProductImage.setAttribute('index', imagesPathTable.length);
      carouselProductImage.src = imagesPathTable[imagesPathTable.length - 1];
      carouselAllIndexIndicator[0].textContent = imagesPathTable.length;
      carouselProgressLine.style.transform = `translateX(${-100 + 100 / imagesPathTable.length * imagesPathTable.length}%)`;
    }
  }
}

fullScreenCarouselAllBtn[1].addEventListener('click', () => changeImage("next"));
fullScreenCarouselAllBtn[0].addEventListener('click', () => changeImage("previous"));
