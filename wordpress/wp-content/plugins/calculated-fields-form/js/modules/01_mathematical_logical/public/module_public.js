fbuilderjQuery = ( typeof fbuilderjQuery != 'undefined' ) ? fbuilderjQuery : jQuery;
fbuilderjQuery[ 'fbuilder' ] = fbuilderjQuery[ 'fbuilder' ] || {};
fbuilderjQuery[ 'fbuilder' ][ 'modules' ] = fbuilderjQuery[ 'fbuilder' ][ 'modules' ] || {};

fbuilderjQuery[ 'fbuilder' ][ 'modules' ][ 'default' ] = {
	'prefix' : '',
	'callback'		: function()
	{
		if(Number.prototype.LENGTH == undefined)
		{
			// Only LENGTH in uppercase to prevent a conflict with Lottie
			Number.prototype.LENGTH = function(){return this.valueOf().toString().length;};
		}

		function ROUNDx(operation, num, y)
		{
			if(y && y != 0)
			{
				var r  = operation(num/y)*y, p = (new String(y)).split('.');
				if(p.length == 2) r = PREC(r,p[1].length);
				return r;
			}
			else
			{
				return operation(num);
			}
		};

		if(window.ROUND == undefined)
		{
			window.ROUND = window.round = function(num, y)
			{
				if(y) return ROUNDx(Math.round, num, y);
				return ROUNDx(Math.round, num);
			}
		}

		if(window.FLOOR == undefined)
		{
			window.FLOOR = window.floor = function(num, y)
			{
				if(y) return ROUNDx(Math.floor, num, y);
				return ROUNDx(Math.floor, num);
			}
		}

		if(window.CEIL == undefined)
		{
			window.CEIL = window.ceil = function(num, y)
			{
				if(y) return ROUNDx(Math.ceil, num, y);
				return ROUNDx(Math.ceil, num);
			}
		}

		if(window.PREC == undefined)
		{
			window.PREC = window.prec = function (num, pr)
				{
					if('undefined' == typeof pr) pr = 0;
					if(/^\d+$/.test(pr) && $.isNumeric(num))
					{
						var f = POW(10,pr);
						num = ROUND(num*f)/f;
						return num.toFixed(pr);
					}
					return num;
				};
		} // End if window.PREC

		if(window.CDATE == undefined)
		{
			window.CDATE = window.cdate = function ( num, format )
				{
					format = ( typeof format != 'undefined' ) ? format : ( ( typeof window.DATETIMEFORMAT != 'undefined' ) ? window.DATETIMEFORMAT : 'dd/mm/yyyy' );

					if(isFinite(num*1))
					{
						num = Math.round(num*86400000);

						var date = new Date(num),
							d = date.getDate(),
							m = date.getMonth()+1,
							y = date.getFullYear(),
							h = date.getHours(),
							i = date.getMinutes(),
							s = date.getSeconds(),
							a = '';

						m = (m < 10) ? '0'+m : m;
						d = (d < 10) ? '0'+d : d;

						if( /a/.test( format ) )
						{
							a = ( h >= 12 ) ? 'pm' : 'am';
							h = h % 12;
							h = ( h == 0 ) ? 12: h;
						}
						h = (h < 10) ? '0'+h : h;
						i = (i < 10) ? '0'+i : i;
						s = (s < 10) ? '0'+s : s;

						return format.replace( /y+/i, y)
									 .replace( /m+/i, m)
									 .replace( /d+/i, d)
									 .replace( /h+/i, h)
									 .replace( /i+/i, i)
									 .replace( /s+/i, s)
									 .replace( /a+/i, a);
					}
					return num;
				};
		} // End if window.CDATE

		if(window.SUM == undefined)
		{
			window.SUM = window.sum = function ()
			{
				var r = 0, t;
				for(var i in arguments)
				{
					t = arguments[i]*1;
					if(!isNaN(t)) r += t;
				}
				return r;
			};
		} // End if window.SUM

		if(window.CONCATENATE == undefined)
		{
			window.CONCATENATE = window.concatenate = function ()
			{
				var r = '';
				for(var i in arguments) r += (new String(arguments[i]));
				return r;
			};
		} // End if window.CONCATENATE

		if(window.AVERAGE == undefined)
		{
			window.AVERAGE = window.average = function ()
			{
				return SUM.apply(this,arguments)/arguments.length;
			};
		} // End if window.AVERAGE

		if(window.GCD == undefined)
		{
			window.GCD = window.gcd = function( a, b)
				{
					if ( ! b) return a;
					return GCD(b, a % b);
				};
		} // End if window.GCD

		if(window.LCM == undefined)
		{
			window.LCM = window.lcm = function( a, b)
				{
					return (!a || !b) ? 0 : ABS((a * b) / GCD(a, b));
				};
		} // End if window.LCM

		if(window.LOGAB == undefined)
		{
			window.LOGAB = window.logab = function( a, b)
				{
					return LOG(a)/LOG(b);
				};
		} // End if window.LOGAB

		var math_prop = ["LN10", "PI", "E", "LOG10E", "SQRT2", "LOG2E", "SQRT1_2", "LN2", "cos", "pow", "log", "tan", "sqrt", "asin", "abs", "max", "exp", "atan2", "atanh", "random", "acos", "atan", "min", "sin"];

		for(var i = 0, h = math_prop.length; i < h; i++)
		{
			if( !window[ math_prop[ i ] ] )
			{
				window[ math_prop[ i ] ] = window[ math_prop[ i ].toUpperCase() ] = Math[ math_prop[ i ] ];
			}
		}

		if(window.RADIANS == undefined)
		{
			window.RADIANS = window.radians = function(a){ return a*PI/180;};
		}

		if(window.DEGREES == undefined)
		{
			window.DEGREES = window.degrees = function(a){ return a*180/PI;};
		}

		fbuilderjQuery[ 'fbuilder' ][ 'extend_window' ]( fbuilderjQuery[ 'fbuilder' ][ 'modules' ][ 'default' ][ 'prefix' ], CF_LOGICAL );
	},

	'validator'	: function( v )
		{
			return ( typeof v == 'number' ) ? isFinite( v ) : ( typeof v != 'undefined' );
		}
};