console.log("Hello World !!!");

// FOOTER ELEMENT ACCORDION

const footerElements = document.querySelectorAll(".footer-element");

footerElements.forEach((element) => {
  const footerElementBtn = element.querySelector("button");

  const allLinksElement = element.querySelectorAll(
    ".container-elements-links a"
  );
  console.log(allLinksElement.length);

  footerElementBtn.addEventListener("click", () => {
    if (screen.width < 1000 && screen.width > 850) {
      expandFooterElement(44);
    } else if (screen.width < 850) {
      expandFooterElement(39);
    }
  });

  function expandFooterElement(allLinksHeight) {
    const btnHeight = footerElementBtn.offsetHeight;
    if (!element.classList.contains("expanded")) {
      element.classList.add("expanded");
      element.style.height =
        btnHeight + allLinksHeight * allLinksElement.length + "px";
    } else if (element.classList.contains("expanded")) {
      element.classList.remove("expanded");
      element.style.height = btnHeight + "px";
    }
  }
});
