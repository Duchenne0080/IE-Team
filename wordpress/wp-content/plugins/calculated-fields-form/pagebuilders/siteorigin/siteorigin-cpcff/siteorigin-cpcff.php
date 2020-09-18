<?php
/*
Widget Name: Calculated Fields Form Shortcode
Description: Insert a form on page.
Documentation: https://cff.dwbooster.com/documentation#insertion-page
*/

class SiteOrigin_CFF_Shortcode extends SiteOrigin_Widget
{
	function __construct()
	{
		global $wpdb;
		$options = array();
		$default = '';
		$forms = $wpdb->get_results( "SELECT id, form_name FROM ".$wpdb->prefix.CP_CALCULATEDFIELDSF_FORMS_TABLE. " ORDER BY id ASC" );
		foreach($forms as $form)
		{
			if(empty($default)) $default = $form->id;
			$options[$form->id] = esc_html('('.$form->id.') '.$form->form_name);
		}

		parent::__construct(
			'siteorigin-cff-shortcode',
			__('Calculated Fields Form Shortcode', 'calculated-fields-form'),
			array(
				'description' 	=> __('Includes the shortcode for inserting a form', 'calculated-fields-form'),
				'panels_groups' => array('calculated-fields-form'),
				'help'        	=> 'https://cff.dwbooster.com/documentation#insertion-page',
			),
			array(),
			array(
				'form' => array(
					'type' 		=> 'select',
					'label' 	=> __( 'Form to include', 'calculated-fields-form' ),
					'default' 	=> $default,
					'options' 	=> $options
				),
				'class_name' => array(
					'type' 		=> 'text',
					'label'		=> __('Enter a class name to be assigned to the form (optional)', 'calculated-fields-form')
				),
				'attrs' => array(
					'type' 		=> 'text',
					'label'		=> __('Pass additional attributes to the form. Ex: attr_name="attr_value" (optional)', 'calculated-fields-form')
				),
			),
			plugin_dir_path(__FILE__)
		);
	} // End __construct

	function get_template_name($instance)
	{
        return 'siteorigin-cff-shortcode';
    } // End get_template_name

    function get_style_name($instance)
	{
        return '';
    } // End get_style_name

} // End Class SiteOrigin_CFF_Shortcode

// Registering the widget
siteorigin_widget_register('siteorigin-cff-shortcode', __FILE__, 'SiteOrigin_CFF_Shortcode');