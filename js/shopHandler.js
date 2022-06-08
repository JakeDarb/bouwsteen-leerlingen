var shopItems = document.querySelectorAll(".list--item-shop");
var wardrobeItems = document.querySelectorAll(".list--item-wardrobe");
let selectedItem;
const buyButton = document.querySelector(".button-buy");
const popup = document.querySelector(".popup");
const popupBuy = document.querySelector(".popup-buy");
const btnBuyAccept = document.querySelector(".popup-buy .button-accept");
const btnBuyDecline = document.querySelector(".popup-buy .button-decline");
const student = document.querySelector(".character");
const studentPedestal = document.querySelector(".character--pedestal");
const itemName = document.querySelector(".item-name");
const itemPrice = document.querySelector(".item-price");
const hideClothing = document.querySelector(".list--item-delete");
let studentWallet = document.querySelector(".coin--amount");
let studentWalletAmount;
let oldSelectedItem;

if(getPageCategory()){
    if(!document.querySelector(".list--item-selected")){
        hideClothing.classList.add("list--item-selected");
    }
}

// list--item-delete

// REMOVE CLOTHING -------------------------------------
if(getPageCategory()){
    hideClothing.addEventListener("click", (e) => {
        e.preventDefault();
        console.log("remove");
        changeSelection(hideClothing);
        studentPedestal.removeChild(document.querySelector(".character--"+getPageCategory()));
        if(getPageCategory()=="shoes"){
            document.querySelector(".character--feet").style.display = "flex";
        }
        if(getPageName()=="wardrobe"){
            // Post to database
            let formData = new FormData();
            formData.append('page', getPageName());
            formData.append('accessoriesId', oldSelectedItem.dataset.item);
            formData.append('removeClothing', 1);
            formData.append('studentName', student.dataset.student);

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
        }
    })
}
// REMOVE CLOTHING -------------------------------------
// WARDROBE --------------------------------------------
wardrobeItems.forEach(wardrobeItem => {
    wardrobeItem.addEventListener('click', (e) => {
        e.preventDefault();
        wardrobeCategory = getPageCategory();
        showClothingOnCharacter(wardrobeCategory, wardrobeItem);
        changeSelection(wardrobeItem);
        // Post to database
        let formData = new FormData();
        formData.append('page', getPageName());
        formData.append('oldAccessoriesId', oldSelectedItem.dataset.item);
        formData.append('accessoriesId', selectedItem.dataset.item);
        formData.append('removeClothing', 0);

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
        changeSelection(shopItem);
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
    if(document.querySelector(targetDivClass)){
        let targetDiv = document.querySelector(targetDivClass);
        targetDiv.innerHTML = '<img src="'+item.dataset.path+'" alt="character '+category+'"></img>';
    }else{
        const div = document.createElement("div");
        div.classList.add("character--"+category);
        div.classList.add("character-alignment");
        div.classList.add("character-clothes");
        const image = document.createElement("img");
        image.src = item.dataset.path;
        div.appendChild(image);
        studentPedestal.appendChild(div);
    }
}
function selectListItem(item){
    item.classList.add("list--item-selected");
    selectedItem = item;
}

function changeSelection(newItem){
    oldSelectedItem = document.querySelector(".list--item-selected");
    oldSelectedItem.classList.remove("list--item-selected");
    selectListItem(newItem);
}