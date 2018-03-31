var examName ="";
var username ="";
var question_ids = [];
var questionDB = [];

window.onload=function(){
	loggedInStudent();
	examName = 	window.localStorage.getItem('examName');	
	username = window.localStorage.getItem('username')
	ajaxCallExamQuestions(examName, username);
	document.getElementById('exam_name').innerHTML = examName
}; 

function ajaxCallExamQuestions(examName, username){

	var data = 'json_string={"header":"takeExamRequest","examName":"'+examName+'"}';
	var request = new XMLHttpRequest();
	//console.log(data);

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);

	
	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response);
		
			populateQuestions(response);
		} else {
			console.log("failed to recieve PHP response")
		}
	};
}

function populateQuestions(response){
    questionDB = JSON.parse(response);
    console.log(questionDB);
	for (var i in questionDB){
		var exam_node = document.getElementById("question_list");
		var new_div = document.createElement("div");
		new_div.id = "question_wrapper_"+i
		new_div.innerHTML = `
		<div class="question-container">
			<form>
				<div class="container-title">
					<div class="caption">
						<span class="caption-title" id="question_name_`+i+`">`+questionDB[i]['functionName']+` </span>
						<span class="caption-explain" id ="point_worth_`+i+`"> Points: `+questionDB[i]['maxGrade']+`</span>
					</div>
				</div>	
				<div class="question-body">
					<div class="left">
						<h4 id="question_id_`+i+`"> Question ID: `+i+` </h4>
						<p>`+questionDB[i]['question']+`</p>
					</div>
					<div class="right">
						<h4> Your Answer: </h4>
						<div>
							<textarea class="answer" id="student_answer_`+i+`"></textarea>
						</div>
					</div>		
				</div>
			</form>
		</div>
							`
		exam_node.appendChild(new_div);
		question_ids.push(i);					
	}
}

function submitExam() {
	var flag = false

	for (var i in question_ids){
		if(String(document.getElementById("student_answer_"+question_ids[i]).value)==""){
			flag = true;
			break;
		}
	}
	if(flag == true){
		document.getElementById("status").innerHTML = "Check to see if you have completed all Questions";
	} else{
		//var fields ='json_string={"username":"'+username+'","examName":"'+examName+'","examLength":"'+question_ids.length+'"'

		//have to send each question individually since nested arrays dont curl too well, and couldn't find work around
		var array= {
		"username": username,
		"examName": examName,
		};
		for(var j in question_ids){
			var id = question_ids[j];
			var answer = document.getElementById("student_answer_"+id).value
			array = {
				"username": username,
				"examName": examName,
				"id":id,
				"qName":questionDB[id]['functionName'],
				"topic":questionDB[id]['topic'],
				"cases":questionDB[id]['parameters'],
				"input":questionDB[id]['input'],
				"output":questionDB[id]['output'],
				"answer":answer
				}
			fields = JSON.stringify(array);
			ajaxSaveExamRequest(fields);
			}
		}
		//goTo('s-landing.html');
		//'json_string={"header":"takeExamRequest","examName":"'+examName+'","username":"'+username+'"}'	
}
function ajaxSaveExamRequest(fields){

	var data = 'json_string='+fields;
	console.log(data);
	var request = new XMLHttpRequest();

	request.open('POST', '../php/storeExamRequest.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);
	
	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response)
		} else {
			console.log("failed to recieve PHP response")
		}
	};
}

