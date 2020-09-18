<?php
/*
	Travel Theme's Front Page to Display the Home Page if Selected
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/
get_header(); 
$heding = esc_html(travel_get_option('fpheading', ''));
if($heding) $heding = '<div class="label-text"><h3>'.$heding.'</h3></div>';
?>
</div><div class="vspace"> </div>
<?php echo $heding; ?>
<div id="container">
<?php get_template_part( 'featured-box' ); ?> 
<?php if (travel_get_option('fpostex', '2') != '1'): get_template_part( 'fcontent' ); endif;?>
<div class="content-ver-sep"></div>
</div>
<?php get_footer(); ?>