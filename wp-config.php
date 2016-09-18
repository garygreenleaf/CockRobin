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
define('DB_NAME', 'cockrobin');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'brabantia');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'q3;vSzLOae+^MAM?954V&[FTMm|NLT93rsnZ q<p*N} BO6/Z9[-el|VT.Cs<+oB');
define('SECURE_AUTH_KEY',  'f6c0E-WC&iE<LO{%Z2vu&l!$+hk+5K-hdm^m|y4,Q<]G2h*%sY+6W~`PVpYj`-,a');
define('LOGGED_IN_KEY',    'NoOB`+wg_~U+`P^D7/;]1}-,amE-[}?{z!(?{YM+*9|]0J<A(Gr%^%h7*KN$$B`)');
define('NONCE_KEY',        'Ub t*~r#kex>s?X`@s@U8|y!&nZ~~6jK$~Wp-+_p8`mGVJwN+a`VUQ`~y4jhGD=Y');
define('AUTH_SALT',        '{QmR-G~.(6KA-.A9+^LLC[dryL@%0V[+r`cO,~%,r/QY1%`exc_6(0gfXce/zPgC');
define('SECURE_AUTH_SALT', '|m*nfaF76BZvT?Zh i!qn$_|+#b,rc^no-m1yB}o01a1o4gEvN;bw<`oVEx3C6}k');
define('LOGGED_IN_SALT',   '*.w5=C9VHC#s#eL<wr-k3_c[#(GW|8,+K!|sL1g2p38e0CVAc?mc%#5PL-kuQGr7');
define('NONCE_SALT',       'dYVq)QR8~9;g=z+2-(M2c7]8-Sxy[7p+|[,v:92N+=Ua(?Vmj@cMpgr%$Dn=z@SA');

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
