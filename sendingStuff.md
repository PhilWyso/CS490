
## IF YOU WANT TO SEE THE JSONS USE http://jsonviewer.stack.hu, AND COPY AND PASTE THE JSON YOU WANT TO VIEW INTO THE BOX
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
so their json will look as so.

{"0":{"examName":"TestNumber4","status":"released"},"1":{"examName":"TestNumber5","status":"released"},"2":{"examName":"CS490 Midterm Ok","status":"released"}}

-------





