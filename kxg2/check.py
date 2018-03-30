import sys
import traceback
import py_compile

#var=sys.argv[1]
try:
	#py_compile.compile('test.py')
	#eval('test')
	#string=3+'a'
	#print('HELLO')

	f='exec.py'
	source=open(f,'r').read()+'\n'
	compile(source,f,'exec')

except (Exception,SyntaxError) as e:
	#print('ERROR FOUND : \n')
	print( 0 )
	exc_type, exc_value, exc_traceback = sys.exc_info()
	traceback.print_exception(exc_type, exc_value, exc_traceback,limit=2,file=sys.stdout)

	#traceback.format_excception(exc_type, exc_value)
	#print(e)
else:
	print(1)
