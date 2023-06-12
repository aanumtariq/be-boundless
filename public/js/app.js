// Initialize Wow
new WOW().init();
// Initialize Wow
new WOW().init();

// Accordion
const accordions = document.querySelectorAll(".accordion");
accordions.forEach((i) => {
  i.addEventListener("click", (e) => {
    const accordionContent = i.lastElementChild;
    if (accordionContent.style.maxHeight) {
      e.currentTarget.firstElementChild.classList.remove("active");
      accordionContent.style.maxHeight = null;
    } else {
      e.currentTarget.firstElementChild.classList.add("active");
      accordionContent.style.maxHeight = `${accordionContent.scrollHeight}px`;
    }
  });
});

// Initialize Slick
$(".productCarousel").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  dots: false,
  arrows: false,
});
$(".singleProduct__img").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  nextArrow: $(".singleProduct__picturesWrapper .next"),
  prevArrow: $(".singleProduct__picturesWrapper .prev"),
  autoplay: true,
  asNavFor: ".singleProduct__pictures",
});
$(".singleProduct__pictures").slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  centerMode: true,
  asNavFor: ".singleProduct__img",
  dots: false,
  arrows: true,
  nextArrow: $(".singleProduct__picturesWrapper .next"),
  prevArrow: $(".singleProduct__picturesWrapper .prev"),
  focusOnSelect: true,
});

// Create Ranges
$("#cutRange").ionRangeSlider({
  type: "double",
  grid: true,
  skin: "flat",
  from: 2,
  to: 3,
  values: ["Good", "Very Good", "Excellent"],
});
$("#colorRange").ionRangeSlider({
  type: "double",
  grid: true,
  skin: "flat",
  from: 5,
  to: 9,
  values: ["M", "L", "K", "J", "I", "H", "G", "F", "E", "D"],
});
$("#caratRange").ionRangeSlider({
  type: "double",
  grid: true,
  skin: "flat",
  min: 0.0,
  max: 8.0,
  from: 1.0,
  to: 8.0,
  step: 0.1,
});
$("#clarityRange").ionRangeSlider({
  type: "double",
  grid: true,
  skin: "flat",
  from: 1,
  to: 8,
  values: ["I1", "SI2", "SI1", "VS2", "VS1", "VVS2", "VVS1", "IF", "FL"],
});
$("#priceRange").ionRangeSlider({
  type: "double",
  grid: true,
  skin: "flat",
  min: 200,
  max: 100000,
  // from: 1,
  // to: 8,
  step: 100,
});

// tabs js
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

const defaultOpen = document.querySelector(".defaultOpen");
defaultOpen.click();