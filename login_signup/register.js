const registerForm = document.querySelector("#registerForm");
let nameErr = document.querySelector("#nameErr");
let emailErr = document.querySelector("#mailErr");
let passErr = document.querySelector("#passErr");
let confirmErr = document.querySelector("#confirmErr");


const registerPattern = {
  name: /^([A-Z][a-z]{1,15})(\.[a-z]{2,10})?$/,
  email: /^([a-z\d._]{5,20})@([a-z]{2,10})\.([a-z]{2,10})(\.[a-z]{2,10})?$/,
	pass : /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[!@#$%^&*_?(){}|><.,])([A-Za-z\d!@#$%^&*_?(){}|><.,]{8,})$/
}

registerForm.addEventListener("submit", (e)=>{
  e.preventDefault();
  let user = registerForm.name;
  let email = registerForm.email;
  let pass = registerForm.pass;
  let confirmPass = registerForm.confirmPass;

  nameErr.style.opacity = 1;
  emailErr.style.opacity = 1;
  passErr.style.opacity = 1;
  confirmErr.style.opacity = 1;
  if(user.value=="")
  {
    nameErr.textContent = "Empty field";
    user.style.borderBottom = "2px solid red";
  }
  else
  {
    if(!user.value.match(registerPattern.name))
    {
      nameErr.textContent = "Write in sentence case";
      user.style.borderBottom = "2px solid red";
    }
    else
    {
      user.style.borderBottom = "2px solid green";
      nameErr.style.opacity = 0;
    }
  }

  if(email.value=="")
  {
    emailErr.textContent = "Empty field";
    email.style.borderBottom = "2px solid red";
  }
  else
  {
    if(!email.value.match(registerPattern.email))
    {
      emailErr.textContent = "Write a valid email address.";
      email.style.borderBottom = "2px solid red";
    }
    else
    {
      email.style.borderBottom = "2px solid green";
      emailErr.style.opacity = 0;
    }
  }

  if(pass.value=="")
  {
    passErr.textContent = "Empty field";
    pass.style.borderBottom = "2px solid red";
  }
  else
  {
    if(!pass.value.match(registerPattern.pass))
    {
      passErr.textContent = "Enter a strong password only.";
      pass.style.borderBottom = "2px solid red";
    }
    else
    {
      pass.style.borderBottom = "2px solid green";
      passErr.style.opacity = 0;
    }
  }

  if(confirmPass.value=="")
  {
    confirmPass.style.borderBottom = "2px solid red";
    confirmErr.textContent = "Empty field";
  }
  else
  {
    if(pass.value!=confirmPass.value)
    {
      confirmPass.style.borderBottom = "2px solid red";
      confirmErr.textContent = "Password do not match";
    }
    else
    {
      confirmPass.style.borderBottom = "2px solid green";
      confirmErr.style.opacity = 0;
    }
  }

  if(nameErr.style.opacity == 0 && emailErr.style.opacity == 0 && passErr.style.opacity == 0 && confirmErr.style.opacity == 0)
  {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "signUp.php", true);
    xhr.onload = ()=>{
      if(xhr.status===200)
      {
        let responseData = xhr.responseText;
        if(responseData == "Success")
        {
          user.style.borderBottom = "1px solid rgba(109, 93, 93, 0.4)";
          email.style.borderBottom = "1px solid rgba(109, 93, 93, 0.4)";
          pass.style.borderBottom = "1px solid rgba(109, 93, 93, 0.4)";
          confirmPass.style.borderBottom = "1px solid rgba(109, 93, 93, 0.4)";
          registerForm.reset();
          window.location.href = "../admin.php";
        }
        else
        {
          alert(responseData);
        }
      }
      else
      {
        console.error("Status error !== 200");
      }
    }
    $sendData = {name: user.value, email: email.value, password: pass.value};
    $sendMyData = JSON.stringify($sendData);
    xhr.send($sendMyData);
  }

})