btnSmileys = document.querySelectorAll(".btnSmiley");
btnSmileysSend = document.querySelector("#button-smileys");
smileyBox = document.querySelector(".smileys__choice");
smileyBoxDesc = document.querySelector(".popup-smileys .smileys__explain");
smileyBoxDescText = document.querySelector("#smileys-explainText");
smileyPopup = document.querySelector(".popup-smileys");
let smileyType;
let smileyDescription;
btnSmileys.forEach(btnSmiley => {
    btnSmiley.addEventListener('click', (e) => {
        e.preventDefault();
        smileyType = btnSmiley.dataset.smiley;
        smileyBox.style.display="none";
        smileyBoxDesc.style.display="flex";
    })
})
try{
    btnSmileysSend.addEventListener("click", (e) => {
        e.preventDefault();
        smileyDescription = smileyBoxDescText.value;
        console.log(smileyDescription);
        smileyBoxDesc.style.display="none";
        smileyPopup.style.display="none";
        popup.style.display="none";
        // Post to database
        let formData = new FormData();
        formData.append('smileyDescription', smileyDescription);
        formData.append('smileyId', smileyType);
    
        fetch('ajax/smileyHandler.php', {
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
}catch{

}