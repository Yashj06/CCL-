function validateUser(){
    let username = document.getElementById("username").value;
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmpassword").value;
    let nameRegex = "/^[a-zA-Z ]+$/";
    let emailRegex = "^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$";
    let passwordRegex = "/^[a-zA-Z0-9]+$/";

    //Username Validation
    if(username == "" || username.length == 0){
        alert("Username field is Empty!");
        return false;
    }
    else if(username.length < 5){
        alert("Username is too Short!");
        return false;
    }
    else if(username.length > 30){
        alert("Username is too Long!");
        return false;
    }
    else if(nameRegex.test(username) == false){
        alert("Username does not match the Requirements!");
        return false;
    }
    //Email ID
    else if(email == "" || email.length == 0){
        alert("Email ID Field is Empty!");
        return false;
    }
    else if(emailRegex.test(email) == false){
        alert("Wrong Email ID Format!");
        return false;
    }

    //Password Validation
    else if(password == "" || password.length == 0){
        alert("Password Field is Empty!");
        return false;
    }
    else if(password.length < 5){
        alert("Password is too Short!");
        return false;
    }
    else if(password.length > 30){
        alert("Password is too long!");
        return false;
    }
    else if(passwordRegex.test(password) == false){
        alert("Password does not match the Requirements!");
        return false;
    }

    //Confirm Password Validation
    else if(password != confirmPassword){
        alert("Passwords do not Match!");
        return false;
    }

    //Validate User
    else{
        return true;
    }
}