document.addEventListener("DOMContentLoaded", function () {
  function elementIsInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top >= 0 &&
      rect.left >= 0 &&
      rect.bottom <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
  }

  function slideUpOnScroll() {
    const textContainer = document.querySelector(".text-container");
    if (elementIsInViewport(textContainer)) {
      textContainer.classList.add("slide-up");
      window.removeEventListener("scroll", slideUpOnScroll);
    }
  }

  window.addEventListener("scroll", slideUpOnScroll);
  slideUpOnScroll();
});

function dropdown() {
  document.getElementById("dropdown-content").classList.toggle("show");
}

window.onclick = function (event) {
  if (!event.target.matches(".dropbtn")) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains("show")) {
        openDropdown.classList.remove("show");
      }
    }
  }
};
