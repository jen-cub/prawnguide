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
define('DB_NAME', 'ms_prwng');

/** MySQL database username */
define('DB_USER', 'ms_prwng');

/** MySQL database password */
define('DB_PASSWORD', 'r3d-Shr!mp+barb1e');

/** MySQL hostname */
define('DB_HOST', 'gpap-microsites-1-db.c.gpap-it.internal');

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
define('AUTH_KEY',         'gAOTB;Sj=np_Wk4mcBxfU@gjI5QE.CeA{tTb-.6LQO6KKE2y^3g7_1AQ-Ky-| :#');
define('SECURE_AUTH_KEY',  'Ms27vmA4*~l6m-XjFB0P9Z?/hi}LK>/H.>*j?IMb[@/CF;8ZtBF( ~O^q(2O{x`-');
define('LOGGED_IN_KEY',    '}r]>9]e#jr| .lB/ABqg+ENDBDwKo5bt^YEl0+eP|BYABP>~mtm~h:!@-LxxuIn!');
define('NONCE_KEY',        '1%kMl4?I]l+s0WLIdsu@c-y3kU9`B$25j|g1+1]YNTx3Z5yQ}J9MpWK}v,YyM2LT');
define('AUTH_SALT',        '1X`^YBzs !_j4/+yaC#M]M-xx@y$3f]1qPFW@GK>-@9o.|6|x&zR7@,$d^y2.l&q');
define('SECURE_AUTH_SALT', '~mxbzx1 n9~7+En;dg^xY/P+}LXP6!^IFd1zF?,w_!rO}N&Zf`pG9UifpS2;78ax');
define('LOGGED_IN_SALT',   '2+IQ;#-0J|Z07!6`)]1W1y8irO<nNe_=8{YB%=+;1ABjU>Ld0lQc Qn+j=wF:-OP');
define('NONCE_SALT',       'qVe>}@8D,=y|P9I-{tG{lG^mw~A-e7|qG#YqL;f/3F4huppaABx-8P{qG{}-WkOS');

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
