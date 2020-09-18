<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );
define('FS_METHOD','direct');
define('FS_CHMOD_DIR',0777);
define('FS_CHMOD_FILE',0777);

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '12345678' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'sudsVW4gH0,+-Av=|dW!nP _z1QsFw^Qg|uieiS3<[?!D>l(6/}:5<nSJc}7WnA7' );
define( 'SECURE_AUTH_KEY',  '.2,-a:OLq/E`[sG](pZ.EmcD1{>H4dnbr9v{r0sxoHgH2syljs/{Q.-KXO-AZ`{0' );
define( 'LOGGED_IN_KEY',    'vBmfX6/3winY^,kCo&JD~:v)2dGmr89X;_V26+}jy5{qQ*Z%_#BUnsG{x&J.I@+9' );
define( 'NONCE_KEY',        'C9i0~kRx{AC3L#(+Y,_nEQ%)3C_hnRc@`OzRfM,6*plJIpzWs[HnJoDn3m<*]8F;' );
define( 'AUTH_SALT',        'p0~+:+7F4S-5JJ_y:~X|!AJ~u{6z=jy$M2T0+ToMNc,cc>2F.Rs)W8.!Cye;L:${' );
define( 'SECURE_AUTH_SALT', '/`tK/n,[QiIwH6eF{B w$,n#e;_J6Y4u3`Yyq-J,8yGB7Y}n%2^91r}Vo;Ac3{`*' );
define( 'LOGGED_IN_SALT',   '3eEmJ^D0KZZ5Gr!~MPK)?~-.VP7:/q-8f))4u-*_[)f0E3.ufmf7_9y-qv}Xf+/Y' );
define( 'NONCE_SALT',       ',+mt~v|x8i,JC6;cMA45#n/O/LlGk#E/I>Z KrX(K|.:CH+7z!5YYoOL|P5~gQ$~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
