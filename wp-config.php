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
	
define( 'WP_AUTO_UPDATE_CORE', false );
define('FS_METHOD', 'direct');

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'cake' );
/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:8888' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '*Hd/oWG[3]/RUG4B8{ ep:~eXur~QYWFK!B{GG.GNfkC(OaETiMv|-]ye;&p4um=');
define('SECURE_AUTH_KEY',  '-E%^~iERw%.uWSR/FCk(9H8g~+lCe|(4w>y*--F;^&MJ.&)q2-FoRR)~>AoJ 2./');
define('LOGGED_IN_KEY',    'pQ[UKK,f$h~nEc!cO4&=1-50Ye9F4Gu]dA=2P|`Xi dVFD>pm|r7f|@C4j*qi_%M');
define('NONCE_KEY',        ';}PxWjr%3U$Y18:jcaL-zw;o|fs-[}F,x9+`O1S++mQY8J_a;=_sQc +ss{GKurj');
define('AUTH_SALT',        '9*tk`{&TUnfi7?7|B(exFWxA+V^9qXWC`?l#-`)?W|Li6nJBX;NN71?u.+rJ~zM3');
define('SECURE_AUTH_SALT', 'Gs?IllDMP>@s|&pP}28*^c=-su2KZ`Jy*nig;vN9al,6Bi_HQYvu%/o4+B|kJe|Q');
define('LOGGED_IN_SALT',   '72l0]1p=U}-&X_U9]MD%!P9^WFB<+hx]}yM<5{Qq+c%u$J%?X]}8=NjUT.2SU+I;');
define('NONCE_SALT',       'M4RfQCp-Ul|JEX;Spn`6+|8a^RLV[J~|.`+N|a@(q ?q.z-u7>K|Fg-H-_,:_p#z');


/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
