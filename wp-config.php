<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'hoku-site' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'G[fMog]@]KSm -qJH{5?|Pe#(n0JE@DOl/$ebCrq}]]!1t+5,&.2EUf`=cI8;qxZ' );
define( 'SECURE_AUTH_KEY',  'V88)ApJK+wq>TZ2gheQjV!y;[_[pcC:j=,T=djx#pye[DQ#yfxXNt+hk~&p-:98X' );
define( 'LOGGED_IN_KEY',    'dUF7^(N@l r|2Fxcb#*#PQ|:cUn_RA ~~e6/Aq&H)~~{$NrC6C=^Sh[!ibFrW%}#' );
define( 'NONCE_KEY',        '!}h4v@ObuiB.:W3z_{&%|fE`rs[M)EIl0!QS()|RXT,nJ_4CO_fZwC-w9~p;- SF' );
define( 'AUTH_SALT',        '?boOa oCU:5bL vApF-nqPN+0_(lq3jRn=Y8OF>OlvEqj|60X2Tl59:L6+)F|87N' );
define( 'SECURE_AUTH_SALT', '*Q:-2jE=#:Od4l%t|3y#:eg|!1q,gMOK$Of?WyZ{o@;;sxa~y+&eA(=zCS&x2]Qj' );
define( 'LOGGED_IN_SALT',   'y&K[+o3]3H~Gh<dd)]9r%K6|M$vQ.nr0.KGDp;Dr85VP}NZ`0Xo@^J7kQ6)_GGJr' );
define( 'NONCE_SALT',       'jha:u6HXQlZI9b!oy^=e_eC}ov_r}4yiPl{io{hWS[8;|dX<.h?}u3kN))f4ayAT' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
