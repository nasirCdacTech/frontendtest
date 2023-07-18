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
define( 'DB_NAME', 'frontendtest' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '?[e3GU4~g6p1q(4>/M]E5e!f$W]f],V_|{@a:[*(^<|tJ*zUBZkG=EQld~|=vNY2' );
define( 'SECURE_AUTH_KEY',  '*bz(Rc0a26eUT$m@^4(jx7s?/`nu8-AL;&A-2K=j[[G02o:8&{3JB.qw%tsLikjt' );
define( 'LOGGED_IN_KEY',    'SizpxzPeHqqlhr$?hrk<Qbl&Md#_2{ACx.0:x<|Nh+Iu`GB3/5ml6k2clPZJ?eYT' );
define( 'NONCE_KEY',        '0#hn^&OV=mbou*>dU=HQnI[zYle:yD8FY^;+,h3r!!((v,*V4F4q#38ojVqLjEk!' );
define( 'AUTH_SALT',        '((a,}+r WPuK]Utq82W6JEb) Oi9$fU xu3)YvDWW6fmw4A([q6N.2b7Z;nhIeFB' );
define( 'SECURE_AUTH_SALT', 'P0qK*@67~]}i VRh|f?k/l6LjE}!6AacAC{mlck6AW8qdx=~TeVh5HbuCy=J7Dg^' );
define( 'LOGGED_IN_SALT',   ',tC+T-39B}@cfekjcH5p<O<MOG{$2Cl_a:kO~}87{[Bwu`roCB/a`kHb_LEo9Q$Y' );
define( 'NONCE_SALT',       '+O.RSCaIlh(7S5jL]eu5au1l#S_^N9DE=9Z*IR[Iihb&XW9hoQF>[>,m7l0?8ps6' );

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
