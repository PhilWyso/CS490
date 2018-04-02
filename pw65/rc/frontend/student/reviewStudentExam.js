var examName ="";
var studentName ="";
var question_ids = [];
var questionDB = [];

window.onload=function(){
	loggedInStudent();
	examName = window.localStorage.getItem('examName');
	studentName = window.localStorage.getItem('studentName');
	ajaxCallTeacherReview(studentName, examName);
	document.getElementById('exam_name').innerHTML = examName;
	document.getElementById('student_name').innerHTML = studentName;
}; 

function populateExam (response){
	
	var questionDB = JSON.parse(response);


	for (var i in questionDB) {
		var exam_node = document.getElementById("question-list");
		var new_div = document.createElement("div");
		new_div.id = "question_wrapper_"+i;
		new_div.className="review-container"
    if (questionDB[i]['teacherNotes']==null){
    questionDB[i]['teacherNotes'] = "";
    }
		new_div.innerHTML =  `
	
			<form>
			<div class="container-title">
				<div class="caption">
					<span class="caption-title" id="question_name_`+i+`">`+questionDB[i]['functionName']+`</span>
					<span class="caption-explain" id="point_worth_`+i+`"> Points: </span>
					<input type="text" disabled id="student_score_`+i+`" style="width: 20px;" value=`+questionDB[i]['grade']+`><span>/`+questionDB[i]['pointWorth']+`</span>
				</div>
			</div>
			<div class="review-body">
				<div class="question">
					<h4 id="question_id_`+i+`"> Question ID: `+questionDB[i]['id']+` </h4>
					<p id="question_`+i+`">`+questionDB[i]['question']+`</p>
				</div>
				<div class="answerbox">
					<h4>  Student Answer: </h4>
					<div>
						<textarea disabled class="reviewanswer" id="student_answer_`+i+`">`+questionDB[i]['answer']+`</textarea>
					</div>
				</div>
				<div class="teacherNotes">
					<h4>  Teacher Notes: </h4>
					<textarea disabled class="teacheranswer" id="teacher_notes_`+i+`">`+questionDB[i]['teacherNotes']+`</textarea>
				</div>
				<div class="autoNotes">
					<table>
						<thead>
							<tr>
								<th>Generated Notes</th>
							</tr>
						</thead>
						<tbody id="autoNotes_table_`+i+`">
						</tbody>
					</table>
				</div>
			</div>
			</form>
	
				`;
		exam_node.appendChild(new_div);
		question_ids.push(i);
		var table = document.getElementById("autoNotes_table_"+i);
		var notes = questionDB[i]['autoNotes'].split(";");
  
		for(var j in notes){
			var tr = document.createElement("tr");
			var autoNotes_td = document.createElement("td")
			var autoNotes = document.createTextNode(notes[j]);
			autoNotes_td.id="note_"+j;
      autoNotes_td.appendChild(autoNotes);
			tr.appendChild(autoNotes_td);
			table.appendChild(tr);
		}

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
        console.log(response);
			populateExam(response);
		} else {
			console.log("failed to recieve PHP response")
		}
	};	
}
