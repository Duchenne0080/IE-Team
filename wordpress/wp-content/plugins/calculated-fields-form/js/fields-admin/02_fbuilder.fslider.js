		$.fbuilder.typeList.push(
			{
				id:"fslider",
				name:"Slider",
				control_category:1
			}
		);
        $.fbuilder.controls[ 'fslider' ] = function(){};
		$.extend(
			$.fbuilder.controls[ 'fslider' ].prototype,
			$.fbuilder.controls[ 'ffields' ].prototype,
			{
				title:"Slider",
				ftype:"fslider",
				exclude:false,
				predefined:"",
				predefinedMin:"",
				predefinedMax:"",
				predefinedClick:false,
				size:"small",
				thousandSeparator:",",
				centSeparator:".",
				min:0,
				max:100,
				step:1,
				range:false,
				caption:"{0}",
				minCaption:"",
				maxCaption:"",
				display:function()
					{
						return '<div class="fields '+this.name+'" id="field'+this.form_identifier+'-'+this.index+'" title="'+this.name+'"><div class="arrow ui-icon ui-icon-play "></div><div title="Delete" class="remove ui-icon ui-icon-trash "></div><div title="Duplicate" class="copy ui-icon ui-icon-copy "></div><label>'+this.title+'</label><div class="dfield"><input class="field disabled '+this.size+'" type="text" value="'+( ( !this.range ) ? $.fbuilder.htmlEncode( this.predefined ) : $.fbuilder.htmlEncode( '['+this.predefinedMin+','+this.predefinedMax+']' ) )+'"/><span class="uh">'+this.userhelp+'</span></div><div class="clearer"></div></div>';
					},
				editItemEvents:function()
					{
						var evt = [
							{s:"#sSize",e:"change", l:"size"},
							{s:"#sMin",e:"change keyup", l:"min"},
							{s:"#sMax",e:"change keyup", l:"max"},
							{s:"#sStep",e:"change keyup", l:"step"},
							{s:"#sRange",e:"change", l:"range", f:function(el){
								var v = el.is(':checked');
								$( 'div.range'    )[ ( v ) ? 'show' : 'hide' ]();
								$( 'div.no-range' )[ ( v ) ? 'hide' : 'show' ]();
								return v;
								}
							},
							{s:"#sCaption",e:"change keyup", l:"caption"},
							{s:"#sMinCaption",e:"change keyup", l:"minCaption"},
							{s:"#sMaxCaption",e:"change keyup", l:"maxCaption"},
							{s:"#sPredefinedMin",e:"change keyup", l:"predefinedMin"},
							{s:"#sPredefinedMax",e:"change keyup", l:"predefinedMax"},
							{s:"#sThousandSeparator",e:"change keyup", l:"thousandSeparator"},
							{s:"#sCentSeparator",e:"change keyup", l:"centSeparator"}
						];
						$.fbuilder.controls[ 'ffields' ].prototype.editItemEvents.call(this, evt);
					},
				showRequired: function(){ return ''; },
				showPredefined: function()
					{
						return '<div class="no-range" style="display:'+( ( this.range ) ? 'none' : 'block')+';"><label>Predefined Value</label><input type="text" class="large" name="sPredefined" id="sPredefined" value="'+$.fbuilder.htmlEncode( this.predefined )+'"></div><div class="range" style="display:'+( ( this.range ) ? 'block' : 'none')+';"><div class="column"><label>Predefined Min</label><br /><input type="text" name="sPredefinedMin" id="sPredefinedMin" value="'+$.fbuilder.htmlEncode( this.predefinedMin )+'" style="width:95%;"></div><div class="column"><label>Predefined Max</label><br /><input type="text" name="sPredefinedMax" id="sPredefinedMax" value="'+$.fbuilder.htmlEncode( this.predefinedMax )+'" style="width:95%;"></div><div class="clearer"></div></div>';
					},
				showRangeIntance: function()
					{
						return '<div><div class="column" style="width:30%;"><label>Min</label><br /><input type="text" name="sMin" id="sMin" value="'+$.fbuilder.htmlEncode(this.min)+'" placeholder="0 by default" style="width:95%;"></div><div class="column" style="width:30%;"><label>Max</label><br /><input type="text" name="sMax" id="sMax" value="'+$.fbuilder.htmlEncode(this.max)+'" placeholder="100 by default" style="width:95%;"></div><div class="column" style="width:30%;"><label>Step</label><br /><input type="text" name="sStep" id="sStep" value="'+$.fbuilder.htmlEncode(this.step)+'" placeholder="1 by default" style="width:95%;"></div><div class="clearer"></div></div><div style="margin-bottom:10px;"><i>It is possible to associate other fields in the form with the attributes "min", "max" and "step". Ex: fieldname1</i></div><div><input type="checkbox" name="sRange" id="sRange" '+( ( this.range ) ? 'CHECKED' : '' )+' /> Range slider </div><div><label>Field Caption</label><br /><input class="large" type="text" name="sCaption" id="sCaption" value="'+$.fbuilder.htmlEncode( this.caption )+'"></div><div><label>Min Corner Caption</label><br /><input class="large" type="text" name="sMinCaption" id="sMinCaption" value="'+$.fbuilder.htmlEncode( this.minCaption )+'"></div><div><label>Max Corner Caption</label><br /><input class="large" type="text" name="sMaxCaption" id="sMaxCaption" value="'+$.fbuilder.htmlEncode( this.maxCaption )+'"></div><div><label>Symbol for grouping thousands in the field\'s caption(Ex: 3,000,000)</label><input type="text" name="sThousandSeparator" id="sThousandSeparator" class="large" value="'+$.fbuilder.htmlEncode( this.thousandSeparator )+'" /></div><div><label>Decimals separator symbol (Ex: 25.20)</label><input type="text" name="sCentSeparator" id="sCentSeparator" class="large" value="'+$.fbuilder.htmlEncode( this.centSeparator )+'" /></div>';
					}
		});