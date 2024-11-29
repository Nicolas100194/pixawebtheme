let slides = document.getElementsByClassName("info-slide");
let btnNext = document.getElementsByClassName("btn-click");
slides = Array.from(slides);


btnNext[0].addEventListener("click", (e) => {
    let SlideCurrent = slides.filter(slide => !slide.classList.contains('slide-hidden'));
    if (SlideCurrent[0].nextElementSibling !== null){
        let newsSlideCurrent = SlideCurrent[0].nextElementSibling;
        SlideCurrent[0].classList.add("slide-hidden");
        newsSlideCurrent.classList.remove("slide-hidden");
    } else if (SlideCurrent[0].nextElementSibling === null){
        SlideCurrent[0].classList.add("slide-hidden");
        SlideCurrent[0] = SlideCurrent[0].previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling;
        SlideCurrent[0].classList.remove("slide-hidden");
    }


})

