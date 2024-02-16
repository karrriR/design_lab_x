const faqs = document.querySelectorAll(".section-study-programme_programme-box"); 

faqs.forEach((faq) => { 
    faq.addEventListener("click", () => { 
        faq.classList.toggle("active"); 
    });
});