import traceback

'''
def operation(add, a, b):
  if add =='+':
   return a+b
  elif add=='-':
    return a-b
  elif add =='*':
    return a*b
  elif add =='/':
    return a/b;
'''





def op(a, b):
  if a[0]==b[0]:
    return True
  else:
    end1=len(a)-1
    end2=len(b)-1
    if a[end1]==b[end2]:
        return True
  return False
print(op([1,2,3],[4,5]))




'''
try:
  print(operation('/',10,2))
except Exception as e:
  print('ERROR IS/n')
  print(str(e))

  #print(traceback.format_exc)
'''
