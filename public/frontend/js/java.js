document.addEventListener("DOMContentLoaded", function () {
  let slideIndex = 1;
  showSlides(slideIndex);

  setInterval(function() {
    plusSlides(1);  // Tự động chuyển slide
  }, 3000);  // 3000ms = 3 giây

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function showSlides(n) {
    let slides = document.getElementsByClassName("mySlides");

    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }

    // Ẩn tất cả các slide
    for (let i = 0; i < slides.length; i++) {
      slides[i].classList.remove("slide-active");
      slides[i].style.display = "none";  // Ẩn slide
    }

    // Hiển thị slide hiện tại và áp dụng hiệu ứng trượt vào
    slides[slideIndex - 1].style.display = "block";
    slides[slideIndex - 1].classList.add("slide-active");
  }
});