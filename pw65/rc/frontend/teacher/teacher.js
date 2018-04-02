
window.onload=function(){
	loggedInTeacher();
	ajaxCallExams();
}; 

var examDB =[]


function ajaxCallExams(){

	var data = 'json_string={"header":"teacherExamListRequest"}';
	console.log(data);

	
	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);


	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response);
			populateExams(response);

		} else {
			console.log("failed to recieve PHP response")
		}
	};
}
function ajaxReleaseScore(examName){

	var data = 'json_string={"header":"examReleaseRequest","examName":"'+examName+'"}';
	console.log(data);

	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);


	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response);
  	  location.reload();
      
		} else {
			console.log("failed to recieve PHP response")
		}
	};
}


function populateExams(response){
	examDB = JSON.parse(response);
	


	var table = document.getElementById("exam_table");

	for (var i in examDB){

		var tr = document.createElement("tr");
		
		var exam_name_td = document.createElement("td");
		var exam_name = document.createTextNode(examDB[i]['examName']);
		exam_name_td.appendChild(exam_name);
		exam_name_td.id = "test_id_"+examDB[i]['examName']

		var exam_status_td = document.createElement("td");
		var exam_status = document.createTextNode(examDB[i]['status']);
		exam_status_td.appendChild(exam_status);


		var review_td = document.createElement("td");
		review_td.innerHTML = '<div"><input type="button" value="Review" onClick="reviewExams('+i+')"></div>'
		
		var release_td = document.createElement("td");
		if (examDB[i]['status'] == 'Released' || examDB[i]['status'] == 'released'){
			release_td.innerHTML = '<div><input type="button" value="Release" onClick="releaseScore('+i+')" disabled></div>'
		} else {
			release_td.innerHTML = '<div><input type="button" value="Release" onClick="releaseScore('+i+')"></div>'
		}
		
		tr.appendChild(exam_name_td);
		tr.appendChild(exam_status_td);
		tr.appendChild(review_td);
		tr.appendChild(release_td);
		table.appendChild(tr);
	}	
}


function reviewExams(examID){
	window.localStorage.setItem('examName', examDB[examID]['examName']);
	goTo("reviewList.html")
}

function releaseScore(examID){
	ajaxReleaseScore(examDB[examID]['examName']);

}
