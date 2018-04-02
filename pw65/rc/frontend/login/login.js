/*
Philip Wysocki
Login JS
*/

//======================================================================================
//Listeners for Login Fields, one for entering, two for empty inputs
document.querySelector("#loginForm").addEventListener("submit", function(e){
	//preventing default behaviour
	e.preventDefault(); 
	//making a call user userLogin()
	userLogin() 
});

document.querySelector("#username").addEventListener("invalid", function(){
	//checking for length of username
	if(String(this.value).length==0){
		this.setCustomValidity("Username Missing");
	}
	else{
		this.setCustomValidity("");
	}
});

document.querySelector("#password").addEventListener("invalid", function(e){
	//checking for length of password
	if(String(this.value).length==0){
		this.setCustomValidity("Missing password...");
	}
	else{
		this.setCustomValidity("");
	}
});
//======================================================================================
//runs on attempted login
function userLogin(){
	var username = document.getElementById('username');
	var password = document.getElementById('password');

	makeAjaxCall(username.value, password.value);
}
//======================================================================================
//ajax to PHP
function makeAjaxCall(username, password){
	
	var data = 'json_string={"header":"login","username":"'+username+'","password":"'+password+'"}'
  console.log(data);
	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);

	//ajax request was successful
	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response)
			loginAttempt(response, username)
		} else {
			console.log(response)
		}
	};	
}
//======================================================================================
//parses response
function loginAttempt(response, username){
	var responseJSON = JSON.parse(response)
	if(responseJSON =="fail"){	
		console.log("failed Login");
	}
	else{
		window.localStorage.setItem('username', username);
		window.localStorage.setItem('type', responseJSON);

		if(responseJSON=="student"){
			console.log("Student")
			window.location.replace("../student/s-landing.html");
		}
		else if(responseJSON=="teacher"){
			console.log("teacher")
			window.location.replace("../teacher/t-landing.html");
		}
	}
}
//======================================================================================




