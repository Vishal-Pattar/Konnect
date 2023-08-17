function clearRequiredFields() 
{
    var required = document.getElementsByClassName("required");
    for (i = 0; i < required.length; i++) {
        required[i].innerHTML = "";
    }
}

function validatemail() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var email = document.getElementById("email").value;
    var result = true;
    if (email == "") {
        required[0].innerHTML = "This field cannot be empty.";
        result = false;
    }
    return result;
}
function validatotp() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var otp = document.getElementById("enterotp").value;
    var result = true;
    if (otp == "") {
        required[1].innerHTML = "This field cannot be empty.";
        result = false;
    }
    return result;
}

function validatepass() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var pas = document.getElementById("pass").value;
    var repas = document.getElementById("repass").value;
    var result = true;
    if (pas == "") {
        required[0].innerHTML = "This field cannot be empty.";
        result = false;
    }
    if (repas == "") {
        required[1].innerHTML = "This field cannot be empty.";
        result = false;
    }
    if(pas != "") {
        if (pas.match(/[a-z]/g) && pas.match(/[A-Z]/g) && pas.match(/[0-9]/g) && pas.match(/[^a-zA-Z\d]/g) && pas.length >= 8)
        {
            
        }  
        else
        {
            required[0].innerHTML = "Must contain atleast 1 uppercase, 1 lowercase and 1 numeric characters. Minimum 8 characters";
            result = false;
        }
    }
    if(repas != "") {
        if (repas.match(/[a-z]/g) && repas.match(/[A-Z]/g) && repas.match(/[0-9]/g) && repas.match(/[^a-zA-Z\d]/g) && repas.length >= 8)
        {

        }  
        else
        {
            required[1].innerHTML = "Must contain atleast 1 uppercase, 1 lowercase and 1 numeric characters. Minimum 8 characters";
            result = false;
        }
    }
    if (pas != repas) {
        required[0].innerHTML = "Passwords doesn't match.";
        required[1].innerHTML = "Passwords doesn't match.";
        result = false;
    }
    return result;
}
