/****************************************
************* Comments view *************
****************************************/

// Refresh comments list
function refresh() {
  //clear comments list then reload
  let commentsList = document.getElementById('commentsList');
  commentsList.innerHTML = "";
  fetch('services/ajaxComment.php?find=all')
    .then(res => res.json())
    .then(data => {
      for (let i=0; i<data.length; i++){
        let div = document.createElement('div');
        commentsList.prepend(div);
        div.setAttribute('class', 'com-client');
        let p1 = document.createElement('p');
        p1.setAttribute('class', 'client');
        p1.innerHTML = data[i].name;
        div.appendChild(p1);
        let p2 = document.createElement('p');
        p2.setAttribute('class', 'date'); 
        let date = new Date(data[i].date);
        let options = {weekday:'long', year: 'numeric', month: 'long', day: 'numeric'}
        let newDate = date.toLocaleDateString('fr-CA', options)
        p2.innerHTML = newDate;
        div.appendChild(p2);
        let p3 = document.createElement('p');
        p3.innerHTML = data[i].comment;
        div.appendChild(p3);
      }
    })
    .catch(err => console.error(err));
  }

// Add new comment
function addComment(form) {
  fetch('services/ajaxComment.php',
    {
      method: 'post',
      body: form
    })
    .then(res => res.text())
    .then(msg => {
      let $commentForm = document.getElementById('commentaires');
      let message = document.createElement('p');
      if (msg.length === 0) {
        //check comment then add it to the list
        message.textContent = "Commentaire enregistré";
        message.setAttribute('class', 'returnMessage');
        $commentForm.appendChild(message);
        //empty the form
        $commentForm.reset();
        //refresh comments list
        refresh();
      } else {
        //check comment. If not ok, error message
        message.setAttribute('class', 'returnErrorMessage');
        message.textContent = "Echec lors de l'enregistrement, avez-vous rempli tous les champs?";
        $commentForm.appendChild(message);
      }
    })
}

/****************************************
********* Contact view ***********
****************************************/

function contactEmail(form) {
  fetch('services/ajaxContact.php',
    {
      method: 'post',
      body: form
    })
    .then(res => res.text())
    .then(msg => {
      let $contactForm = document.getElementById('contact');
      let message = document.createElement('p');
      if (msg.length !== 0) {
        //if the email was sent
        message.setAttribute('class', 'returnMessage'); 
        message.textContent = "Votre message a bien été envoyé";
        $contactForm.appendChild(message);
        //empty the form
        $contactForm.reset();
      } else {
        //if the email wasn't sent, error message
        message.textContent = "Votre message n'a pas pu être envoyé";
        message.setAttribute('class', 'returnErrorMessage'); 
        $contactForm.appendChild(message);
      }
    })
}

/****************************************
********* Auth view ***********
****************************************/

function login(form) {
  fetch('./../../services/login.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.text())
  .then(msg => {
    if (msg.length !== 0) {
      //if login not OK
    let $missingInput = document.getElementById('missingInput');
    $missingInput.innerHTML=msg;
    $missingInput.classList.remove('hide');
    } else {
      //if login OK
      document.location.href="administrateur.php";
    }
  })
}

/****************************************
********* Administrateur view ***********
****************************************/

/******** Modifier le compte **********/

function changePassword(form) {
  let $missingPwd = document.getElementById('missingPwd');
  let $adminForm = document.getElementById('adminForm');
  fetch('./../../services/login.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.text())
  .then(msg => {
    if (msg.length === 0) {
      $missingPwd.innerHTML = " Echec lors de la modification";
      $missingPwd.classList.remove('hide');
      $missingPwd.setAttribute('class', 'returnErrorMessage');;
    } else {
      $missingPwd.innerHTML = " Le mot de passe a bien été changé";
      $missingPwd.setAttribute('class', 'returnMessage');
      $missingPwd.classList.remove('hide');
    }
    //clear the form
    $adminForm.reset();
  })
}

function changeEmail(form) {
  let $missingMail = document.getElementById('missingMail');
  let $adminForm = document.getElementById('adminForm');
  fetch('./../../services/login.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.text())
  .then(msg => {
    console.log(msg)
    if (msg.length > 0) {
      $missingMail.innerHTML = " L'adresse email a bien été changée";
      $missingMail.classList.remove('hide');
      $missingMail.setAttribute('class', 'returnMessage');;
    } else {
      $missingMail.innerHTML = " Echec lors de la modification";
      $missingMail.classList.remove('hide');
      $missingMail.setAttribute('class', 'returnErrorMessage');;
    }
    //clear the form
    $adminForm.reset();
  })
}

function changeUser(form) {
  let $errorForm = document.getElementById('errorForm');
  let $adminForm = document.getElementById('adminForm');
  fetch('./../../services/login.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.text())
  .then(msg => {
    console.log(msg)
    if (msg.length > 0) {
      $errorForm.innerHTML = " Les modification ont été prise en compte";
      $errorForm.classList.remove('hide');
      $errorForm.setAttribute('class', 'returnMessage');;
    } else {
      $errorForm.innerHTML = " Echec lors de la modification";
      $errorForm.classList.remove('hide');
      $errorForm.setAttribute('class', 'returnErrorMessage');;
    }
    //clear the form
    $adminForm.reset();
  })
}

/****** Modifier les commentaires ********/

// Refresh Admin comments list
function refreshAdmin() {
  //clear comments list then reload
  let adminCommentsList = document.getElementById('adminCommentsList');
  adminCommentsList.innerHTML = "";
  fetch('./../../services/ajaxComment.php?find=all')
    .then(res => res.json())
    .then(data => {
      for (let i=0; i<data.length; i++){
        let div = document.createElement('div');
        adminCommentsList.prepend(div);
        let label = document.createElement('label');
        label.innerHTML = data[i].name + " : " + data[i].comment;
        adminCommentsList.prepend(label);
        let input = document.createElement('input');
        input.setAttribute ('type', 'checkbox')
        input.setAttribute ('name', 'comments[]')
        input.value = data[i].id ;
        adminCommentsList.prepend(input);
        let hr = document.createElement('hr');
        adminCommentsList.prepend(hr);
      }
    })
    .catch(err => console.error(err));
  }

// Delete comments from Admin comments list
function removeComment(form) {
  fetch('./../../services/ajaxComment.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.text())
  .then(msg => {
    let $deleteComment = document.getElementById('deleteComment');
    //clear error message
    $deleteComment.innerHTML = "";
    if (msg.length == 0) {
      $deleteComment.innerHTML = "Vous devez sélectionner au moins un commentaire";
      $deleteComment.setAttribute('class', 'returnErrorMessage');
    } else {
      refreshAdmin();
      $deleteComment.innerHTML = "Commentaire supprimé";
      $deleteComment.setAttribute('class', 'returnMessage');
    }
  })
}

/*********** Clients *************/

function insertCustomer(form) {
  let $missingCustomer = document.getElementById('missingCustomer');
  let $newCustomForm = document.getElementById('newCustomer');
  fetch('./../../services/ajaxCustomer.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.text())
  .then(msg => {
    if (msg.length === 0) {
      $missingCustomer.innerHTML = " Le client a bien été enregistré";
      $missingCustomer.classList.remove('hide');
      $missingCustomer.setAttribute('class', 'returnMessage');
    } else {
      $missingCustomer.innerHTML = msg;
      $missingCustomer.classList.remove('hide');
      $missingCustomer.setAttribute('class', 'returnErrorMessage');
    }
    //clear form
    $newCustomForm.reset();
  })
}

function searchCustomers(val) {
  let $result = document.getElementById('result');
  $result.innerHTML = "";
  fetch(`./../../services/ajaxCustomer.php?lastname=${val}`)
    .then(res => res.json())
    .then(data => {
      for (let i=0; i<data.length; i++){
        let div = document.createElement('div');
        $result.prepend(div);
        let label = document.createElement('label');
        label.innerHTML = data[i].lastname + " " + data[i].firstname;
        $result.prepend(label);
        let input = document.createElement('input');
        input.setAttribute ('type', 'checkbox')
        input.setAttribute ('name', 'customers[]')
        input.value = data[i].id ;
        $result.prepend(input);
      }
    })
    .catch(err => console.error(err));
}

function changeCustomerEmail(form) {
  fetch('./../../services/ajaxCustomer.php',
  {
    method: 'post',
    body: form
  })
  .then(res => res.text())
  .then(msg => {
    let $missingCustomerChange = document.getElementById('missingCustomerChange');
    let $searchForm = document.getElementById('searchCustomer');
    let $changeForm = document.getElementById('changeCustomer');
    $searchForm.reset();
    $changeForm.reset();
    let $result = document.getElementById('result');
    $result.innerHTML = "";
    $missingCustomerChange.innerHTML="";
    $missingCustomerChange.innerHTML = msg;
    $missingCustomerChange.setAttribute('class', 'returnMessage');
  })
}

function changeCustomerPhone(form) {
  fetch('./../../services/ajaxCustomer.php',
  {
    method: 'post',
    body: form
  })
  .then(res => res.text())
  .then(msg => {
    let $missingCustomerChange = document.getElementById('missingCustomerChange');
    let $searchForm = document.getElementById('searchCustomer');
    let $changeForm = document.getElementById('changeCustomer');
    $searchForm.reset();
    $changeForm.reset();
    let $result = document.getElementById('result');
    $result.innerHTML = "";
    $missingCustomerChange.innerHTML="";
    $missingCustomerChange.innerHTML = msg;
    $missingCustomerChange.setAttribute('class', 'returnMessage');
  })
}

/********** Facturation ************/

function refreshActions() {
  //load latest actions
  let $actions = document.getElementById('actions'); 
  fetch('./../../services/ajaxInvoice.php?find=latest')
    .then(res => res.json())
    .then(data => {
      for (let i=0; i<data.length; i++){
        let ul = document.createElement('ul');
        let li1 = document.createElement('li');
        let li2 = document.createElement('li');
        let li3 = document.createElement('li');
        ul.classList.add('actions')
        let date = new Date(data[i].date);
        let options = {year: 'numeric', month: 'long', day: 'numeric'}
        let newDate = date.toLocaleDateString('fr-CA', options)
        li1.innerHTML = newDate;
        li2.innerHTML = data[i].lastname.toUpperCase();
        li3.innerHTML = data[i].firstname;
        $actions.appendChild(ul);
        ul.appendChild(li1);
        ul.appendChild(li2);
        ul.appendChild(li3);
      }
    })
    .catch(err => console.error(err));
}

function allActions() {
  fetch('./../../services/ajaxInvoice.php?find=all')
    .then(res => res.json())
    .then(data => {
      let $allActions = document.getElementById('allActions'); 
      for (let i=0; i<data.length; i++){
        let ul = document.createElement('ul');
        let li1 = document.createElement('li');
        let li2 = document.createElement('li');
        let li3 = document.createElement('li');
        ul.classList.add('actions')
        let date = new Date(data[i].date);
        let options = {year: 'numeric', month: 'long', day: 'numeric'}
        let newDate = date.toLocaleDateString('fr-CA', options)
        li1.innerHTML = newDate;
        li2.innerHTML = data[i].lastname.toUpperCase();
        li3.innerHTML = data[i].firstname;
        $allActions.appendChild(ul);
        ul.appendChild(li1);
        ul.appendChild(li2);
        ul.appendChild(li3);
      }
    })
    .catch(err => console.error(err));
}

function searchInvoice(val) {
  let $resultInvoices = document.getElementById('resultInvoices');
  $resultInvoices.innerHTML = "";
  fetch(`./../../services/ajaxInvoice.php?nameCustomerInv=${val}`)
    .then(res => res.json())
    .then(data => {
      for (let i=0; i<data.length; i++){
        let div = document.createElement('div');
        $resultInvoices.prepend(div);
        let label = document.createElement('label');
        label.innerHTML = "Facture n° " + data[i].idInvoice + " - Client : " + data[i].lastname + " " + data[i].firstname;
        $resultInvoices.prepend(label);
        let input = document.createElement('input');
        input.setAttribute ('type', 'radio')
        input.setAttribute ('name', 'invoices[]')
        input.value = data[i].idInvoice ;
        $resultInvoices.prepend(input);
      }
    })
    .catch(err => console.error(err));
}

function editClientInvoice(form) {
  fetch('./../../services/ajaxInvoice.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.json())
  .then(data => {
    let $invoicePrint = document.getElementById('invoicePrint');
    let $chosenInvoice = document.getElementById('chosenInvoice');
    let $searchInvoices = document.getElementById('searchInvoices');
    let $resultInvoices = document.getElementById('resultInvoices');
    $invoicePrint.classList.add('invoicePrint');
    let p1 = document.createElement('p');
    let p2 = document.createElement('p');
    let p3 = document.createElement('p');
    let p4 = document.createElement('p');
    p1.innerHTML = data.lastname.toUpperCase() + " " + data.firstname;
    p2.innerHTML = data.email;
    p3.innerHTML = data.phone;
    let date = new Date(data.date);
    let options = {weekday:'long', year: 'numeric', month: 'long', day: 'numeric'}
    let newDate = date.toLocaleDateString('fr-CA', options)
    p4.innerHTML = "Date d'intervention: " + newDate;
    $chosenInvoice.appendChild(p1);
    $chosenInvoice.appendChild(p2);
    $chosenInvoice.appendChild(p3);
    $chosenInvoice.appendChild(p4);
    $searchInvoices.reset();
    $resultInvoices.innerHTML ="";
  })
  .catch(err => console.error(err));
}

function editInvoice(form) {
  fetch('./../../services/ajaxInvoice.php',
    {
      method: 'post',
      body: form
    })
  .then(res => res.json())
  .then(data => {
    let $chosenInvoiceTwo = document.getElementById('chosenInvoiceTwo'); 
    let $invoiceDetails = document.getElementById('invoiceDetails');
    for (let i=0; i<data.length; i++){
      $invoiceDetails.classList.remove('hide');
      let ul = document.createElement('ul');
      ul.classList.add('invoice')
      let li1 = document.createElement('li');
      let li2 = document.createElement('li');
      let li3 = document.createElement('li');
      let li4 = document.createElement('li');
      li1.innerHTML = data[i].product;
      li2.innerHTML = data[i].unitprice + " € ";
      li3.innerHTML = data[i].quantity;
      li4.innerHTML = parseInt(data[i].quantity)*parseInt(data[i].unitprice)+ " € ";
      $chosenInvoiceTwo.appendChild(ul);
      ul.appendChild(li1);
      ul.appendChild(li2);
      ul.appendChild(li3);
      ul.appendChild(li4);
    }
  })
  .catch(err => console.error(err));
}

function totalInvoice(form){
  fetch('./../../services/ajaxInvoice.php',
    {
      method: 'post',
      body: form
    })
    .then(res => res.json())
    .then(data => {
      let $chosenInvoiceThree = document.getElementById('chosenInvoiceThree');  
      let p = document.createElement('p');
      p.innerHTML = "Montant HT total : " + data.total + " €";
      $chosenInvoiceThree.appendChild(p);
      let TVA = data.total * 20/100
      let p2 = document.createElement('p');
      p2.innerHTML = "Montant TVA : " + TVA + " €";
      $chosenInvoiceThree.appendChild(p2);
      let total = parseInt(data.total) + TVA
      let p3 = document.createElement('p');
      p3.innerHTML = "Montant TOTAL : " + total + " €";
      p.classList.add('total');
      p2.classList.add('total');
      p3.classList.add('total');
      p3.classList.add('active');
      $chosenInvoiceThree.appendChild(p3);
    })
    .catch(err => console.error(err));
  }

/********* Deconnexion ***********/

function logout() {
  fetch('./../../services/login.php?action=logout')
  .then(response => response.json())
  .then(data => {
    if (data.session === null) {
      //console.log('deconnexion');
      document.location.href="./../../index.php";
    }
  })
  .catch(err=>console.log(err));
}

export { refresh, refreshAdmin, addComment, removeComment, contactEmail, login, changePassword, changeEmail, changeUser, insertCustomer, searchCustomers, refreshActions, allActions, searchInvoice, editClientInvoice, editInvoice, totalInvoice, changeCustomerEmail, changeCustomerPhone, logout };