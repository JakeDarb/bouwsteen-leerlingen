var shopItems = document.querySelectorAll(".list--item-shop");
var wardrobeItems = document.querySelectorAll(".list--item-wardrobe");
let selectedItem;
const buyButton = document.querySelector(".button-buy");
const popup = document.querySelector(".popup");
const popupBuy = document.querySelector(".popup-buy");
const btnBuyAccept = document.querySelector(".popup-buy .button-accept");
const btnBuyDecline = document.querySelector(".popup-buy .button-decline");
const student = document.querySelector(".character");
const itemName = document.querySelector(".item-name");
const itemPrice = document.querySelector(".item-price");
const hideClothing = document.querySelector(".list--item-delete");
let studentWallet = document.querySelector(".coin--amount");
let studentWalletAmount;
let oldSelectedItem;

if(getPageName()=="wardrobe" && getPageCategory()){
    if(!document.querySelector(".list--item-selected")){
        hideClothing.classList.add("list--item-selected");
    }
}

// WARDROBE --------------------------------------------
wardrobeItems.forEach(wardrobeItem => {
    wardrobeItem.addEventListener('click', (e) => {
        e.preventDefault();
        wardrobeCategory = getPageCategory();
        showClothingOnCharacter(wardrobeCategory, wardrobeItem);
        oldSelectedItem = document.querySelector(".list--item-selected");
        oldSelectedItem.classList.remove("list--item-selected");
        selectListItem(wardrobeItem);
        // Post to database
        let formData = new FormData();
        formData.append('page', getPageName());
        formData.append('oldAccessoriesId', oldSelectedItem.dataset.item);
        formData.append('accessoriesId', selectedItem.dataset.item);

        fetch('ajax/shopHandler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            console.log('Success:', result);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    })
})
// WARDROBE --------------------------------------------
// SHOP ------------------------------------------------
shopItems.forEach(shopItem => {
    shopItem.addEventListener('click', (e) => {
        e.preventDefault();
        shopCategory = getPageCategory();
        // Show item on character
        showClothingOnCharacter(shopCategory, shopItem);
        // Show buy button
        buyButton.style.display = "block";
        // Show select border
        selectListItem(shopItem);
    })
})
buyButton.addEventListener('click', (e) => {
    e.preventDefault;
    popup.style.display = "flex";
    popupBuy.style.display = "flex";
    itemPrice.innerHTML = selectedItem.dataset.price;
    itemName.innerHTML = selectedItem.dataset.name;
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
    studentWalletAmount = parseInt(studentWallet.innerHTML)-parseInt(selectedItem.dataset.price);
    studentWallet.innerHTML = studentWalletAmount;
    // Post to database
    let formData = new FormData();
    formData.append('page', getPageName());
    formData.append('studentName', student.dataset.student);
    formData.append('accessoriesId', selectedItem.dataset.item);
    formData.append('itemPrice', selectedItem.dataset.price);

    fetch('ajax/shopHandler.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        console.log('Success:', result);
    })
    .catch(error => {
        console.error('Error:', error);
    });
})
// SHOP ------------------------------------------------

function getPageName(){
    const url = new URL(window.location.href);
    let page = url.searchParams.get('p');
    return page;
}
function getPageCategory(){
    const url = new URL(window.location.href);
    let category = url.searchParams.get('c');
    return category;
}
function showClothingOnCharacter(category, item){
    let targetDivClass = ".character--"+category;
    let targetDiv = document.querySelector(targetDivClass);
    targetDiv.innerHTML = '<img src="'+item.dataset.path+'" alt="character '+category+'"></img>';
}
function selectListItem(item){
    item.classList.add("list--item-selected");
    selectedItem = item;
}