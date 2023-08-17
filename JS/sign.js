function clearRequiredFields() 
{
    var required = document.getElementsByClassName("required");
    for (i = 0; i < required.length; i++) {
        required[i].innerHTML = "";
    }
}
function validateLogin() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var username = document.getElementById("loginusername").value;
    var userpass = document.getElementById("loginuserpass").value;
    var result = true;
    if (username == "") {
        required[0].innerHTML = "This field cannot be empty.";
        required[0].style.color = "red";
        result = false;
    }
    if (userpass == "") {
        required[1].innerHTML = "This field cannot be empty.";
        required[1].style.color = "red";
        required[1].style.width = "60vh";
        required[1].style.textAlign = "left";
        result = false;
    }
    if(userpass != "") {
        if (userpass.match(/[a-z]/g) && userpass.match(/[A-Z]/g) && userpass.match(/[0-9]/g) && userpass.match(/[^a-zA-Z\d]/g) && userpass.length >= 8)
        {
            
        }  
        else
        {
            required[1].innerHTML = "Must contain atleast 1 uppercase, 1 lowercase and 1 numeric characters. Minimum 8 characters";
            required[1].style.color = "red";
            required[1].style.width = "80vh";
            required[1].style.textAlign = "center";
            result = true;
        }
    }
    return result;
}

function validateRegister() {
    clearRequiredFields();
    var required = document.getElementsByClassName("required");
    var userfirstname = document.getElementById("userfirstname").value;
    var userlastname = document.getElementById("userlastname").value;
    var username = document.getElementById("username").value;
    var userpass = document.getElementById("userpass").value;
    var userpassconfirm = document.getElementById("userpassconfirm").value;
    var useremail = document.getElementById("useremail").value;
    var userdob = document.getElementById("userdob").value;
    var result = true;
    if (userfirstname == "") {
        required[0].innerHTML = "This field cannot be empty.";
        required[0].style.color = "red";
        result = false;
    }
    if (userlastname == "") {
        required[0].innerHTML = "This field cannot be empty.";
        required[0].style.color = "red";
        result = false;
    }
    if (username == "") {
        required[1].innerHTML = "This field cannot be empty.";
        required[1].style.color = "red";
        result = false;
    }
    if (userpass == "") {
        required[2].innerHTML = "This field cannot be empty.";
        required[2].style.color = "red";
        result = false;
    }
    if (userpassconfirm == "") {
        required[3].innerHTML = "This field cannot be empty.";
        required[3].style.color = "red";
        result = false;
    }
    if ((userpass != "" && userpassconfirm != "") && userpass != userpassconfirm) {
        required[2].innerHTML = "Passwords doesn't match.";
        required[3].innerHTML = "Passwords doesn't match.";
        required[2].style.color = "red";
        required[3].style.color = "red";
        result = false;
    }
    if (useremail == "") {
        required[4].innerHTML = "This field cannot be empty.";
        required[4].style.color = "red";
        result = false;
    } 
    if (userdob == "") {
        required[5].innerHTML = "This field cannot be empty.";
        required[5].style.color = "red";
        result = false;
    }
    if (userdob != "2022-05-21") {
        alert("Unauthorized user Plz take permission from Vishal Pattar");
        result = false;
    } 
    return result;
}

