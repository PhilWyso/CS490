window.onload=function(){

	loggedInTeacher();
	ajaxCallQuestionDB();

}; 

document.querySelector("#sort_form").addEventListener("submit", function(e){
	e.preventDefault();
	if (e.keyCode === 13) {
    submitSort();
  }
});

var question_count = 0;
var questionDB = {};
var questions_added =[];

function populateQDB(response){
	questionDB = JSON.parse(response);
	var table = document.getElementById("question_table");
	//conditional only for testing purposes---------------------------
	//var z = 0;
	for (var i in questionDB){

		/*z++;
			if( z >= 5) {
			console.log('forced loop exit');
			return;
		}*/
	//----------------------------------------------------------------
		var tr = document.createElement("tr");

		var question_id_td = document.createElement("td");
		var question_id = document.createTextNode(i);
		question_id.id = "id_"+questionDB[i];
		question_id_td.appendChild(question_id);

		var question_name_td = document.createElement("td");
		var question_name = document.createTextNode(questionDB[i]['functionName']);
		question_name_td.appendChild(question_name);


		var difficulty_td = document.createElement("td");
		var difficulty = document.createTextNode(questionDB[i]['difficulty']);
		difficulty_td.appendChild(difficulty);

		var topic_td = document.createElement("td");
		var topic = document.createTextNode(questionDB[i]['topic']);
		topic_td.appendChild(topic);

		var question_text_td = document.createElement("td");
		var question_text = document.createTextNode(questionDB[i]['question']);
		question_text_td.appendChild(question_text);

		var add_td = document.createElement("td");
		add_td.innerHTML = '<div class="text-center" ><input type="button" value="Add" onClick="addQuestion('+i+')" id="question_to_add_'+i+'"></div>'

		tr.appendChild(question_id_td);
		tr.appendChild(question_name_td);
		tr.appendChild(difficulty_td);
		tr.appendChild(topic_td);
		tr.appendChild(question_text_td);
		tr.appendChild(add_td);

		table.appendChild(tr);		
	}
}

function submitExam(event){
	event.preventDefault();

	if(question_count == 0){
		document.getElementById("status").innerHTML = "No questions have been Added";
	}
	else{
		var test_name = document.getElementById("test_name").value;
		ajaxCallCreateTest(test_name);
	}

}

function addQuestion(id){
	var question = questionDB[id];
	var default_point = 10;
	var question_name = questionDB[id]['functionName'];
	document.getElementById("question_to_add_"+id).disabled = true;
	var question_block = document.getElementById("question-block")
	var new_div = document.createElement("div")
	new_div.classList.add("question-block")
	new_div.id = "question_id_"+id
	question_count = question_count + 1
	new_div.innerHTML = `<div>						 	
							<div><label id="label_id_`+id+`">Q`+question_count+`: `+question_name+`</label></div>
							<div style="width: 13%;margin-bottom: `+20+`px;"> <label><input onClick="deleteQuestion(`+id+`)" class="delete-question" type="button" value="Delete" style="height: 20px; width: 80%"></label></div>
						</div>`

	questions_added.push(id)
	question_block.appendChild(new_div)

	document.getElementById("status").innerHTML = "";
}

function remove(array, element) {
    const index = array.indexOf(element);
    
    if (index !== -1) {
        array.splice(index, 1);
    }
}

function deleteQuestion(id){
	
	var question_to_delete = document.getElementById('question_id_'+id)
	question_to_delete.remove()
	document.getElementById("question_to_add_"+id).disabled = false;
	
	question_count = question_count - 1;
	remove(questions_added, id);
}


function ajaxCallCreateTest(test_name){
 var idList = "";
 	for(var i in questions_added){
    	idList = idList + questions_added[i]  + ",";
  	}
  	idList = idList.slice(0,-1);
  	console.log(idList);

	var data = 'json_string={"header":"createExam","examName":"'+test_name+'","questionList":"'+idList+'"}'
	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);

	//ajax request was successful
	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response)
			createTestAttempt(response);
		} else {
			console.log("failed to recieve PHP response")
		}
	};	
	
}

function submitSort(){
	var keyword = document.getElementById("search_by").value;
	if (keyword == "Search by Keyword"){
		keyword = "";
	}
	var topic_obj = document.getElementById("sort-topic");
	var topic =  topic_obj.options[topic_obj.selectedIndex].value;
	var difficulty_obj = document.getElementById("sort-difficulty");
	var difficulty =  difficulty_obj.options[difficulty_obj.selectedIndex].value;
	array = '{"header":"questionBankSortRequest", "topic":"'+topic+'", "difficulty":"'+difficulty+'", "keyword":"'+keyword+'"}';


	ajaxCallQuestionDBSort(array);
}
function ajaxCallQuestionDBSort(infoArray){
	var data ='json_string='+infoArray;
	console.log(data);
	/*
	var request =new XMLHttpRequest();
	
	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);


	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			populateQDB(response);

		} else {
			console.log("failed to recieve PHP response")
		}
	};
	*/


}

function ajaxCallQuestionDB(){

	var data = 'json_string={"header":"questionBankRequest"}';
	console.log(data);

	var request = new XMLHttpRequest();
	
	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);


	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			populateQDB(response);

		} else {
			console.log("failed to recieve PHP response")
		}
	};
	
}

function createTestAttempt(response){
	var responseJSON = JSON.parse(response);
	if(responseJSON =="fail"){
		document.getElementById("status").innerHTML = "Failed";
	}
	if(responseJSON=="success"){
		document.getElementById("status").innerHTML = "Successfully Created Exam";
	}
}





