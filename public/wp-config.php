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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'rZlx+2Hc&9*S?T{C|=a{$5-Tr>3h]R6a<OMBJ8|~t-h]-N|X)81!62(ji1n=X]^c');
define('SECURE_AUTH_KEY',  '{#E[qB/rK:k0yT7|9|*f06j[t376JO#Cj9s]]gL2gZsQE-Ywd_)JU:3hWM-{tPw]');
define('LOGGED_IN_KEY',    'd}e9ZL:A.D4;,p]+j:C!|4MXvS24DV7t|rbwA<`aYLI)>2!q|m]0oqX+-4(.{r-=');
define('NONCE_KEY',        'r`4[z*B5L23!zPaXuqKH=-umv_&x_/$-d`&L|eu?iOqa+0>L#|Y5-oX}G0@:oN|E');
define('AUTH_SALT',        '!t;PFaSHHN$z+nr+Z.D<*-t{X(0T,X3>aC|XKKTQ048#AH#?:#;G|^t5EcVfDMCi');
define('SECURE_AUTH_SALT', 'g]d-<_Ha7Je-faEP$|Pcd-%/wNdTQ9x#3/I M&^QcGg+yVN;vT;VL+I|&x{Z#;7C');
define('LOGGED_IN_SALT',   '10>SB?lI`7^A4K`_=Kkd Fc(Bkjn]a!Y@63Syv6F<9_`#oa@@$FH)rM-v(%=(CP,');
define('NONCE_SALT',       ',e iS+J/@hw:(VB6U<+u$q13 oICjbZ|nsbd|rG]Z[r^P#vcWnMyL?%m^M)N|X7t');
/**#@-*/
/**
 * Updated Path for Wordpress Core Files and Content
 *
 * Because the wp-content directory isn’t in the same place as the core WordPress files ,
 * we need to tell the config file where it actually is.
 * The same with the core WordPress files.
 */

define('WP_ENVIRONMENT', 'Development');

if (WP_ENVIRONMENT == 'Production') {
	define('WP_ROOT', '');
} elseif (WP_ENVIRONMENT == 'Development') {
	define('WP_ROOT', '/wordpress/public');
}

define('WP_CONTENT_DIR', __DIR__ . '/wp-content');
define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . WP_ROOT . '/wp-content');
define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . WP_ROOT . '/wp');
define('WP_HOME', 'http://' . $_SERVER['SERVER_NAME'] . WP_ROOT);

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */

/**
 * Default Theme
 */

define('WP_DEFAULT_THEME', 'ColoredCow');

$table_prefix  = 'wp_a123456_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
