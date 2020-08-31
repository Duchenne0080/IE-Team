
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
define("FS_METHOD","direct");
define("FS_CHMOD_DIR",0777);
define("FS_CHMOD_FILE",0777);
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
define( 'AUTH_KEY',         '7>D[_YF>]h81+t_6zv}X@d?>-.vqjulVoV%X.Ee{CCc&ZD^4@HyK[Y5>R RFO)3o' );
define( 'SECURE_AUTH_KEY',  'T2OK &6-RSCfR @/{.3]Jf%pRS|[3lc2bA@eojp!A+R$`8%./xi-6fqU~o:yiFAU' );
define( 'LOGGED_IN_KEY',    'H=QsdP[3XWS=]IuCLsa3?P)#)Q&NBz6KALu|nO7@a)k*&UHmv{Jy:kK~z%=qDq)o' );
define( 'NONCE_KEY',        '<`wec:###|Uday6klA!_ya !5LX~:.WOLgN{JN*1[[FIiYIc/79g^v$BNe@(g5%W' );
define( 'AUTH_SALT',        '],M}h51aBHhVd_Y|y-u6pB,Y7|Z2w_!|BQcHeyXJdykO^5G(_@),8rXC1)/|_xc|' );
define( 'SECURE_AUTH_SALT', 'ORGsvkFI~{m&O}qSNzdslb*~bIaQNeI11bLkmEHuOfVzIx/oPa :`Q5NrDRqSIgX' );
define( 'LOGGED_IN_SALT',   'wW?V2(mH`NTVYZi]Qo(liNc67,{N&~p}*#v^!+4C:56679+~3<<)=N(F@jv{HXO#' );
define( 'NONCE_SALT',       '>]`=RtM>9f)C*/v`ji>qo3S~k@S_bD..AlEwd(A>:V:e PQ>;A6xG(ic((}<-Q:@' );

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
