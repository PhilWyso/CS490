var examName ="";
var studentName ="";
var question_ids = [];
var questionDB = [];

window.onload=function(){
	loggedInStudent();
	examName = window.localStorage.getItem('examName');
	studentName = window.localStorage.getItem('studentName');
	ajaxCallTeacherReview(studentName, examName);
	document.getElementById('exam_name').innerHTML = "Exam Name: "+examName;
	document.getElementById('student_name').innerHTML = "Student Name: "+ studentName;
}; 

function populateExam (response){
	
	var questionDB = JSON.parse(response);
	console.log(questionDB);

	for (var i in questionDB) {
		var exam_node = document.getElementById("question_list");
		var new_div = document.createElement("div");
		new_div.id = "question_wrapper_"+i;
		new_div.innerHTML =  `
								<div> 
									<form>
										<div style ="margin-bottom: 25px;">
											<h3 id="question_name_`+i+`">`+questionDB[i]['functionName']+`</h3> 
										</div>
										<div>
											<label><b>Question:</b></label>
											<p>`+questionDB[i]['question']+`</p>
										</div>
										<div>
											<label><b>Student Answer:</b> </label>
											<div>
												<textarea id="student_answer_`+i+`" rows="15" style="width: 100%; font-size: 16px;"disabled>`+questionDB[i]['answer']+`</textarea>
											</div>
										</div>
										<div>
											<label><b>Score:</b></label>
											<input type="text" id="student_score_`+i+`" disabled style="width: 30px;" value=`+questionDB[i]['grade']+`><span>/10</span>
										</div>
										<div>
											<label><b>Automated Notes:</b></label>
											<textarea id="student_notes_`+i+`" rows="5" style="width: 100%; font-size: 16px;" disabled>`+questionDB[i]['autoNotes']+`</textarea>
										</div>
										<div>
											<label><b>Added Teacher Notes:</b></label>
											<textarea id="teacher_notes_`+i+`" rows="5" style="width: 100%; font-size: 16px;"disabled>`+questionDB[i]['teacherNotes']+`</textarea>
										</div>
										<div style="height:25px"></div>
									</form>
								</div>
							`
		exam_node.appendChild(new_div);
		question_ids.push(i);	
	}

}

function ajaxCallTeacherReview(username, examName){

	var data = 'json_string={"header":"reviewExamRequest","examName":"'+examName+'","username":"'+username+'"}';
	var request = new XMLHttpRequest();
	console.log(data);

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);

	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			populateExam(response);
		} else {
			console.log("failed to recieve PHP response")
		}
	};	
}
