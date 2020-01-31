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
define( 'DB_NAME', 'task' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'X }T{9OY:y58!{z5j,w-Y+JMZhO$}}ax]l4:@(AIA1UzQ69qzhrssOQS/NJ|mJTR' );
define( 'SECURE_AUTH_KEY',  'V&3MT{tG*gi-Cl^|{S,ZL}1g%nnK/6r %,ax9`q/#$]XD7ljT=YtvJNjbFte?`Hh' );
define( 'LOGGED_IN_KEY',    'Esuvoh,CCkwqmi:KQ~|hGpb*vAgFQeAzx;r)m(|mh4N70ph*MVH~43/l3HVC%b?e' );
define( 'NONCE_KEY',        '`U3M=b(_;oYNCCf|Zgam*~#8iH;RHXp<BJ]0^D(p9VZ<rQNRrJy|]86Pa:]FhNG-' );
define( 'AUTH_SALT',        ' 1`>>Pmg,$=L4YO8PlT4H[~u^QZEUA,GpcZRL@KEt:zF53T_=NdbF;KOD*+gWqa{' );
define( 'SECURE_AUTH_SALT', ',G|IOu.kEIJ)pY:0j>s[Ih]O$XctcLaTPt2IPaAPPwU)p[.2P5Yet<$O_6ax 0s-' );
define( 'LOGGED_IN_SALT',   '_T<%nC=Q@%N^ fU:SS~VhECSyOP*UMI|5_dD7M] kxmo2d;S7!Ep`p:RWL|~7o.V' );
define( 'NONCE_SALT',       '2ym+2;hzm.g6IE*ot@OG;RHhei#Rp=nFrDF4Y3[7_EcsM{?,T{uvY76*kM%8u9y~' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_task_';

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
