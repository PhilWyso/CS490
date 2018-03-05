window.onload=function(){
	loggedIn();
}; 

document.querySelector("#form_create_question").addEventListener("submit", function(e){
	e.preventDefault(); 
});

//============================================================================
var testCases= 0
function addTestCase(){
	console.log("Adding a test case")
	testCases = testCases+ 1;
	var test_cases_node = document.getElementById("test_cases")
	var new_div = document.createElement("div");
	new_div.classList.add("super-block");
	new_div.id = "block_"+testCases
	new_div.innerHTML = '<div class="left-block"><label>&nbsp;</label></div><div class="right-block"><div class="two-quarter" style="width: 40%"><input type="text" id="input_'+testCases+'" placeholder="Input..." required="Missing input"></div><div class="quarter" style="width: 5%">&nbsp;</div><div class="two-quarter" style="width: 40%;"><input type="text" id="output_'+testCases+'" placeholder="Expected output..." required="Missing expected output"></div><div class="quarter" style="width: 5%">&nbsp;</div><div class="quarter" style="width: 10%; float: right;" ><input type="button" value="Delete" style="width:100%; background:#d9534f;" onClick="deleteTestCase('+testCases+')"></div></div>'
	test_cases_node.appendChild(new_div);
}
function deleteTestCase(caseNumber){
	console.log("Deleting a test case")
	var current_test_case = document.getElementById("block_"+caseNumber)
	current_test_case.remove();
	testCases = testCases - 1;
}

//============================================================================
function submitQuestion(){
	var func_name = document.getElementById("func_name").value;
	var question_text = document.getElementById("question_text").value;
	var param_names = document.getElementById("param_names").value;
	var input_cases = organizeTestInput();
	var output_cases = organizeTestOutput();
	var topic_obj = document.getElementById("topic");
	var topic =  topic_obj.options[topic_obj.selectedIndex].value;
	var difficulty_obj = document.getElementById("difficulty");
	var difficulty =  difficulty_obj.options[difficulty_obj.selectedIndex].value;
	var array = '{"header":"addQuestion","qName":"'+func_name+'", "question":"'+question_text+'", "topic":"'+topic+'", "difficulty":"'+difficulty+'", "cases":"'+param_names+'", "input":"'+input_cases+'", "output":"'+output_cases+'"}';

	ajaxAddQuestion(array);
}
function organizeTestInput(){
	var input ="";
	for (var i=0;i<=testCases;i++){
		input += document.getElementById("input_"+i).value;
		if (i != testCases)
		{
			input+=":";
		}
	}	
	return input;
}
function organizeTestOutput(){
	var output ="";
	for (var i=0;i<=testCases;i++){
		output += document.getElementById("output_"+i).value;
		if (i != testCases)
		{
			output+=":";
		}
	}	
	return output;
}
//============================================================================


function ajaxAddQuestion(infoArray){


	var data ='json_string='+infoArray
	var request = new XMLHttpRequest();

	request.open('POST', '../php/frontend.php', true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.send(data);

	request.onload = function() {
		if (request.status >= 200 && request.status < 400) {
			var response = request.responseText;
			console.log(response)
			addQuestionAttempt(response);
		} else {
			console.log("failed to recieve PHP response")
		}
	};	
}

function addQuestionAttempt(response){
	var responseJSON = JSON.parse(response);
	if(responseJSON =="fail"){
		document.getElementById("status").innerHTML = "Failed";
	}
	if(responseJSON=="success"){
		document.getElementById("status").innerHTML = "Successfully Added Question to database";

	}
}

