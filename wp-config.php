<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kin');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '1234');

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
define('AUTH_KEY',         '$d+4uno~TXWjJn3[=d^Vm|9d%9  &-srm{,N9F )21,#e? J|J#vGl|YG+Ly|=y1');
define('SECURE_AUTH_KEY',  'pu2`qr9((ke_dS=5Y[=7`l(3dy6U3_>zO/SQR!=G^ -sz{KBIA|/c0X~gR%||GHI');
define('LOGGED_IN_KEY',    '(ggi2g(cU)#G!Ri:--I,mT1R}VPr)IvNC;a4K,047QRm(wh|1I6`9LH(|$5WyE$l');
define('NONCE_KEY',        'fD0<^#Vv84lEV)xH4ss{U8<&`?zf3Z_Ej_D]E5e7DeQ55;/5A}m+IR.Lt 3/c,-C');
define('AUTH_SALT',        'jn*sA,CY}^/:d)kT7;hugrXgl9VSx;SPo)LG_lFwAE5]=O/oNf;15P6jWp)MhQoF');
define('SECURE_AUTH_SALT', 'R>M8:*nA1m~B e(MZ{zIpa!]FZl-.+:~`J$c2K>Q--&>V*0vB`mDn_ySpFRw)%tY');
define('LOGGED_IN_SALT',   '`}nUY[+Z2o@<J@=Q+NG+) [P[VnlsZ{1|qCAj|6+!Ws:%!{SETc2)P>PLB6[o%l;');
define('NONCE_SALT',       '%z,AR+_gY*R`_G1]doGR3M+:XIqk96=lAYd{Mvksf|;%Ys^@3(H,;g#H}Zb i9?f');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'zh_CN');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
