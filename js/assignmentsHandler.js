let claimButtons = document.querySelectorAll(".list--item-assignmentsCompletedClaim");
let toDos = document.querySelectorAll(".readDescription");
let popupDescription = document.querySelector(".popup-description");
let popupDescriptionContent = document.querySelector(".popup-descriptionContent");
let btnRead = document.querySelectorAll(".button-read");

claimButtons.forEach(claimButton => {
    claimButton.addEventListener('click', (e) => {
        e.preventDefault();
        let containerSelector = '[data-assignmentContainer="'+e.target.dataset.assignment+'"]';
        let container = document.querySelector(containerSelector);
        container.style.display = "none";
        studentWalletAmount = parseInt(studentWallet.innerHTML)+parseInt(container.dataset.assignmentreward)
        studentWallet.innerHTML = studentWalletAmount;
        // Post to database
        let formData = new FormData();
        formData.append('page', getPageName());
        formData.append('studentName', student.dataset.student);
        formData.append('reward', container.dataset.assignmentreward);
        formData.append('assignment', container.dataset.assignmentcontainer);

        fetch('ajax/assignmentsHandler.php', {
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

toDos.forEach(toDos => {
    toDos.addEventListener('click', (e) => {
        e.preventDefault();
        popup.style.display = "flex";
        console.log(toDos.dataset.descriptionid);
        let popupSelector = '[data-popupAssignment="'+toDos.dataset.descriptionid+'"]';
        let popupDescriptionText = document.querySelector(popupSelector);
        popupDescriptionText.style.display = "flex";
    })
})

btnRead.forEach(btnRead => {
    btnRead.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.reload();
    })
})