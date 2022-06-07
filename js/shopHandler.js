var shopItems = document.querySelectorAll(".list--item-shop");
let selectedItem;
const buyButton = document.querySelector(".button-buy");
const popup = document.querySelector(".popup");
const popupBuy = document.querySelector(".popup-buy");
const btnBuyAccept = document.querySelector(".popup-buy .button-accept");
const btnBuyDecline = document.querySelector(".popup-buy .button-decline");
const student = document.querySelector(".character");
const itemName = document.querySelector(".item-name");
const itemPrice = document.querySelector(".item-price");
let studentWallet = document.querySelector(".coin--amount");
let studentWalletAmount;

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