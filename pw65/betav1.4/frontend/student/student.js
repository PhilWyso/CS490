window.onload=function(){

	loggedInStudent();
	ajaxCallStudentExams();
	
}; 
var examDB=[];
function ajaxCallStudentExams(){

	var data = 'json_string={"header":"studentExamListRequest", "username":"'+ window.localStorage.getItem('username') +'"}'
	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);


	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			populateExams(response);
		} else {
			console.log("failed to recieve PHP response")
		}
	};
}
function populateExams(response){
	examDB = JSON.parse(response);
	var table = document.getElementById("exams_table");
	for (var i in examDB){
		var tr = document.createElement("tr");
		
		var exam_name_td = document.createElement("td");
		exam_name_td.id = examDB[i]['examName'];
		var exam_name = document.createTextNode(examDB[i]['examName']);
		exam_name_td.appendChild(exam_name);

		var edit_td = document.createElement("td");
		switch(examDB[i]['status']){
			case 'assigned':
				edit_td.innerHTML = '<div><input type="button" value="Take" onClick="takeExam('+i+')"></div>';
				break;
			case 'submitted':
				edit_td.innerHTML = '<div><p>Wait for Results</p></div>';
				break;
			case 'released':
				edit_td.innerHTML = '<div><input type="button" value="Results" onClick="reviewExam('+i+')"></div>';
				break;
			default:
				 edit_td.innerHTML = '<div><p>Something went Wrong...</p></div>'
				}
		tr.appendChild(exam_name_td);
		tr.appendChild(edit_td);
		table.appendChild(tr);
		}
}
function takeExam(examID){
	window.localStorage.setItem('examName', examDB[examID]['examName']);
	goTo('take-exam.html')
}
function reviewExam(examID){
	window.localStorage.setItem('examName', examDB[examID]['examName']);
	window.localStorage.setItem("studentName", window.localStorage.getItem('username'));
	goTo('reviewExam.html')
}