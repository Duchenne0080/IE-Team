fbuilderjQuery = (typeof fbuilderjQuery != 'undefined' ) ? fbuilderjQuery : jQuery;
fbuilderjQuery[ 'fbuilder' ] = fbuilderjQuery[ 'fbuilder' ] || {};
fbuilderjQuery[ 'fbuilder' ][ 'modules' ] = fbuilderjQuery[ 'fbuilder' ][ 'modules' ] || {};

fbuilderjQuery[ 'fbuilder' ][ 'modules' ][ 'default' ] = {
	'tutorial'		: 'https://cff.dwbooster.com/documentation#mathematical-module',
	'toolbars'		: {
		'mathematical' : {
			'label' 	: "Mathematical Operations",
			'buttons' 	: [
							{ "value" : "+", 		"code" : "+", 		"tip" : "" },
							{ "value" : "-", 		"code" : "-", 		"tip" : "" },
							{ "value" : "*", 		"code" : "*", 		"tip" : "" },
							{ "value" : "/", 		"code" : "/", 		"tip" : "" },
							{ "value" : "(", 		"code" : "(", 		"tip" : "" },
							{ "value" : ")", 		"code" : ")", 		"tip" : "" },
							{ "value" : ",", 	   	"code" : ",", 		"tip" : "" },
							{ "value" : "SUM",   	"code" : "SUM(",   	"tip" : "Returns the sum of values passed by parameter. <strong>SUM(3,10,11)</strong> returns <strong>24</strong>" },
							{ "value" : "CONCATENATE",   	"code" : "CONCATENATE(",   	"tip" : "Returns a text with all parameters concatenated. <strong>CONCATENATE(1, 2, 3)</strong> returns <strong>123</strong>" },
							{ "value" : "ABS",   	"code" : "ABS(",   	"tip" : "Returns the absolute value of the number passed as parameter. <strong>ABS(number)</strong>" },
							{ "value" : "CEIL",  	"code" : "CEIL(",  	"tip" : "Returns the next higher integer that is greater than or equal to the number passed as parameter. <strong>CEIL(number)</strong><br>The CEIL operation accepts a second parameter for rounding the number to the next multiple of this second parameter. <strong>CEIL(X,Y)</strong>" },
							{ "value" : "FLOOR", 	"code" : "FLOOR(", 	"tip" : "Returns the next lower integer that is less than or equal to the number passed as parameter. <strong>FLOOR(number)</strong><br>The FLOOR operation accepts a second parameter for rounding the number to the previous multiple of this second parameter. <strong>FLOOR(X,Y)</strong>" },
							{ "value" : "ROUND", 	"code" : "ROUND(", 	"tip" : "Returns an integer that follows rounding rules. If the value of the passed parameter is greater than or equal to x.5, the returned value is x+1; otherwise the returned value is x. <strong>ROUND(number)</strong><br>The ROUND operation accepts a second parameter for rounding the number to the nearest multiple of this second parameter. <strong>ROUND(X,Y)</strong>" },
							{ "value" : "PREC",  	"code" : "PREC(",  	"tip" : "Returns the value of the number passed in the first parameter with so many decimal digits as the number passed in the second parameter. <strong>PREC(number1, number2)</strong>" },
							{ "value" : "AVERAGE",   	"code" : "AVERAGE(",   	"tip" : "Returns the average of values passed by parameter. <strong>AVERAGE(3,10,11)</strong> returns <strong>8</strong>" },
							{ "value" : "CDATE", 	"code" : "CDATE(", 	"tip" : "Returns the number formatted like a Date. <strong>CDATE(number,format)</strong>. The second parameter defines the format of the output date: &quot;mm/dd.yyyy&quot;, &quot;dd/mm/yyyy&quot;" },
							{ "value" : "LOG",   	"code" : "LOG(",   	"tip" : "Returns the natural logarithm (base e) of the number passed as parameter. <strong>LOG(number)</strong>" },
							{ "value" : "LOGAB",   	"code" : "LOGAB(",   	"tip" : "Returns the logarithm of A (base B). <strong>LOGAB(number, base)</strong>" },
							{ "value" : "POW",   	"code" : "POW(",   	"tip" : "Returns the value of the first parameter raised to the power of the second parameter. <strong>POW(number1, number2)</strong>" },
							{ "value" : "SQRT",  	"code" : "SQRT(",  	"tip" : "Returns the square root of the number passed as parameter. <strong>SQRT(number1, number2)</strong>" },
							{ "value" : "MAX",   	"code" : "MAX(",   	"tip" : "Returns the greater value of the two parameters. <strong>MAX(number1, number2)</strong>" },
							{ "value" : "MIN",   	"code" : "MIN(",   	"tip" : "Returns the lesser value of the two parameters. <strong>MIN(number1, number2)</strong>" },
							{ "value" : "GCD",   	"code" : "GCD(",   	"tip" : "Returns greatest common divisor between the two parameters. <strong>GCD(number1, number2)</strong>" },
							{ "value" : "LCM",   	"code" : "LCM(",   	"tip" : "Returns the least common multiple between two parameters. <strong>LCM(number1, number2)</strong>" },
							{ "value" : "SIN",   	"code" : "SIN(",   	"tip" : "SIN(x) returns the sine of x (x in radians).<br> <strong>SIN(3) = 0.1411200080598672</strong>" },
							{ "value" : "COS",   	"code" : "COS(",   	"tip" : "COS(x) returns the cosine of x (x in radians).<br> <strong>COS(3) = -0.9899924966004454</strong>" },
							{ "value" : "TAN",   	"code" : "TAN(",   	"tip" : "TAN(x) returns the tangent of x (x in radians).<br> <strong>TAN(3) = -0.1425465430742778</strong>" },
							{ "value" : "ASIN",   	"code" : "ASIN(",   	"tip" : "ASIN(x) returns the arcsine of x (x in radians).<br> <strong>ASIN(0.5) = 0.5235987755982989</strong>" },
							{ "value" : "ACOS",   	"code" : "ACOS(",   	"tip" : "ACOS(x) returns the arccosine of x (x in radians).<br> <strong>ACOS(0.5) = 1.0471975511965979</strong>" },
							{ "value" : "ATAN",   	"code" : "ATAN(",   	"tip" : "ATAN(x) returns the arctangent of x (x as a numeric value between -PI/2 and PI/2 radians).<br> <strong>ATAN(2) = 1.1071487177940904</strong>" },
							{ "value" : "ATAN2",   	"code" : "ATAN2(",   	"tip" : "ATAN2(y,x) returns the angle in radians between the plane and the point (x,y).<br> <strong>ATAN2(90,15) = 1.4056476493802699</strong>" },
							{ "value" : "ATANH",   	"code" : "ATANH(",   	"tip" : "ATANH(x) returns the hyperbolic arctangent of the number x.<br> <strong>ATANH(0.5) = 0.549306144334055</strong>" },
							{ "value" : "DEGREES",   	"code" : "DEGREES(",   	"tip" : "DEGREES(x) converts the x in radians to degrees.<br> <strong>DEGREES(1.5707963267948966) = 90</strong>" },
							{ "value" : "RADIANS",   	"code" : "RADIANS(",   	"tip" : "RADIANS(x) converts the x in degrees to radians.<br> <strong>RADIANS(90) = 1.5707963267948966</strong>" }
						]
		},

		'logical' : {
			'label' 	: "Logical Operators",
			'buttons' 	: [
							{ "value" : "==",   	"code" : "==", "tip" : "Equality operator. <strong>fieldname1 == fieldname2</strong>" },
							{ "value" : "!=",   	"code" : "!=", "tip" : "Not equal operator. <strong>fieldname1 != fieldname2</strong>" },
							{ "value" : "<",   	"code" : "<",  "tip" : "Less than operator. <strong>fieldname1 &lt; fieldname2</strong>" },
							{ "value" : "<=",   	"code" : "<=", "tip" : "Less than or equal to operator. <strong>fieldname1 &lt;= fieldname2</strong>" },
							{ "value" : ">",   	"code" : ">",  "tip" : "Greater than operator. <strong>fieldname1 &gt; fieldname2</strong>" },
							{ "value" : ">=",   	"code" : ">=", "tip" : "Greater than or equal to operator. <strong>fieldname1 &gt;= fieldname2</strong>" },
							{ "value" : "IF",   	"code" : "IF(",   	"tip" : "Checks whether a condition is met, and returns one value if true, and another if false. <strong>IF(logical_test, value_if_true, value_if_false)</strong>" },
							{ "value" : "AND",  	"code" : "AND(",  	"tip" : "Checks whether all arguments are true, and return true if all values are true. <strong>AND(logical1,logical2,...)</strong>" },
							{ "value" : "OR",  		"code" : "OR(",  	"tip" : "Checks whether any of arguments are true. Returns false only if all arguments are false. <strong>OR(logical1,logical2,...)</strong>" },
							{ "value" : "NOT", 		"code" : "NOT(", 	"tip" : "Changes false to true, or true to false. <strong>NOT(logical)</strong>" },
							{ "value" : "IN", 		"code" : "IN(", 	"tip" : "Checks whether the term is included in the second argument, the second argument may be a string or strings array. <strong>IN(term, string/array)</strong>" }
						]
		},


	}
};