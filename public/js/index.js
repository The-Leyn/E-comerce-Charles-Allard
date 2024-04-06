// WATCH SVG ANIMATION

// Mettre à jour la variable CSS --minutes avec le nombre actuel de minutes
// setInterval(() => {
//     const minutes = now.getMinutes();
//     document.documentElement.style.setProperty('--minutes', minutes);
// }, 60000);
// Mettre à jour toutes les 60 secondes (1 minute)

document.addEventListener("DOMContentLoaded", () => {
    function updateTime() {
        const currentDate = new Date();
        
        const hoursHandValue = currentDate.getHours();
        const minutesHandValue = currentDate.getMinutes();
        
        const hoursHand = document.getElementById('hours-hand')
        const minutesHand = document.getElementById('minutes-hand')
        
        hoursHand.style.transform = `rotate(${hoursHandValue * 30}deg)`;
        minutesHand.style.transform = `rotate(${minutesHandValue * 6}deg)`;
    }
    updateTime()
    const actualSeconds = new Date().getSeconds();
    // Calculer le délai avant le prochain intervalle
    const delay = 60000 - (actualSeconds * 1000);
    // Utiliser setTimeout() pour planifier l'appel de updateTime() après le délai
    setTimeout(function() {
        updateTime(); // Appeler updateTime() après le délai initial
        // Utiliser setInterval() pour appeler updateTime() toutes les 60 secondes
        setInterval(updateTime, 60000);
    }, delay);
});

// CAROUSEL SLIDER

const allSlides = document.querySelectorAll(".slider-slide")
// console.log(allSlides);
const allSlidesBtn = document.querySelectorAll('.slider-indicators button')
// console.log(allSlidesBtn);
const allSlideImages = document. querySelectorAll('.slider-product-image img')
// console.log(allSlideImages);

const allSlideBtnIndicator = document.querySelectorAll('.slider-indicators button div')

const totalSlide = allSlides.length - 1;
console.log("Total Slide : " + totalSlide);
let actualSlideIndex = 0;
let intervalSlide;

function startInterval() {
    clearInterval(intervalSlide);
    intervalSlide = setInterval(nextSlide, 15000);
}

startInterval(); // Start the interval initially

allSlidesBtn.forEach((slideBtn, slideBtnIndex) => {
    slideBtn.addEventListener('click', () => {
        clearInterval(intervalSlide);
        allSlideBtnIndicator.forEach((btnIndicator, indicatorIndex) => {
            btnIndicator.classList.toggle('active', indicatorIndex === slideBtnIndex);
        });
        allSlides.forEach((slide, slideIndex) => {
            slide.classList.toggle('active-slider', slideIndex === slideBtnIndex);
        });
        allSlideImages.forEach((slideImage, slideImageIndex) => {
            slideImage.classList.toggle('active-slider-image', slideImageIndex === slideBtnIndex);
        });
        actualSlideIndex = slideBtnIndex; // Update actualSlideIndex to match the clicked slide
        startInterval(); // Start the interval again after clicking a slide button
    })
});

// Function next Slide

function nextSlide() {
    if (actualSlideIndex < totalSlide) {
        actualSlideIndex++;
    } else {
        actualSlideIndex = 0;
    }

    allSlideBtnIndicator.forEach((btnIndicator, indicatorIndex) => {
        btnIndicator.classList.toggle('active', indicatorIndex === actualSlideIndex);
    });
    allSlides.forEach((slide, slideIndex) => {
        slide.classList.toggle('active-slider', slideIndex === actualSlideIndex);
    });
    allSlideImages.forEach((slideImage, slideImageIndex) => {
        slideImage.classList.toggle('active-slider-image', slideImageIndex === actualSlideIndex);
    });
}
