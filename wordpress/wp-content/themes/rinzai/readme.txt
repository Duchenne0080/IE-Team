=== Rinzai ===
Contributors: ivanfonin
Donate link: https://ivanfonin.com/
Tags: blog, education, photography, entertainment, food-and-drink, portfolio, news, one-column, two-columns, right-sidebar, grid-layout, translation-ready, custom-menu, custom-logo, featured-images, full-width-template. custom-header, editor-style, footer-widgets, post-formats, theme-options, threaded-comments
Requires at least: 4.7
Tested up to: 4.9.5
License: MIT License
License URI: https://opensource.org/licenses/MIT/

Rinzai is a modern and minimalist blogging theme for WordPress. See demo at https://demo.ivanfonin.com/rinzai/

== Description ==

Rinzai is a modern and minimalist blogging theme for WordPress. It has a
responsive layout, clean and easy to read typography, a three-column grid layout
on blog page, a widget area in blog sidebar, a special menu for your social
profiles, custom logo, featured images for posts and pages and much more.

See demo at https://demo.ivanfonin.com/rinzai/

For more information about Rinzai theme please go to https://ivanfonin.com/blog/rinzai-wordpress-theme/.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in Rinzai in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Go to https://demo.ivanfonin.com/rinzai/ to see configured demo.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.

== Copyright ==

Rinzai bundles the following third-party resources:

HTML5 Shiv, Copyright 2014 Alexander Farkas
Licenses: MIT/GPL2
Source: https://github.com/aFarkas/html5shiv/

normalize.css, Copyright 2012-2016 Nicolas Gallagher and Jonathan Neal
License: MIT License
Source: https://necolas.github.io/normalize.css/

UIkit v3, Copyright YOOtheme GmbH
License: MIT License
Source: https://github.com/uikit/uikit/

PT Sans Font, Copyright ParaType
License: Open Font License
Source: https://fonts.google.com/specimen/PT+Sans/

Yeseva One Font, Copyright Jovanny Lemonad
License: Open Font License
Source: https://fonts.google.com/specimen/Yeseva+One/

Screenshot image #1, Copyright Brooke Lark
License: CC0 1.0 Universal (CC0 1.0)
Source: https://www.lifeofpix.com/photo/noodles/

Screenshot image #2, Copyright Brooke Lark
License: CC0 1.0 Universal (CC0 1.0)
Source: https://www.lifeofpix.com/photo/blue-table-setting/

Screenshot image #3, Copyright Brooke Lark
License: CC0 1.0 Universal (CC0 1.0)
Source: https://www.lifeofpix.com/photo/morning-pancakes/

Screenshot image #4, Copyright Stacey Doyle
License: CC0 1.0 Universal (CC0 1.0)
Source: https://www.lifeofpix.com/photo/asian-soup/

Screenshot image #5, Copyright Brooke Lark
License: CC0 1.0 Universal (CC0 1.0)
Source: https://www.lifeofpix.com/photo/summer-salad/

== Changelog ==

= 1.1.6 =
* Released: October 13, 2018
* Removed sourcemaps from style.css file.

= 1.1.5 =
* Released: September 15, 2018
* Fixed blog custom header video partial. It was not echoing the mime type of the video.

= 1.1.4 =
* Released: May 19, 2018
* Removed set_transient function calls, it was "too much".
* Changed content padding for full-width page template.
* Edited russian translation for theme name in the footer and widget area.

= 1.1.3 =
* Released: May 14, 2018
* Fixed another front page template layout bug. Now it will work correctly.

= 1.1.2 =
* Released: May 14, 2018
* Fixed some typos in style.css Description.
* Fixed front page template layout bug, which happens if static page is not set.
* Fixed translation function for input placeholder in searchform.php file.

= 1.1.1 =
* Released: May 13, 2018
* Fixed style.css Description text.

= 1.1.0 =
* Released: May 13, 2018
* Added editory style file.
* Added custom header video support for blog page.
* Added WordPress Customizer support and couple of theme options.
* Added front page template with ability to show different page sections choosed in theme Customizer.
* Added separate sidebars for blog page, single post page and regular page.
* Added four footer widget areas.
* Added chevron down icon to navbar items with children.
* Added support for multi level navbar navigation.
* Added image post type format support.
* Refactored theme code and file structure.
* Fixed header and footer social menu markup.
* Fixed archive page template markup.
* Changed styling a little bit for logotype, social icons, sidebars, archive pages, blog page and single post page.
* Created child theme and added it's github link to the description.

= 1.0.8 =
* Released: December 13, 2017
* Updated UIkit v3 script to beta.35 version and refactored main script file.
* Fixed some typos in readme.txt file.
* Added new default.pot file and completed russian translation.
* Changed heading sizing on smaller screens via css.

= 1.0.7 =
* Released: December 11, 2017
* Added readme.txt file.

= 1.0.6 =
* Released: December 9, 2017
* All theme markup now passes W3C Markup Validator without any errors.
* Added two more social icons support - vk and odnoklassniki.
* Changed styling of featured image for single post and single page layouts.
* Added template for content on full width page and refactored page template markup.
* Added yoast breadcrumbs to page templates.
* Added sidebar to page.php and added page-sidebar widget area for it.
* Also added full width page template.
* Added styling to sidebar ul and li tags and removed sidebar custom render functions.
* Added styling to tag cloud widget, now all tags are equal size.
* Changed blog layout a little bit, increased sidebar and decreased posts size.
* Removed post formats support for now.
* Decreased header and widgets box shadow size.
* Changed background color to light gray.
* Added Yoast SEO breadcrumbs support.
* Changed layout in content.php for post with featured image and without.
* Replaced h1 tag with h2 in content.php and search.php.
* Changed copyright text position, classes and markup in footer.php.

= 1.0.5 =
* Released: September 23, 2017
* Fixed broken markup in footer.php.

= 1.0.4 =
* Released: September 21, 2017
* Prefixed theme style handle.
* Replaced screenshot.png and changed copyright info about used images.

= 1.0.3 =
* Released: September 21, 2017
* Prefixed theme script handle.
* Replaced Unsplash images on screenshot.png with CCO 1.0 licensed.

= 1.0.2 =
* Released: September 20, 2017
* Add unminified version for all JavaScript files.
* Changed CSS selectors in editor-style.css file.
* Removed support for search-form and comment-list  from functions.php as I added
* custom searchform.php and walkers.
* Added if( is_admin() ) return $length; to excerpt_length filter.
* Replaced esc_attr with esc_attr__ in searchform.php.
* Replaced date('Y') with date_i18n( __( 'Y','rinzai' ) ) in footer.php.
* Replaced https://wordpress.org/ with <?php echo esc_url( __( 'https://wordpress.org/', 'rinzai' ) ); ?> in footer.php.
* Added license information for fonts from Google Fonts catalog.

= 1.0.1 =
* Released: July 30, 2017
* Replaced cdn links in all wp_enqueue_script functions. Added js to theme folder.
* Changed screenshot.png to a right one.
* Provided unique theme prefix (rinzai) to all theme functions and variables.
* Replaced <?php echo wp_strip_all_tags( get_the_excerpt(), true ); ?> with wp_excerpt().
* Added wp_link_pages() to single posts and pages.
* Escaped translated texts inside html attributes with esc_attr().

= 1.0.0 =
* Released: July 24, 2017
* Initial release
