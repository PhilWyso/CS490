
window.onload=function(){
	loggedIn();
	ajaxCallExams();
}; 


function ajaxCallExams(){

	var data = 'json_string={"header":"requestExamList"}'
	console.log(data)

	
	var request = new XMLHttpRequest();

	request.open('POST', '../php/examListRequest.php', true);
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
	console.log(response);
	var examDB = JSON.parse(response);


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
		review_td.innerHTML = '<div"><input type="button" value="Review" onClick="reviewExams('+examDB[i]['examName']+')"></div>'
		
		var release_td = document.createElement("td");
		release_td.innerHTML = '<div><input success" type="button" value="Release" onClick="releaseScore('+examDB[i]['examName']+')"></div>'
		
		tr.appendChild(exam_name_td);
		tr.appendChild(exam_status_td);
		tr.appendChild(review_td);
		tr.appendChild(release_td);
		table.appendChild(tr);
	}	
}


function reviewExams(primary_key){
	window.localStorage.setItem("exam_to_review", primary_key)
	window.localStorage.setItem("test_name", document.getElementById('test_id_'+primary_key).textContent)
	goTo("../exams/review_exams.html")
}



function releaseScore(primary_key){
	var test = {'primary_key':primary_key, 'test_name':document.getElementById('test_id_'+primary_key).textContent}
	window.localStorage.setItem('test_to_release', JSON.stringify(test))
	goTo('../exams/release_score.html')
}
