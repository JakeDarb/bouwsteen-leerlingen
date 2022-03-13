var navItems=document.querySelectorAll(".nav--item");

navItems.forEach(item => {
    item.addEventListener('click', e => {
      e.preventDefault();
      var currentActive = document.querySelector(".active");
      currentActive.classList.remove("active");
      item.classList.add("active");
    })
  })