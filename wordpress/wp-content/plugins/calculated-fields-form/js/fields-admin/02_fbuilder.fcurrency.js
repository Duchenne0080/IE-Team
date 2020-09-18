		$.fbuilder.typeList.push(
			{
				id:"fcurrency",
				name:"Currency",
				control_category:1
			}
		);
        $.fbuilder.controls[ 'fcurrency' ] = function(){};
		$.extend(
			$.fbuilder.controls[ 'fcurrency' ].prototype,
			$.fbuilder.controls[ 'ffields' ].prototype,
			{
				title:"Currency",
				ftype:"fcurrency",
				predefined:"",
				predefinedClick:false,
				required:false,
				exclude:false,
				readonly:false,
				size:"small",
				currencySymbol:"$",
				currencyText:"USD",
				thousandSeparator:",",
				centSeparator:".",
				noCents: false,
				min:"",
				max:"",
				formatDynamically:false,
				twoDecimals:false,
				getPredefinedValue:function()
					{
						var me = this,
							v = $.trim( me.predefined );

						if(me.predefinedClick || !me.formatDynamically) return v;

						me.centSeparator = $.trim(me.centSeparator);
						if( /^\s*$/.test( me.centSeparator ) ) me.centSeparator = '.';


						v = v.replace( new RegExp( $.fbuilder[ 'escapeSymbol' ](me.currencySymbol), 'g' ), '' )
						     .replace( new RegExp( $.fbuilder[ 'escapeSymbol' ](me.currencyText), 'g' ), '' );

						v = $.fbuilder.parseVal( v, me.thousandSeparator, me.centSeparator );

						if( !isNaN( v ) )
						{
							if(this.twoDecimals) v = v.toFixed(2);
							v = v.toString();
							var parts = v.toString().split("."),
								counter = 0,
								str = '';

							if( !/^\s*$/.test( me.thousandSeparator ) )
							{
								for( var i = parts[0].length-1; i >= 0; i--){
									counter++;
									str = parts[0][i] + str;
									if( counter%3 == 0 && i != 0 ) str = me.thousandSeparator + str;

								}
								parts[0] = str;
							}
							if( typeof parts[ 1 ] != 'undefined' && parts[ 1 ].length == 1 ) parts[ 1 ] += '0';
							return this.currencySymbol+((this.noCents) ? parts[0] : parts.join(this.centSeparator))+this.currencyText;
						}
						else
						{
							return this.predefined;
						}
					},
				display:function()
					{
						return '<div class="fields '+this.name+'" id="field'+this.form_identifier+'-'+this.index+'" title="'+this.name+'"><div class="arrow ui-icon ui-icon-play "></div><div title="Delete" class="remove ui-icon ui-icon-trash "></div><div title="Duplicate" class="copy ui-icon ui-icon-copy "></div><label>'+this.title+''+((this.required)?"*":"")+'</label><div class="dfield"><input class="field disabled '+this.size+'" type="text" value="'+$.fbuilder.htmlEncode(this.getPredefinedValue())+'"/><span class="uh">'+this.userhelp+'</span></div><div class="clearer"></div></div>';
					},
				editItemEvents:function()
					{
						var f   = function(el){return el.is(':checked');},
							evt = [
							{s:"#sSize",e:"change", l:"size"},
							{s:"#sCurrencySymbol",e:"change keyup", l:"currencySymbol"},
							{s:"#sCurrencyText",e:"change keyup", l:"currencyText"},
							{s:"#sThousandSeparator",e:"change keyup", l:"thousandSeparator"},
							{s:"#sCentSeparator",e:"change keyup", l:"centSeparator"},
							{s:"#sFormatDynamically",e:"click", l:"formatDynamically",f:f},
							{s:"#sTwoDecimals",e:"click", l:"twoDecimals",f:f},
							{s:"#sNoCents",e:"click", l:"noCents",f:f},
							{s:"#sMin",e:"change keyup", l:"min"},
							{s:"#sMax",e:"change keyup", l:"max"}
						];
						$.fbuilder.controls[ 'ffields' ].prototype.editItemEvents.call(this, evt);
					},
				showSpecialDataInstance: function()
					{
						return this.showCurrencyFormat();
					},
				showCurrencyFormat: function()
					{
						var str = '<div><label>Currency Symbol</label><br /><input type="text" name="sCurrencySymbol" id="sCurrencySymbol" value="'+$.fbuilder.htmlEncode(this.currencySymbol)+'" class="large"></div>';
						str += '<div><label>Currency</label><br /><input type="text" name="sCurrencyText" id="sCurrencyText" value="'+$.fbuilder.htmlEncode(this.currencyText)+'" class="large"></div>';
						str += '<div><label>Thousands Separator</label><br /><input type="text" name="sThousandSeparator" id="sThousandSeparator" value="'+$.fbuilder.htmlEncode(this.thousandSeparator)+'" class="large"></div>';
						str += '<div><label>Cents Separator</label><br /><input type="text" name="sCentSeparator" id="sCentSeparator" value="'+$.fbuilder.htmlEncode(this.centSeparator)+'" class="large"></div>';
						str += '<div><label><input type="checkbox" name="sNoCents" id="sNoCents" '+( (this.noCents) ? 'CHECKED' : '')+'> Do Not Allow Cents</label><br /></div>';
						str += '<div><label><input type="checkbox" name="sFormatDynamically" id="sFormatDynamically" '+( (this.formatDynamically) ? 'CHECKED' : '')+'> Format Dynamically to </label> <label><input type="checkbox" name="sTwoDecimals" id="sTwoDecimals" '+( (this.twoDecimals) ? 'CHECKED' : '')+'> two decimal places</label><br /></div>';
						return str;
					},
                showRangeIntance: function()
					{
						return '<div class="clearer"></div><div class="column"><label>Min</label><br /><input type="text" name="sMin" id="sMin" value="'+$.fbuilder.htmlEncode(this.min)+'"></div><div class="column"><label>Max</label><br /><input type="text" name="sMax" id="sMax" value="'+$.fbuilder.htmlEncode(this.max)+'"></div><div class="clearer"  style="margin-bottom:10px;">Enter the min/max values as numbers, and not as currencies.<br /><i>It is possible to associate other fields in the form to the attributes "min" and "max". Ex: fieldname1</i></div>';
					}
		});