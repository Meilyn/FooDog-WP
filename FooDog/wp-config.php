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
define( 'DB_NAME', 'meicreations_com_di' );

/** MySQL database username */
define( 'DB_USER', 'meicreations_com_di' );

/** MySQL database password */
define( 'DB_PASSWORD', '003160Mc..' );

/** MySQL hostname */
define( 'DB_HOST', 'meicreations.com.mysql' );

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
define( 'AUTH_KEY',         '9d& x:>r7Wqxw?5 2H6w4a/[ o~Lv.;XWQqG edsDoyokZ>O ;AKD@U ho@M b8z' );
define( 'SECURE_AUTH_KEY',  'Ps15Inr[n>5Xbj#oT(dM<$h/b}mz?`/,=EWTuOz,!r;#H$qNc,p9wKmeD,)>fvpH' );
define( 'LOGGED_IN_KEY',    'r8Io/t$vQJ=8N>btr2EOod_.46yBpy)q*WT?1$kPWBm`6!;ZHT4_,1TGg*&k~z& ' );
define( 'NONCE_KEY',        'O>IufG(Bo}k)XE[Q/CqYh&3RVF}XiO?C%ql<zVVo_ cC{;+D)?Imz6YO[K`S%S.V' );
define( 'AUTH_SALT',        'vt0sd^j*i[[/j<Bci{}EQMyrO, GP>c+CB!O!O8Fksz?$WL!+JEhWO #Nk)E1)xD' );
define( 'SECURE_AUTH_SALT', '}F2HOZ$aT3x`J=Y~8XpVI?RP<e^|<~yN6ZaJ;;Qc<;WXMsVtq-uP,ZPAz7ayUwcM' );
define( 'LOGGED_IN_SALT',   's Q}h&[)Wgm1Z8B/1U3X3VUxk51v!0z^r[PfH/EU4WdY@,F05yj:2~~&.-VPD$P9' );
define( 'NONCE_SALT',       '>LJ0Qy_qQX?TS9|GLk&&kON7}>-~2)v~*CPbiR=WM2C8#zl+sdQLT1NaHn`d`770' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'fd_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
