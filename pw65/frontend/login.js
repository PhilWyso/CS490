
function login(form){
	var ajax=new XMLHttpRequest();
	ajax.onreadystatechange = function(){
    document.getElementById("demo").innerHTML = "loading...";
		if(ajax.readyState == 4 && ajax.status == 200){
			
			document.getElementById("demo").innerHTML = this.responseText;
			return;
		}
	}
	ajax.open("POST", "../frontend/login.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("username="+form.username.value+"&password="+form.password.value);
}
