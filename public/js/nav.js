console.log("Hello World !!!");

// Toggle de la nav

const toggleBtnNav =  document.querySelector('.burger-btn button')
console.log(toggleBtnNav);

const containerNavLinks = document.querySelector('.container-nav-links')
console.log(containerNavLinks);

const allNavSvg = document.querySelectorAll('.burger-btn button svg')
console.log(allNavSvg);

toggleBtnNav.addEventListener('click', () => {
    containerNavLinks.classList.toggle('open-links')
    
    if(containerNavLinks.classList.contains('open-links')){
        allNavSvg[0].classList.add('hide')
        allNavSvg[1].classList.remove('hide')
    } else if(!containerNavLinks.classList.contains('open-links')) {
        allNavSvg[0].classList.remove('hide')
        allNavSvg[1].classList.add('hide')
        
    }
})

const watchBtnNav = document.querySelector('.container-base-nav-links button')
const baseNavLinks = document.querySelector('.container-base-nav-links')
const watchesNavLinks = document.querySelector('.container-watches-nav-links')

watchBtnNav.addEventListener('click', () => {
    toggleBtnNav.removeEventListener
    baseNavLinks.classList.add('hide')
    watchesNavLinks.classList.remove('hide')

    allNavSvg[1].classList.add('hide')
    allNavSvg[2].classList.remove('hide')
})