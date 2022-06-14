if(page == "tasks"){
    var listItems = document.querySelectorAll(".list--item-assignments");
    console.log("tasks");
}else{
    var listItems = document.querySelectorAll(".list--item-category");
}

listItems.forEach(item => {
    item.addEventListener('click', e => {
        const url = new URL(window.location.href);
        url.searchParams.set('c', item.dataset.category);
        window.history.replaceState(null, null, url);
        setTimeout(function(){
            window.location.reload();
        },500);
        

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
   
    if(active == pressedItem.dataset.page && nav.classList.contains("nav--open")){
        nav.classList.remove("nav--open")
        list.classList.remove("list--open")
    }else{
        nav.classList.add("nav--open")
        list.classList.add("list--open")
    }
  }