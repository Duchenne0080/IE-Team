<?php
/* Travel Theme's Footer
	Copyright: 2012-2017, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Travel 1.0
*/
?>




</div> <!-- conttainer -->
<div id="footer">

<?php
   	get_sidebar( 'footer' );
?>
</div> <!-- footer -->

<div id="creditline"><?php echo '&copy; ' . date("Y"). ': ' . get_bloginfo( 'name' ) . '  '; travel_creditline(); ?></div>

<?php wp_footer(); ?>
</body>
</html>