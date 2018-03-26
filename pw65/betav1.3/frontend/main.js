
function logOut(){
    console.log("Log out");
    window.localStorage.removeItem('username');
    window.localStorage.removeItem('role')
    window.location.replace("../login/login.html");
}
function loggedIn(){
    var user = window.localStorage.getItem('username');
    console.log(user);
    if(user == null)
        window.location.replace("../login/login.html");
    var role = window.localStorage.getItem('role');
    document.getElementById("userid").innerHTML = "User: "+user
}
function goTo(page){
    window.location.replace(page);
}
function escapeThemAll(escapeMe){
    console.log("BEFORE: "+escapeMe)
    for(var i=0;i<to_escape.length;i++){
        escapeMe = escapeMe.replaceAll(to_escape[i], encodeURIComponent(to_escape[i]))
    }
    console.log("AFTER: "+escapeMe)
    return escapeMe
}
