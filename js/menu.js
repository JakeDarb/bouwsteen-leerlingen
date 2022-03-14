var navItems=document.querySelectorAll(".nav--item");
var list=document.querySelector(".list");
var nav=document.querySelector(".nav");

navItems.forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault();
        var currentActive = document.querySelector(".active");
        //console.log('huidige active:'+currentActive.dataset.page);
        currentActive.classList.remove("active");
        item.classList.add("active");
        //console.log(item.dataset.page);
        toggleMenu(currentActive.dataset.page, item);

        const url = new URL(window.location.href);
        url.searchParams.set('p', item.dataset.page);
        window.history.replaceState(null, null, url);

        /* ADDING AND REMOVING IN URL
        const url = new URL(window.location.href);
        url.searchParams.set('p', 'val1');
        url.searchParams.set('c', 'val2');
        url.searchParams.delete('c');
        window.history.replaceState(null, null, url); // or pushState
        */
    })
  })

  function toggleMenu(active, pressedItem){
      console.log(active);
      console.log(pressedItem.dataset.page);
      console.log(nav);
      console.log(list);
    if(active == pressedItem.dataset.page && nav.classList.contains("nav--open")){
        nav.classList.remove("nav--open")
        list.classList.remove("list--open")
    }else{
        nav.classList.add("nav--open")
        list.classList.add("list--open")
    }
  }