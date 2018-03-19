
# WHAT EVERYONE WILL BE SENDING BETWEEN EACH OTHER
## IF YOU WANT TO SEE THE JSONS IN A CLEANER FORMAT USE http://jsonviewer.stack.hu, AND COPY AND PASTE THE JSON YOU WANT TO VIEW INTO THE BOX
-----------------------------

### LOGIN 
##### frontend
Frontend will be sending, the username, password, and a header with "login" inserted in it.

|variable name| variable content|
|---|---|
|header  |login|
|username | studentName|
|password | passwordwhatever| 
#### backend
Backend will simply be returning json string that contains "fail", "teacher", or "student"

-------
## STUDENT SIDE FUNCTIONS
----------
---------
###  Student Exam List Call 
##### frontend
Frontend will be attempting a request to the backend to recieve a list of exams assigned to the currently logged in student.

|variable name| variable content|
|---|---|
|header  |studentExamListRequest|
|username | studentName|
#### backend
Backend will be echo a json_encode(array), containing exam Names and the student's status with that array, such as "assigned",
"submitted", or "released".
so their json will look as so:

{"0":{"examName":"TestNumber4","status":"released"},"1":{"examName":"TestNumber5","status":"released"},"2":{"examName":"CS490 Midterm Ok","status":"released"}}

-------

### Student taking Exam Call
##### frontend
Frontend will be attempting a request to the backend to recieve an exam for the currently logged in student to take

|variable name| variable content|
|---|---|
|header  |takeExamRequest|
|examName | MidTerm|
#### backend
Backend will be echo a json_encode(array), containing everything needed for the student to take the exam, and everything needed for the
middle end to grade the exam
so their json will look as so:

{"1":{"id":"1","functionName":"sleepIn","question":"Create an algorithm with the name sleepIn that takes on two boolean paramaters, weekday and vacation, named and ordered accordingly. The parameter weekday is true if it is a weekday, and the parameter vacation is true if we are on vacation. We sleep in if it is not a weekday or we're on vacation. Return true if we sleep in.","topic":"if statement","difficulty":"easy","parameters":"weekday, vacation","input":"false:false, true:false, false:true","output":"true, false, true","pointWorth":"10"},"15":{"id":"15","functionName":"basicAdd","question":"Write a function named basicAdd, that adds together the paramters a and b together.","topic":"Conditionals","difficulty":"Easy","parameters":"a,b","input":"1,2:4,5:6,4","output":"3:9:10","pointWorth":"10"}}

#### Important thing to note here is that the arrays are named after the questions respectives ids

--------------------

### Student Submitting Exam Call
#### frontend

The frontend will be sending each question one by one to the middle end which will be automatically grading it and then sending the rest to the backend which will be storing it in the database. Header will most likely not be needed since this will be directly sent to the grading php in the midend, rather than the general midend location parser

|variable name| variable content|
|---|---|
|header  |storeExamRequest|
|username|  student1 |
|examName | MidTerm|
|id  |1|
|functionName | sleepIn|
|topic  |Conditionals|
|parameters | weekday,vacation|
|input | false:false, true:false, false:true
|output |true, false, true|
|answer | students answer|
|pointWorth| 10|
#### midend
mid end at this point will be grading the questions one by one and sending them to the backend

|variable name| variable content|
|---|---|
|header  |storeExamRequest|
|username| student1|
|examName | MidTerm|
|id  |1
|answer | students answer|
|autoNotes| Wrong function Name : -1, Wrong case 1 output: -1, Fails to Compile: -5|
|grade|3|

#### backend
Backend will save all the information, as well as updating the studednt exam status to "submitted".
the backend will either return a "success" or a "fail". I'm still thinking this one through. I'm thinking the frontend will make a counter, coutning the number of successes or fails and once the number of successes is equal to the number of questions force return to student home landing.

----------------------
### Review Exam Call
##### frontend
Frontend will be attempting a request to recieve the information on a students submitted exam

|variable name| variable content|
|---|---|
|header  |ReviewExamRequest|
|username | student1|
|examName | MidTerm|
#### backend
Backend will be echo a json_encode(array), containing everything needed for the student to review the exam.

{"1":{"id":"1","functionName":"sleepIn","question":"Create an algorithm with the name sleepIn that takes on two boolean paramaters, weekday and vacation, named and ordered accordingly. The parameter weekday is true if it is a weekday, and the parameter vacation is true if we are on vacation. We sleep in if it is not a weekday or we're on vacation. Return true if we sleep in.","topic":"if statement","difficulty":"easy","parameters":"weekday, vacation","input":"false:false, true:false, false:true","output":"true, false, true","pointWorth":"10","teacherNotes":"I went over this in class, and I mentioned this on the exam, you should not have gotton this wrong.","autoNotes":"Failed to compile: -10","grade":"0","answer":"this is the students answer" },"3":{"id":"3","functionName":"sleepIn","question":"Create an algorithm with the name sleepIn that takes on two boolean paramaters, weekday and vacation, named and ordered accordingly. The parameter weekday is true if it is a weekday, and the parameter vacation is true if we are on vacation. We sleep in if it is not a weekday or we're on vacation. Return true if we sleep in.","topic":"if statement","difficulty":"easy","parameters":"weekday, vacation","input":"false:false, true:false, false:true","output":"true, false, true","pointWorth":"10","teacherNotes":"I went over this in class, and I mentioned this on the exam, you should not have gotton this wrong.","autoNotes":"Failed to compile: -10","grade":"0","answer":"this is the students answer" }}

#### Important thing to note here is that the arrays are named after the questions respectives ids

----------------------------------
## TEACHER SIDE FUNCTIONS
----------
--------------------
### Exam List Call
##### frontend
Frontend will be attempting a request to recieve a list of created exams

|variable name| variable content|
|---|---|
|header  |teacherExamListRequest|

#### backend
Backend will be echo a json_encode(array), containing all exams with their status

{"1":{"examName":"TestNumber4","status":"released"},"2":{"examName":"TestNumber5","status":"released"},"3":{"examName":"Yes Ok","status":"released"},"4":{"examName":"helloWorld","status":"assigned"},"5":{"examName":"TEST","status":"released"},"6":{"examName":"blah","status":"released"},"7":{"examName":"blah","status":"assigned"},"8":{"examName":"blah","status":"assigned"},"0":{"examName":"MidTerm","status":"assigned"}}

----------------------------------
### teacher Student Scores call
##### frontend
Frontend will be attempting a request to recieve a list of created exams

|variable name| variable content|
|---|---|
|header  |teacherExamScoreRequest|
|examName| TestNumber4 |

#### backend
Backend will be echo a json_encode(array), containing all exams with their status

[{"username":"student1","status":"released","total":30,"grade":9},{"username":"student2","status":"released","total":0,"grade":0}]

----------------------------------
### Review Exam Call
##### frontend
Frontend will be attempting a request to recieve the information on a students submitted exam
This is identical to the student's attempt to review his exam since all the data requested is the same as when the teacher wants to review the exam

|variable name| variable content|
|---|---|
|header  |ReviewExamRequest|
|username | student1|
|examName | MidTerm|
#### backend
Backend will be echo a json_encode(array), containing everything needed for the student to review the exam.

{"1":{"id":"1","functionName":"sleepIn","question":"Create an algorithm with the name sleepIn that takes on two boolean paramaters, weekday and vacation, named and ordered accordingly. The parameter weekday is true if it is a weekday, and the parameter vacation is true if we are on vacation. We sleep in if it is not a weekday or we're on vacation. Return true if we sleep in.","topic":"if statement","difficulty":"easy","parameters":"weekday, vacation","input":"false:false, true:false, false:true","output":"true, false, true","pointWorth":"10","teacherNotes":"I went over this in class, and I mentioned this on the exam, you should not have gotton this wrong.","autoNotes":"Failed to compile: -10","grade":"0","answer":"this is the students answer" },"3":{"id":"3","functionName":"sleepIn","question":"Create an algorithm with the name sleepIn that takes on two boolean paramaters, weekday and vacation, named and ordered accordingly. The parameter weekday is true if it is a weekday, and the parameter vacation is true if we are on vacation. We sleep in if it is not a weekday or we're on vacation. Return true if we sleep in.","topic":"if statement","difficulty":"easy","parameters":"weekday, vacation","input":"false:false, true:false, false:true","output":"true, false, true","pointWorth":"10","teacherNotes":"I went over this in class, and I mentioned this on the exam, you should not have gotton this wrong.","autoNotes":"Failed to compile: -10","grade":"0","answer":"this is the students answer" }}

#### Important thing to note here is that the arrays are named after the questions respectives ids

----------------------------------
### add Question Call
##### frontend
Frontend will be attempting to send all the required information to create to the backend which will be storing the question

|variable name| variable content|
|---|---|
|header  |addQuestionRequest|
|functionName| simpleAdd |
|question| create a function named simpleAdd which will add together the parameters 'a' and 'b' together|
|topic| Basic Tools |
|difficulty | easy |
|parameters| a,b|
|input | 1,2:3,4:4,6
|output| 3:7:10

#### backend
Backend will echo a simple "success" or "fail"

------------------------------------
### question bank call
##### frontend
Frontend will be attempting to recieve all questions in the questionbank

|variable name| variable content|
|---|---|
|header  |questionBankRequest|

#### backend
backend will be returning the full list of the question Bank. 

{"1":{"id":"1","functionName":"sleepIn","question":"Create an algorithm with the name sleepIn that takes on two boolean paramaters, weekday and vacation, named and ordered accordingly. The parameter weekday is true if it is a weekday, and the parameter vacation is true if we are on vacation. We sleep in if it is not a weekday or we're on vacation. Return true if we sleep in.","topic":"if statement","difficulty":"easy","cases":"weekday, vacation","input":"false:false, true:false, false:true","output":"true, false, true"},"4":{"id":"4","functionName":"helloWorld","question":"Create a function named helloWorld that adds the parameters a and b together.","topic":"Conditionals","difficulty":"Easy","cases":"a,b","input":"1,2:2,3","output":"3:5"},"7":{"id":"7","functionName":"helloWorld2","question":"Create a function named helloWorld that adds the parameters a and b together.","topic":"Conditionals","difficulty":"Easy","cases":"a,b","input":"1,2:2,3","output":"3:5"},"8":{"id":"8","functionName":"helloWorld5","question":"Create a function named helloWorld that adds the parameters a and b together.","topic":"Conditionals","difficulty":"Easy","cases":"a,b","input":"1,2:2,3","output":"3:5"},"9":{"id":"9","functionName":"addition","question":"Create a function that adds the parameters a and b together","topic":"Conditionals","difficulty":"Easy","cases":"a,b","input":"1,2:3,4","output":"3:7"},"11":{"id":"11","functionName":"","question":"123","topic":"Arrays","difficulty":"Easy","cases":"45","input":"a","output":"b"},"12":{"id":"12","functionName":"testno2","question":"2","topic":"Arrays","difficulty":"Easy","cases":"2","input":"2","output":"2"},"13":{"id":"13","functionName":"MajorTest","question":"This a test for student Exam","topic":"Strings","difficulty":"Hard","cases":"a,b","input":"hello, world:my, name","output":"hello world:my name"},"14":{"id":"14","functionName":"FullLoopQuestionTest","question":"this is a question for a full test minus the middleend","topic":"Conditionals","difficulty":"Easy","cases":"loop","input":"1:2:4","output":"2:3:5"},"15":{"id":"15","functionName":"basicAdd","question":"Write a function named basicAdd, that adds together the paramters a and b together.","topic":"Conditionals","difficulty":"Easy","cases":"a,b","input":"1,2:4,5:6,4","output":"3:9:10"},"16":{"id":"16","functionName":"add","question":"add 2 numbers","topic":"Conditionals","difficulty":"Easy","cases":"a,b","input":"add(2,4):add(1,2)","output":"6:3"},"17":{"id":"17","functionName":"add","question":"add 2 numbers","topic":"Conditionals","difficulty":"Easy","cases":"a,b","input":"add(2,4):add(1,2)","output":"6:3"},"18":{"id":"18","functionName":"abra","question":"return kazam","topic":"Conditionals","difficulty":"Hard","cases":"a,b,3","input":"hi","output":"bye"}}

#### important thing to note is that another similiar type of function will need to be made, but instead of listing out the entire question bank, it will only list the questions with certain parameters such as all the questions with easy difficulty and with the topic of arrays

------------------------------

### create Exam Call
##### frontend
Frontend will be attempting to send all the required information to create an exam

|variable name| variable content|
|---|---|
|header  |createExam|
|examName | Midterm | 
|questionList| 1,3,15|
|pointList| 10, 20, 15|

#### backend
Backend will need to store all the information, as well as create exam statuses for all students and setting them to "assigned"
Backend will echo a simple "success" or "fail"

------------------------------
### Exam Update Call
##### frontend
Frontend will be attempting to send all information to update a student's exam after reviewing it. It will be sending each question one by one to the backend which will be storing it

|variable name| variable content|
|---|---|
|header  |examUpdateRequest|
|examName | Midterm | 
|username| student1|
|id| 13|
|grade| 4|
|teacherNotes| this is what the teacher wrote|
##### backend
backend will return either a success or fail for each question after storing any changes

--------------------

### Exam Release Call
#### frontend
Frontend will be attempting to request that the selected exam will be released to all students.

|variable name| variable content|
|---|---|
|header|examReleaseRequest|
|examName| Midterm |

#### backend
Backend will have to change statuses on all student exam statuses as well as the general exam status to "released", and then return a success or fail
























