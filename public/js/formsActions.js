function confirmEmail() {
    let email = document.getElementById("email").value
    let confemail = document.getElementById("confEmail").value
    if(email != confemail) {
        alert('Email Not Matching!');
    }
}

function confirmNewEmail() {
  let email = document.getElementById("email").value
  let confemail = document.getElementById("confEmail").value
  if(email != confemail) {
      alert("New e-mail and e-mail confirmation isn't Matching!");
  }
}

function togglePassword() {
    let x = document.getElementById("pass");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    } 
  }

function confirmPassword() {
    let pass = document.getElementById("pass").value
    let confpass = document.getElementById("confPass").value
    if(pass != confpass) {
        alert('Password Not Matching!');
    }
}