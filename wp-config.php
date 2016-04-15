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
define('DB_NAME', getenv('DB_NAME'));

/** MySQL database username */
define('DB_USER', getenv('DB_USER'));

/** MySQL database password */
define('DB_PASSWORD', getenv('DB_PASSWORD'));

/** MySQL hostname */
define('DB_HOST', getenv('DB_HOST'));

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', getenv('DB_CHARSET'));

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', getenv('DB_COLLIATE'));

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',    getenv('NONCE_KEY'));
define('AUTH_SALT',  getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',    getenv('NONCE_SALT'));

// define('AUTH_KEY',         '(lH,Nfhb@nwMaojfi|05#A/jLJo.l(P*yn%>I|HJ}!&FuC<!<U-?6IHRI<4K4(.8');
// define('SECURE_AUTH_KEY',  'a:$&p|K&3&+o!8NA8FK-)1-08&X_RP?/z5Jov}~Iiu W&T&%|XI`.viA><e?HPxJ');
// define('LOGGED_IN_KEY',    'JLO@j$@Q;eelC|]]564}*3Kc0gL)`O^kqo`76@-<1&vhCt7>=-C,@ZJ$#*I6-A{.');
// define('NONCE_KEY',        'xoF|-snI6XL+le*E d$j_ukAk;KV*Dh>|>G@wpY#_ z_!%J3?7~vjR6TvIyT}CG>');
// define('AUTH_SALT',        'y3Viumz!~n8C&b->)>7c+lQx3$b!bv M{G,Mb+6*M6|alMb;CpF@&^hZ?LNa-^OZ');
// define('SECURE_AUTH_SALT', 'Na@4xJt0~!uS9B+$rLVjJ`Nb&>{qW}jsjrADb8{<Qo5ji~rLV50sjmX50B1A5;+w');
// define('LOGGED_IN_SALT',   'SGL2g=*#|q]@P)8P@Y|ugn~9}1e$T%qkR=N)-F$~D9xNYVjSzuLl3--y@kw%}+W5');
// define('NONCE_SALT',       '8}L|r9Z3N`WR0^`udMZ+O4+BW9c2ngU+Rwuq:kGCw<^5obsW,):?n$a0|1*`|#S?');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
