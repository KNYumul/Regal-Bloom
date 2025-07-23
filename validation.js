const form = document.querySelector('form');

let namePattern = /^([A-Za-z ,.'`-]{4,31})$/;
let phonePattern = /^([+]?\d{1,2}[-\s]?|)\d{3}[-\s]?\d{3}[-\s]?\d{4}$/
let emailPattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
let passwordPattern = /^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/

form.addEventListener('submit', (event) => {

    let phonetrim = form.contact.value.trim();

    let fnameCheck = namePattern.test(form.fname.value);
    let mnameCheck = namePattern.test(form.mname.value);
    let lnameCheck = namePattern.test(form.lname.value);

    let phoneCheck = phonePattern.test(phonetrim);

    let emailCheck = emailPattern.test(form.email.value);
    let passwordCheck = passwordPattern.test(form.pass.value);

    if(
        fnameCheck && 
        mnameCheck && 
        lnameCheck && 
        phoneCheck && 
        emailCheck && 
        passwordCheck) {

        // alert('Form submitted successfully!');
    
    }else {

        event.preventDefault();
        alert('Please check your input!');
        if(!fnameCheck) {
            alert('First name is invalid!');
        }
        if(!mnameCheck) {
            alert('Middle name is invalid!');
        }
        if(!lnameCheck) {
            alert('Last name is invalid!');
        }
        if(!phoneCheck) {
            alert('Phone number is invalid!');
        }
        if(!emailCheck) {
            alert('Email is invalid!');
        }
        if(!passwordCheck) {
            alert('Password is invalid!');
        }
        if(!phonetrim) {
            alert('Phone number is empty!');
        }
        if(!form.fname.value) {
            alert('First name is empty!');
        }
        if(!form.mname.value) {
            alert('Middle name is empty!');
        }
        if(!form.lname.value) {
            alert('Last name is empty!');
        }
        if(!form.email.value) {
            alert('Email is empty!');
        }
        if(!form.pass.value) {
            alert('Password is empty!');
        }
        if(!form.confpass.value) {
            alert('Confirm password is empty!');
        }
        if(form.pass.value !== form.confpass.value) {
            alert('Password and confirm password do not match!');
        }
        if(form.pass.value.length < 6) {
            alert('Password must be at least 6 characters long!');
        }
        if(form.pass.value.length > 20) {
            alert('Password must be at most 20 characters long!');
        }
        if(form.pass.value === form.cpass.value) {
            alert('Password and confirm password match!');
        }

    }

});