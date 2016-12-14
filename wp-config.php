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
define('DB_NAME', 'ac_cms');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('CONCATENATE_SCRIPTS', false);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sWOjX{zqNA;>MTH4CvL7)R>bw}|cD6$$C1!w_[k}x*$|uY0^<0}?c,&Ejz!-dc<O');
define('SECURE_AUTH_KEY',  'ufMZ_-f,rG@NLn%)SJ(8QYx@F*T[E%JK[MwL0itA<Z.pX8EFb5>KwB=qPqlEu^}$');
define('LOGGED_IN_KEY',    '#nkuXqVs%~q#G$(aCnei#=%zkQ&jlG2W;X`Q2]#,-b8=(/o35ygeg0{z6#;XA;_J');
define('NONCE_KEY',        'r^V?Gy8n<b=ws-c;~g5u0G+(Ldj:Ho=,.^L*S,Fx/,&_(HHa=g0bAQH-S4[F-n/{');
define('AUTH_SALT',        'X:PSGjW`N{[+J8X|BF%9R^=|j0f<+ri!KZeTT*>>tk*$g]ma +@`I&BvYSX` Z@I');
define('SECURE_AUTH_SALT', '6QwWUW08)B;8&F:4H%vNe)!?DN/`u2K@2BSVl{UVU{3]aYWbwJsA! k,fEyW[w_L');
define('LOGGED_IN_SALT',   'Fw:N4sV-g8qXn(77)^l]vFNnZ.nhsxR<7PHh%2x<,2;]a)B7y#L2JVyIG{x}osq2');
define('NONCE_SALT',       '!::`B(sL@+O+8|-+vfs}Pg|;uN[n&<tqOg9t[-L~!Kg]K9g^d7L7kSw3VU*0On.7');

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
