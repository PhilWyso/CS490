# CS490
CS490-NJIT-AJAX

any given example pertaining to student questions was grabbed from coding Bat, specifically the sleep_in example, which is provided here:
http://codingbat.com/prob/p173401

## Table of Possible Variable Names that will be exchanged between the ends

| variable Name  | explanation   | example    |                      
| -------------  | ------------- | -----------|   
|header|this will enable the middleend to be a single file, allowing it to direct to urls as directed|login|
| username   | self-explanatory  | ********     |                         
| password   | self-explanatory  | ********      |                       
| examName   | name of exam      | cs490 Midterm|
| functionName | name of the function, used for grading | sleep_in|
|question | the details given to the student for the function | Write the function sleep_in with the parameters weekday and vacation that...|
|topic|the topic of the question, could be handy later for grading such as finding an if statement| Conditionals|
|difficulty|self-explanatory|easy|
|parameters|the parameter names, the names will be a single string seperated by commas, use php.explode, or js.split to take apart if needed|weekday, vacation|
|input|List of possible inputs, seperated by colons, and the list of inputs seperated by commas, once again a single string|false,false:true,false:false,true|
|output|List of possible outputs, when splitting the inputs and outputs with explode or split, each array# will correlate with the output|true,false,true|
|grade|the grade of the answer this will be attached to|5|
|maxGrade| the maximum possible points for a question | 10|
|autoNotes| string containing the notes provided by the middleEnd when automatically graded| -1 point for wrong function name, -1 point for wrong parameter name, -1 for failing case 2, etc..|
|teacherNotes| string containig the notes provided by the teacher when reviewing an exam | I added an extra point, since I taught this differently |
|id| question id for a question which is automatically assigned by the backend when it is created| 2
|status| status of an exam, the variable will contain either "assigned", "submitted", or "released"|
|pointWorth| the maximum amount of points a question is worth | 
|questionList| list of ids assigned |
|pointList| list of points corresponding to ids in questionList
