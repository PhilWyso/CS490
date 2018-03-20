|variable name| variable content|
|---|---|
|header  |storeExamRequest|
|username|  student1 |
|examName | MidTerm|
|id  |1|
|functionName | operation|
|topic  |Conditionals|
|parameters | op,a,b|
|input | "+",1,2:"-",5,2:"*",4,5:"/",10,2|
|output |3,3,20,5|
|answer | see Below|
|pointWorth| 10|


SAMPLE INPUTS FOR STUDENT ANSWERS

-----------------------

THIS IS AN IDEAL CASE THAT SHOULD RETURN 100%
```python
def operation(op, a, b):
  if op =='+':
    return a+b
  elif op=='-':
    return a-b
  elif op =='*':
    return a*b
  elif op =='/':
    return a/b
```

-----------------------

THIS CASE SHOULD HAS THE NAME WRONG, HOWEVER THE CODE ITSELF IS WITHOUT ACTUAL ERROR. MINOR POINT SUBTRACTION

```python
def add(op, a, b):
  if op =='+':
    return a+b
  elif op=='-':
    return a-b
  elif op =='*':
    return a*b
  elif op =='/':
    return a/b
```

-----------------------

THIS CASE FAILS TWO OUT OF FOUR TEST CASES, MAJOR POINT DEDUCTION

```python
def operation(op, a, b):
  if op =='+':
    return
  elif op=='-':
    return a-b
  elif op =='*':
    return
  elif op =='/':
    return a/b
```

-----------------------

THIS CASE FAILS TO RUN DUE TO SYNTAX ERRORS. THIS IS PROBABLY THE HARDEST CASE TO TEST FOR SINCE, THE CODE ITSELF IS GENERALLY CORRECT EXCEPT FOR A MINOR ERROR
I'm leaving it up to you to figure out how you want to grade this. It should atleast be able to spot that the operation and parameters are the correct names so add points for that.

```python
def operation(op, a, b):
  if op =='+':
    return;;
  elif op=='-':
    return a-b
  elif op =='*':
    return
  elif op =='/':
    return a/b
```
    
-----------------------

THIS CASE HAS THE WRONG PARAMETER NAME. MINOR POINT DEDUCTION

```python
def operation(operator, a, b):
  if operator =='+':
    return
  elif operator=='-':
    return a-b
  elif operator =='*':
    return
  elif operator =='/':
    return a/b
```
    
    
 
    
    
 
