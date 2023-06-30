function confirmEmail() {
    var email = document.getElementById("email").value
    var confemail = document.getElementById("confEmail").value
    if(email != confemail) {
        alert('Email Not Matching!');
    }
}

function togglePassword() {
    var x = document.getElementById("pass");
    var y = document.getElementById("confPass");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    if (y.type === "password") {
      y.type = "text";
    } else {
      y.type = "password";
    }
    
  }

function confirmPassword() {
    var pass = document.getElementById("pass").value
    var confpass = document.getElementById("confPass").value
    if(pass != confpass) {
        alert('Password Not Matching!');
    }
}