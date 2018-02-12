function id(id){
	return document.getElementById(id);
}
function login(form){
	var ajax=new XMLHttpRequest();
	ajax.onreadystatechange = function(){
    document.getElementById("demo").innerHTML = "loading...";
		if(ajax.readyState == 4 && ajax.status == 200){
			var check = ajax.responseText;
			document.getElementById("demo").innerHTML = this.responseText;
			return;
		}
	}
	ajax.open("POST", "../backend/backend.php", true);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajax.send("username="+form.username.value+"&password="+form.password.value);
}
