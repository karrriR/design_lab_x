const faqs = document.querySelectorAll(".section-info_material-box");

faqs.forEach((faq) => { 
  const arrowIcon = faq.querySelector("#arrow-icon");
  const crossIcon = faq.querySelector("#cross-icon");

  arrowIcon.addEventListener("click", (e) => {
    e.stopPropagation(); // предотвращаем всплытие клика
    faq.classList.add("active");
    arrowIcon.style.display = "none";
    crossIcon.style.display = "block";
  });

  crossIcon.addEventListener("click", (e) => {
    e.stopPropagation(); // предотвращаем всплытие клика
    faq.classList.remove("active");
    arrowIcon.style.display = "block";
    crossIcon.style.display = "none";
  });

  faq.addEventListener("click", (e) => {
    e.stopPropagation(); // предотвращаем всплытие клика
  });
});