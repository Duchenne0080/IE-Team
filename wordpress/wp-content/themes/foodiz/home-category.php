<?php
$foodiz_id1 = get_theme_mod('category_select_1');
$foodiz_id2 = get_theme_mod('category_select_2');
$foodiz_id3 = get_theme_mod('category_select_3');
if( $foodiz_id1 || $foodiz_id2 || $foodiz_id3 ) {
?>
<section class="section-padding-100 " id="category-section">
    <div class="container">  
    <div class="row justify-content-center">
        <!--  Category 1 Start  -->
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 cat-link-wrapper">
			<div class="categories_post">
			<?php if(get_theme_mod('category_image_1')) {
			$foodiz_img="foodiz_img"; ?>
			<img src="<?php echo esc_url(get_theme_mod('category_image_1')); ?>"> <?php } else { $foodiz_img="foodiz_noimg"; } ?>
            <div class="categories_details <?php echo esc_html($foodiz_img); ?>">
				<div class="cat-link">
					<h2><a href="<?php echo esc_attr(get_category_link($foodiz_id1)); ?>">
                <?php echo esc_html(get_cat_name($foodiz_id1)); ?></a></h2>
				</div>
			</div>
			</div>
        </div>  
        <!--  Category 2 Start  -->
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 cat-link-wrapper" >
			<div class="categories_post">
				<?php if(get_theme_mod('category_image_2')) {
			$foodiz_img="foodiz_img"; ?>
			<img src="<?php echo esc_url(get_theme_mod('category_image_2')); ?>"> <?php } else { $foodiz_img="foodiz_noimg"; } ?>
            <div class="categories_details <?php echo esc_attr($foodiz_img); ?>">
					<div class="cat-link">
						<h2><a href="<?php echo esc_url(get_category_link($foodiz_id2)); ?>"> <?php echo esc_html(get_cat_name($foodiz_id2)); ?></a></h2>
					</div>
				</div>
			</div>
        </div>
        <!--  Category 3 Start  -->
        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 cat-link-wrapper">
			<div class="categories_post">
				<?php if(get_theme_mod('category_image_3')) {
			$foodiz_img="foodiz_img"; ?>
			<img src="<?php echo esc_url(get_theme_mod('category_image_3')); ?>"> <?php } else { $foodiz_img="foodiz_noimg"; } ?>
            <div class="categories_details <?php echo esc_attr($foodiz_img); ?>">
					<div class="cat-link">
						<h2><a href="<?php echo esc_url(get_category_link($foodiz_id3)); ?>">
					<?php echo esc_html(get_cat_name($foodiz_id3)); ?></a></h2>
					</div>
				</div>
			</div>
		</div>          
	</div>          
	</div>          
</section>
<?php } ?>
<!--  Category Section End  -->