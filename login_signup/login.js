document.querySelector('.img-btn').addEventListener('click', function()
	{
		document.querySelector('.cont').classList.toggle('s-signup')
	}
);

const loginForm = document.querySelector("#loginForm");
const errorDiv = document.querySelector(".message");

let pattern = {
	email: /^([A-Za-z\d._]{5,20})@([a-z]{2,10})\.([a-z]{2,10})(\.[a-z]{2,10})?$/,
	pass : /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[!@#$%^&*_?(){}|><.,])([A-Za-z\d!@#$%^&*_?(){}|><.,]{2,})$/
}

loginForm.addEventListener("submit", (e)=>{
	e.preventDefault();
	let email = loginForm.mail;
	let pass = loginForm.pass;

	if(email.value=="" || pass.value == "")
	{
		errorDiv.classList.add("error-message");
		errorDiv.textContent = "Please fill out all the fields";
	}
	else if(!email.value.match(pattern.email))
	{
		errorDiv.classList.add("error-message");
		errorDiv.textContent = "Please check your Email address.";
	}
	else if(!pass.value.match(pattern.pass))
	{
		errorDiv.classList.add("error-message");
		errorDiv.textContent = "Please check your Password.";
	}
	else
	{
		const data = { email: email.value, password: pass.value };

		fetch('login.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify(data)
		})
		.then(response => {
			if (response.ok) {
				return response.text();
			} else {
				throw new Error('Network response was not ok');
			}
		})
		.then(responseData => {
			if (responseData === 'Success') {
				loginForm.reset();
				window.location.href = "../admin.php";
			} else {
				errorDiv.classList.add("error-message");
				errorDiv.textContent = responseData;
			}
		})
		.catch(error => {
			console.error('There was a problem with the fetch operation:', error);
		});
	}
	
})

let removeMessage = ()=>{
	errorDiv.classList.remove("error-message");
	errorDiv.textContent="";
}
loginForm.mail.addEventListener("input", removeMessage);
loginForm.pass.addEventListener("input", removeMessage);