<?php
require_once CP_CALCULATEDFIELDSF_BASE_PATH.'/pagebuilders/beaverbuilder/cff/cff/cff.php';

// Get the forms list
global $wpdb;
$options = array();
$default = '';

$rows = $wpdb->get_results( "SELECT id, form_name FROM ".$wpdb->prefix.CP_CALCULATEDFIELDSF_FORMS_TABLE );
foreach ($rows as $item)
{
	$options[$item->id] = $item->form_name;
	if(empty($default)) $default = $item->id;
}

FLBuilder::register_module(
	'CFFBeaver',
	array(
		'cff-form-tab' => array(
			'title'	=> __('Select the form and enter the additional attributes', 'calculated-fields-form'),
			'sections' => array(
				'cff-form-section' => array(
					'title' => __('Form information', 'calculated-fields-form'),
					'fields'	=> array(
						'form_id' => array(
							'type' => 'select',
							'label' => __('Select form', 'calculated-fields-form'),
							'options' => $options,
							'default' => $default,
						),
						'class_name' => array(
							'type' => 'text',
							'label' => __('Class name', 'calculated-fields-form')
						),
						'attributes' => array(
							'type' => 'text',
							'label' => __('Additional attributes', 'calculated-fields-form')
						),
					)
				)
			)
		)
	)
);
