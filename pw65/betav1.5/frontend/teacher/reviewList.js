var examName = window.localStorage.getItem('examName')
var students = [];

window.onload=function(){
	document.getElementById('exam_name').innerHTML = "Exam Name: "+examName
	loggedInTeacher();
	ajaxCallExamScores(examName);
}; 


function populateExams(response){
	console.log(response);
	students = JSON.parse(response);

	var table = document.getElementById("student_table");

	for (var i in students){

		var tr = document.createElement("tr");

		var studentName = students[i]['username'];
		var student_name_td = document.createElement("td");
		var student_name = document.createTextNode(students[i]['username']);
		student_name_td.appendChild(student_name);

		var status = students[i]['status'];
		var student_status_td = document.createElement("td");
		var student_status = document.createTextNode(status);
		student_status_td.appendChild(student_status);

		var student_grade_td = document.createElement("td");
		if (status == "submitted" || status == "released"){
			var string = students[i]['grade']+"/"+students[i]['total'];
			var student_grade = document.createTextNode(string);
		} else {
			var string = "N/A";
			var student_grade = document.createTextNode(string);
		}
		student_grade_td.appendChild(student_grade);

		var review_td = document.createElement("td");
		if (status == "submitted" || status == "released"){
			review_td.innerHTML = '<div><input type="button" value="Review" onClick="reviewExam('+i+')"></div>'
		} else {
			review_td.innerHTML = '<div><input type="button" value="Review" onClick="reviewExam('+i+')" disabled></div>'
		}
		tr.appendChild(student_name_td);
		tr.appendChild(student_status_td);
		tr.appendChild(student_grade_td);
		tr.appendChild(review_td);
		table.appendChild(tr);
		
	}	
}


function reviewExam(studentNo){
	window.localStorage.setItem("studentName", students[studentNo]['username']);
	goTo('modify_exam.html')
}



function ajaxCallExamScores(examName){
	
	var data = 'json_string={"header":"teacherExamScoreRequest","examName":"'+examName+'"}';
	console.log(data)

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
function ajaxReleaseScores(examName){
	
	var data = 'json_string={"header":"releaseScore","examName":"'+examName+'"}';
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
