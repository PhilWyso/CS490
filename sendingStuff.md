
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

###  Student Exam List Call 
##### frontend
Frontend will be attempting a request to the backend to recieve a list of exams assigned to the currently logged in student.

|variable name| variable content|
|---|---|
|header  |studentExamRequest|
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













