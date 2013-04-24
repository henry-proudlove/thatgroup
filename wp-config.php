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
define('DB_NAME', 'thatgroup');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '+$|vh%A*(85{!n+^w@pu<U;dVh}l!%w(Q{6_]gG[vKx6_)NpJj!eec>r!Vllf3e?');
define('SECURE_AUTH_KEY',  ')lNA_NMcg6_z.=rW>)/JR<N#FeM%4xQBZBsj Ng?J!lal|,pyA<H_HnL.(5BTsQj');
define('LOGGED_IN_KEY',    'C*WHK!kUCaJPlfw#rCKl:_Yu3ZaH$^{V(QTstKgkY*O8&qL[Z5Z7=0nqKhV1_8!x');
define('NONCE_KEY',        'zQ5se{sP$3)JwqENt3pXpt(x-qv/~M8<|F+gWj^0;^E5x&d2VZaqLS N`G%sVk*~');
define('AUTH_SALT',        'YDrsgts/?|g@dBIlS^=<5[(U@$pjb0 6xG`251sQ9)cu/&F1u={&,E|RZ0<j=^wO');
define('SECURE_AUTH_SALT', 'hl||DZ??n~c Te,A=!e7As$l|wkIRqgqtAAF}`Kn~aY>P{b~iS0^S|37vc#8q2L6');
define('LOGGED_IN_SALT',   '{GMuI(Z^jCh{+U!,kEJ4CD&}dnsY?v<:*$Nuj3;;8tH@%D7=kR=px-*|W0cNj^=*');
define('NONCE_SALT',       'KN^qZ/8T<ZEntEfxr?p981TSx.0~&aO3lapBCgKj?L7qj1NM4T14F0t,SD&~.np[');

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
define('WPLANG', '');

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
