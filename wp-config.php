<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'signal' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7s @h]6+dtGgpO~g_0Bi9(%l(:[?(9<jpknYG&BdR(2db|bbe$K`N[0,f8)99czB' );
define( 'SECURE_AUTH_KEY',  'O,~6Z6CR]3JLcdQGH/tx>uyUw!O~?Ft?ISywZ!l(vt,#7W#p%+|bj6z;260fYlH5' );
define( 'LOGGED_IN_KEY',    '^ V+z>OVk`R-lZ8PE6yo+ ,-Wd<a%t5fJx+w~]K%,b=gnE@d|;/}cf16O-30aL5$' );
define( 'NONCE_KEY',        '7V_n/@1lirLDhJ&l72z]5d<(D8w(43.0N2P;k`s_:QQtG}<=>PwUTg4]Smm5VZ*t' );
define( 'AUTH_SALT',        'vgzakfr;64R5(a{0ptZ:]ukCnNd@F{t)j-k/ayWz;Vk|&rh{IX!GLfO{+e4v+:OF' );
define( 'SECURE_AUTH_SALT', '=~LFkAAjp)2g#ZT:^gx0FjVqtm%M7U$6NxHey02wpo7hMg!f:@a:e?oqjMU>wN0E' );
define( 'LOGGED_IN_SALT',   ';g>;7%Zu+Y|CCS.:XEXUquBzqhyp%&HY!G`XJtL0w.1.>>HKh+23VjWct~x=c;:{' );
define( 'NONCE_SALT',       '%rA^^>($Y|B{{{V4X.CXI8@8P?#y`uCT6~-qv{~D;.v+*s32WP%+rss8ioH?{rA$' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
