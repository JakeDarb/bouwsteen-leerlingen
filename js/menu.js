var url = new URL(window.location.href);
var page = url.searchParams.get("p");
var category = url.searchParams.get("p");
var currenTab = document.querySelector('[data-page='+page+']');
currenTab.classList.add("active");

var navItems = document.querySelectorAll(".nav--item");
var list = document.querySelector(".list");
var nav = document.querySelector(".nav");
let backBtns = document.querySelectorAll(".nav-back");


navItems.forEach(item => {
    item.addEventListener('click', e => {
        e.preventDefault();
        var currentActive = document.querySelector(".active");
        currentActive.classList.remove("active");
        item.classList.add("active");
        //console.log(item.dataset.page);
        toggleMenu(currentActive.dataset.page, item);

        const url = new URL(window.location.href);
        if(item.dataset.page != url.searchParams.get('p')){
            url.searchParams.set('p', item.dataset.page);
            url.searchParams.delete('c');
            window.history.replaceState(null, null, url);
            window.location.reload();
        }

        
        

        /* ADDING AND REMOVING IN URL
        const url = new URL(window.location.href);
        url.searchParams.set('p', 'val1');
        url.searchParams.set('c', 'val2');
        url.searchParams.delete('c');
        window.history.replaceState(null, null, url); // or pushState
        */
    })
  })

  if(url.searchParams.get('c')){
    navItems.forEach(item => {
        item.style.visibility="hidden";
    })
    backBtns.forEach(btn => {
        btn.style.display="flex";
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            url.searchParams.delete('c');
            window.history.replaceState(null, null, url);
            window.location.reload();
            console.log("click");
        })
    })
}

  function toggleMenu(active, pressedItem){
   
    if(active == pressedItem.dataset.page && nav.classList.contains("nav--open")){
        nav.classList.remove("nav--open")
        list.classList.remove("list--open")
    }else{
        nav.classList.add("nav--open")
        list.classList.add("list--open")
    }
  }