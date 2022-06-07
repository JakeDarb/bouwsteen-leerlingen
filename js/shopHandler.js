var shopItems = document.querySelectorAll(".list--item-shop");
let selectedItem;
const buyButton = document.querySelector(".button-buy");
const popup = document.querySelector(".popup");
const popupBuy = document.querySelector(".popup-buy");
const btnBuyAccept = document.querySelector(".popup-buy .button-accept");
const btnBuyDecline = document.querySelector(".popup-buy .button-decline");
shopItems.forEach(shopItem => {
    shopItem.addEventListener('click', e => {
        e.preventDefault();
        const url = new URL(window.location.href);
        // Show item on character
        let shopCategory = url.searchParams.get('c');
        let targetDivClass = ".character--"+shopCategory;
        let targetDiv = document.querySelector(targetDivClass);
        targetDiv.innerHTML = '<img src="'+shopItem.dataset.path+'" alt="character '+shopCategory+'"></img>';
        // Show buy button
        buyButton.style.display = "block";
        // Show select border
        shopItem.classList.add("list--item-selected");
        selectedItem = shopItem;
        console.log(shopItem);
    })
})
buyButton.addEventListener('click', (e) => {
    e.preventDefault;
    popup.style.display = "flex";
    popupBuy.style.display = "flex";
})
btnBuyDecline.addEventListener('click', (e) => {
    e.preventDefault;
    popup.style.display = "none";
    popupBuy.style.display = "none";
})
btnBuyAccept.addEventListener('click', (e) => {
    e.preventDefault;
    popup.style.display = "none";
    popupBuy.style.display = "none";
    buyButton.style.display = "none";
    selectedItem.style.display="none";
})