<?php
$var_name = sanitize_text_field($settings->var_name);
$default_value = sanitize_text_field($settings->default_value);
$from = sanitize_text_field($settings->from);

if(!empty($var_name))
{
	$output = '[CP_CALCULATED_FIELDS_VAR name="'.esc_attr($var_name).'"';

	if(!empty($from) && $from !== 'directly')
		$output .= ' from="'.esc_attr($from).'" default_value="'.esc_attr($default_value).'"';
	elseif($from === 'directly')
		$output .= ' value="'.esc_attr($default_value).'"';

	$output .= ']';
	echo $output;
}