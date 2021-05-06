import * as callback from './ajaxFunctions.js';

document.addEventListener('DOMContentLoaded', function() {
   //Regex
   let validName = /^[a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+([-'\s][a-zA-ZÊÈÉÀéèêîïà][a-zéèêîïçà]+)?/;
   let validPhone = /[0-9]{10}/;
   let validEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   let validPass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

   /****************************************
   ************ Comments view **************
   ****************************************/
   
   let $btnComment = document.getElementById('commentButton');
   let $commentForm = document.getElementById('commentaires');
   if ($btnComment) {
      //function refresh for automatic display of comments
      callback.refresh();
      //Comment Form Verification
      $commentForm.addEventListener('submit', function(e){
         let $lastName = document.getElementById('lastName');
         let $missingLastName = document.getElementById('missingLastName');
         let $comment = document.getElementById('comment');
         let $missingComment = document.getElementById('missingComment');
         //check if input name not empty and Ok with RegEx
         if(($lastName.value !== '' && validName.test($lastName.value)===true)) {
            //clear error message
            $missingLastName.classList.add('hide');
            //check if comment not empty and < 500 characters
            if($comment.value !== '' && $comment.value.length < 500) {
               //clear error message
               $missingComment.classList.add('hide');
               e.preventDefault();
               const form = new FormData(this);
               //send form to AJAX then PHP
               callback.addComment(form);
            } else {
               //error message
               e.preventDefault();
               $missingComment.classList.remove('hide');
            }
         } else {
            //error message
            e.preventDefault();
            $missingLastName.classList.remove('hide');
            $missingComment.classList.add('hide');
         }
      })
   }

   /****************************************
   ************ Contact view **************
   ****************************************/

   //Contact Form Verification 
   let $btnContact = document.getElementById('contactButton');
   let $contactForm = document.getElementById('contact');
   if ($btnContact) {
      $contactForm.addEventListener('submit', function(e){
         let $name = document.getElementById('name');
         let $missingName = document.getElementById('missingName');
         let $phone = document.getElementById('phone');
         let $missingPhone = document.getElementById('missingPhone');
         let $email = document.getElementById('email');
         let $missingEmail = document.getElementById('missingEmail');
         let $politiqueInput = document.getElementById('politique');
         if(($name.value !== '' && validName.test($name.value)===true)) {
            //name validation and clear error message
            $missingName.classList.add('hide');
            if(($phone.value !== '' && validPhone.test($phone.value)===true)) {
               //phone validation and clear error message
               $missingPhone.classList.add('hide');
               //check if "politique de confidentialté" is checked
               if ($politiqueInput.checked) {
                  if(($email.value !== '' && validEmail.test($email.value)===true)) {
                     //email validation and clear error message
                     $missingEmail.classList.add('hide');
                     e.preventDefault();
                     const form = new FormData(this);
                     //send form to AJAX then PHP
                     callback.contactEmail(form);
                  } else {
                     //error message
                     e.preventDefault();
                     $missingEmail.classList.remove('hide');
                  }
               } else {
                  //error message
                  e.preventDefault();
                  $missingEmail.innerHTML = "Le champ ci-dessous est obligatoire";
                  $missingEmail.classList.remove('hide');
               }
            } else {
               //error message
               e.preventDefault();
               $missingPhone.classList.remove('hide');
            }
         } else {
            //error message
            e.preventDefault();
            $missingName.classList.remove('hide');
         }
      })
   }

   /****************************************
   ************** Auth view ****************
   ****************************************/

   let $btnLogin = document.getElementById('loginButton');
   let $loginForm = document.getElementById('login');
   if ($btnLogin) {
      $loginForm.addEventListener('submit', function(e){
         e.preventDefault()
         let $userName = document.getElementById('userName');
         let $missingInput = document.getElementById('missingInput');
         let $password = document.getElementById('password');
         if($userName.value !== '' && $password.value !== '') {
            $missingInput.classList.add('hide');
            const form = new FormData(this);
            //send form to AJAX then PHP
            callback.login(form);
         } else {
            //error message
            e.preventDefault();
            $missingInput.classList.remove('hide');
         }
      })
   }

   /****************************************
   ********* Administrateur view ***********
   ****************************************/
   
   /******** Modifier le compte **********/

   //change admin password
   let $adminButton = document.getElementById('adminButton');
   let $adminForm = document.getElementById('adminForm');
   /* ***************************
   * Un mot de passe valide aura:
   * de 8 à 15 caractères
   * au moins une lettre minuscule
   * au moins une lettre majuscule
   * au moins un chiffre
   * au moins un caractère spécial
   * ************************** */
   if ($adminButton) {
      $adminForm.addEventListener ('submit', function(e){
         e.preventDefault();
         let $newPwd = document.getElementById('newPwd');
         let $missingPwd = document.getElementById('missingPwd');
         let $pwd_confirm = document.getElementById('pwd_confirm');
         let $newEmail = document.getElementById('newEmail');
         let $missingMail = document.getElementById('missingMail');
         let $email_confirm = document.getElementById('email_confirm');
         let $errorForm = document.getElementById('errorForm');
         //check if password and password-confirm inputs are not empty OR if email and email confirm are not empty
         if(($newPwd.value !== '' && $pwd_confirm.value !== '') || ($newEmail.value !== '' && $email_confirm.value !== '')) {
            //if password and password-confirm inputs are not empty AND email or email confirm are empty -> change only the password
            if ($newPwd.value !== '' && $pwd_confirm.value !== '' && ($newEmail.value === '' || $email_confirm.value === '')) {
               //check if pwd = pwd confirm
               if($newPwd.value === $pwd_confirm.value) {
                  //check if password is OK with regex
                  if(validPass.test($newPwd.value)===true) {
                     //update the password
                     //clear message error
                     $errorForm.classList.add('hide');
                     $missingPwd.classList.add('hide');
                     $missingMail.classList.add('hide');
                     e.preventDefault();
                     const form = new FormData(this);
                     //send form to AJAX then PHP
                     callback.changePassword(form);
                  } else {
                     //error message
                     e.preventDefault();
                     $missingMail.classList.add('hide')
                     $errorForm.classList.add('hide');
                     $missingPwd.innerHTML = "Le mot de passe ne correspond pas à la syntaxe demandé : caractères ( 8à 15), et au moins une lettre minuscule, majuscule, un chiffre, un caractère spécial";
                     $missingPwd.setAttribute('class', 'returnErrorMessage');
                     $missingPwd.classList.remove('hide');
                  }
               } else {
                  //error message
                  e.preventDefault();
                  $errorForm.classList.add('hide');
                  $missingMail.classList.add('hide');
                  $missingPwd.innerHTML = " Les mots de passe ne sont pas identiques";
                  $missingPwd.setAttribute('class', 'returnErrorMessage');
                  $missingPwd.classList.remove('hide');
               }
            //if password or password-confirm inputs are empty AND email and email confirm are not empty -> change only the email
            } else if (($newPwd.value === '' || $pwd_confirm.value === '') && $newEmail.value !== '' && $email_confirm.value !== '') {
               //check if email is OK with Regex
               if (validEmail.test($newEmail.value)===true) {
                  //check if email = email confirm
                  if($newEmail.value === $email_confirm.value) {
                     //update email
                     //clear error message
                     $errorForm.classList.add('hide');
                     $missingMail.classList.add('hide');
                     $missingPwd.classList.add('hide');
                     e.preventDefault();
                     const form = new FormData(this);
                     //send form to AJAX then PHP
                     callback.changeEmail(form);
                  } else {
                     //error message
                     e.preventDefault();
                     $errorForm.classList.add('hide');
                     $missingPwd.classList.add('hide');
                     $missingMail.setAttribute('class', 'returnErrorMessage');
                     $missingMail.innerHTML = " Les adresses email ne sont pas identiques";
                     $missingMail.classList.remove('hide');
                  }
               } else {
                  //error message
                  e.preventDefault();
                  $errorForm.classList.add('hide');
                  $missingPwd.classList.add('hide');
                  $missingMail.setAttribute('class', 'returnErrorMessage');
                  $missingMail.innerHTML = " format de mail invalide";
                  $missingMail.classList.remove('hide');
               }
            //if password and password-confirm inputs are not empty AND email and email confirm are not empty -> change both
            } else if ($newPwd.value !== '' && $pwd_confirm.value !== '' && $newEmail.value !== '' && $email_confirm.value !== ''){
               //check if pwd = pwd confirm
               if($newPwd.value === $pwd_confirm.value) {
                  //check if pwd is OK with Regex
                  if(validPass.test($newPwd.value)===true) {
                     //check if email is OK with Regex
                     if (validEmail.test($newEmail.value)===true) {
                        //check if email = email confirm
                        if($newEmail.value === $email_confirm.value) {
                           //clear error message
                           $errorForm.classList.add('hide');
                           $missingMail.classList.add('hide');
                           $missingPwd.classList.add('hide');
                           e.preventDefault();
                           const form = new FormData(this);
                           //send form to AJAX then PHP
                           callback.changeUser(form);
                        } else {
                           //error message
                           e.preventDefault();
                           $errorForm.classList.add('hide');
                           $missingPwd.classList.add('hide');
                           $missingMail.setAttribute('class', 'returnErrorMessage');
                           $missingMail.innerHTML = " Les adresses email ne sont pas identiques";
                           $missingMail.classList.remove('hide');
                        }
                     } else {
                        //error message
                        e.preventDefault();
                        $errorForm.classList.add('hide');
                        $missingPwd.classList.add('hide');
                        $missingMail.setAttribute('class', 'returnErrorMessage');
                        $missingMail.innerHTML = " format de mail invalide";
                        $missingMail.classList.remove('hide');
                     }
                  } else {
                     //error message
                     e.preventDefault();
                     $errorForm.classList.add('hide');
                     $missingMail.classList.add('hide')
                     $missingPwd.innerHTML = "Le mot de passe ne correspond pas à la syntaxe demandé : caractères ( 8à 15), et au moins une lettre minuscule, majuscule, un chiffre, un caractère spécial";
                     $missingPwd.setAttribute('class', 'returnErrorMessage');
                     $missingPwd.classList.remove('hide');
                  }
               } else {
                  //error message
                  e.preventDefault();
                  $errorForm.classList.add('hide');
                  $missingMail.classList.add('hide');
                  $missingPwd.innerHTML = " Les mots de passe ne sont pas identiques";
                  $missingPwd.setAttribute('class', 'returnErrorMessage');
                  $missingPwd.classList.remove('hide');
               }
            }
         } else {
            //error message
            e.preventDefault();
            $errorForm.classList.add('hide');
            $missingMail.classList.remove('hide');
            $missingPwd.classList.remove('hide');
         }
      })
   }

   /****** Modifier les commentaires ********/

   //delete comments
   let $deleteForm = document.getElementById('deleteForm');
   let $deleteComment = document.getElementById('deleteComment');
   let $btnDelete = document.getElementById('deleteButton');
   if ($btnDelete) {
      //function refreshAdmin for automatic display of comments
      callback.refreshAdmin();
      //delete some comments
      $deleteForm.addEventListener('submit', function(e){
         //clear error message
         $deleteComment.classList.add('hide');
         e.preventDefault();
         const form = new FormData(this);
         //send form to AJAX and PHP
         callback.removeComment(form);
      })
   }

   /*********** Clients *************/

   //insert new customer
   let $btnCustomer = document.getElementById('customerButton');
   let $newCustomForm = document.getElementById('newCustomer');
   if ($btnCustomer) {
      $newCustomForm.addEventListener ('submit', function(e){
         e.preventDefault();
         let $nameCustomer = document.getElementById('nameCustomer');
         let $firstnameCustomer = document.getElementById('firstnameCustomer');
         let $emailCustomer = document.getElementById('emailCustomer');
         let $phoneCustomer = document.getElementById('phoneCustomer');
         let $missingCustomer = document.getElementById('missingCustomer');
         //check if input empty or not
         if($nameCustomer.value !== '' && $firstnameCustomer.value !== '' && $emailCustomer !== '' && $phoneCustomer !== '')  {
            //check if email input ok with Regex
            if (validEmail.test($emailCustomer.value) === true) {
               //check if phone input is OK with Regex
               if (validPhone.test($phoneCustomer.value) === true) {
                  //add new customer
                  //remove error message
                  $missingCustomer.classList.add('hide');
                  e.preventDefault();
                  const form = new FormData(this);
                  //send form to AJAX then PHP
                  callback.insertCustomer(form);
               } else {
                  //error message
                  e.preventDefault();
                  $missingCustomer.innerHTML = " Format de téléphone non valide"
                  $missingCustomer.classList.remove('hide');
               }
            } else {
               //error message
               e.preventDefault();
               $missingCustomer.innerHTML = " Format d'email non valide"
               $missingCustomer.classList.remove('hide');
            }
         } else {
            //error message
            e.preventDefault();
            $missingCustomer.classList.remove('hide');
         }
      })
   }

   //search customer
   let $result = document.getElementById('result');
   let $searchForm = document.getElementById('searchCustomer');
   if ($searchForm) {
      $searchForm.addEventListener ('keyup', function(e){
         //delete empty space in input
         let val = e.target.value.trim();
         if (val.length <1) {
            $result.innerHTML = "";
         } else {
            callback.searchCustomers(val);
         }
      })
   }

   //update customer
   let $changeForm = document.getElementById('changeCustomer');
   let $changeButton = document.getElementById('changeCustomerButton');
   let $missingCustomerChange = document.getElementById('missingCustomerChange');
   let $newCustomerEmail = document.getElementById('newCustomerEmail');
   let $newCustomerPhone = document.getElementById('newCustomerPhone');
   if ($changeButton) {
      $changeForm.addEventListener ('submit', function(e){
         //check if one input (between email and phone) not empty
         if ($newCustomerEmail.value !== ''|| $newCustomerPhone.value !== '') {
            //clear error message
            $missingCustomerChange.classList.add('hide');
            e.preventDefault();
            //send form to AJAX then PHP
            const form = new FormData(this);
            //if email input not empty AND phone input empty
            if ($newCustomerEmail.value !== '' && $newCustomerPhone.value === '') {
               //if email input OK with Regex
               if (validEmail.test($newCustomerEmail.value) === true) {
                  //call function changeCustomerEmail
                  callback.changeCustomerEmail(form);
               } else {
                  //error message
                  e.preventDefault();
                  $missingCustomerChange.innerHTML = "format d'email invalide";
                  $missingCustomerChange.setAttribute('class', 'returnErrorMessage');
                  $missingCustomerChange.classList.remove('hide');
               }
            //if email input empty AND phone input not empty
            } else if($newCustomerEmail.value === '' && $newCustomerPhone.value !== '') {
               //if phone input OK with Regex
               if (validPhone.test($newCustomerPhone.value) === true) {
                  //call function changeCustomerPhone
                  callback.changeCustomerPhone(form)
               } else {
                  //error message
                  e.preventDefault();
                  $missingCustomerChange.innerHTML = "format de téléphone invalide";
                  $missingCustomerChange.setAttribute('class', 'returnErrorMessage');
                  $missingCustomerChange.classList.remove('hide');
               }
            //if email ans phone input not empty
            } else {
               //check with regex
               if (validPhone.test($newCustomerPhone.value) === true && validEmail.test($newCustomerEmail.value) === true)  {
                  //call function changeCustomerEmail
                  callback.changeCustomerEmail(form)
                  //call function changeCustomerPhone
                  callback.changeCustomerPhone(form)
               } else {
                  //error message
                  e.preventDefault();
                  $missingCustomerChange.innerHTML = "format de téléphone ou email invalide";
                  $missingCustomerChange.setAttribute('class', 'returnErrorMessage');
                  $missingCustomerChange.classList.remove('hide');
               }
            }
         } else {
            //error message
            e.preventDefault();
            $missingCustomerChange.classList.remove('hide');
         }
      })
   }

   /********** Facturation ************/

   //last interventions
   let $lastActions = document.getElementById('lastActions');
   let $nextButton = document.getElementById('nextButton');
   if ($nextButton) {
      //function refreshActions for automatic display of latest interventions
      callback.refreshActions();
      //view all interventions 
      $lastActions.addEventListener('submit', function(e){
         //open a new window
         window.open("invoices.php"); 
      })
   }

   //all interventions
   let $allActions = document.getElementById('allActions');
   if ($allActions) {
      callback.allActions();
   }

   //edit Invoice
   let $searchInvoices = document.getElementById('searchInvoices');
   let $editInvoiceButton = document.getElementById('editInvoiceButton');
   let $resultInvoices = document.getElementById('resultInvoices');
   let $editInvoice = document.getElementById('editInvoice');
   if ($searchInvoices) {
      $searchInvoices.addEventListener ('keyup', function(e) {
         //delete empty space in input
         let val = e.target.value.trim();
         if (val.length <1) {
            $resultInvoices.innerHTML = "";
         } else {
            callback.searchInvoice(val);
         }
      })
   }
   if ($editInvoiceButton)  {
      $editInvoice.addEventListener('submit', function(e) {
         e.preventDefault();
         //send 3 forms to AJAX then PHP
         const form = new FormData(this);
         form.append('action', 'clientinfo');
         callback.editClientInvoice(form)
         const newform = new FormData(this);
         newform.append('action', 'invoiceinfo');
         callback.editInvoice(newform);
         const totalform = new FormData(this);
         callback.totalInvoice(totalform);
      })
   }
   
   /********* Deconnexion ***********/
   
   //logout
   let $LogoutButton = document.getElementById('logout');
   if ($LogoutButton) {
      $LogoutButton.addEventListener('click', function(e){
         e.preventDefault();
         callback.logout();
      })
   }
})