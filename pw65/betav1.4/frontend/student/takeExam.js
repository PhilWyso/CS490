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
    //console.log(questionDB);
	for (var i in questionDB){
		var exam_node = document.getElementById("question_list");
		var new_div = document.createElement("div");
		new_div.id = "question_wrapper_"+i
		new_div.innerHTML = `
								<div> 
									<form>
										<div> 
											<label>Question:</label>
										</div>
										<div style ="margin-bottom: 25px;">
											<h3 id="question_name_`+i+`">`+questionDB[i]['functionName']+`</h3> 
										</div>
										<div>
											<p>`+questionDB[i]['question']+`</p>
										<div>
										</div>
											<label>Answer: </label>
											<div>
												<textarea id="student_answer_`+i+`" rows="15" style="width: 100%; font-size: 16px;" required> </textarea>
											</div>
										</div>
										<div style="height:50px"></div>
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

