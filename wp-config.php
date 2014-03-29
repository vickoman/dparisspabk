<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'parisspadb');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'userweb');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'Mm0925163347');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'UxFK:p>+|^+FEuoWtoH--LRICA7I.iWb529+NZVB<>!NESk;E^LXeo&|zL-NTU|,'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', 'b9|*u`6S/t>+2;9!GQG1PR%@XCGv`T@T`Sc6/UIo{6~}?NQo1B7S+#xaX_M&x|Yw'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '%@?fgv,|s>3pt+>.nSr*^)yXH-EEnw%}DQLF^w4R(jH/x[Q}l/o;T!$ kT^!]rH6'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', '^*A$GDIN`|.(h%K0+N+:)r,Y):hDQ$7uI01Q/$}W~U>O+(*p{M.!7Eds$7YAtGlQ'); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', '-lyY%L^VWT#:}iWHIiwLNrR*MUw=4G5h-sgv08}B/)S0.3kxb?4Rt7a;6)H&_H,y'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'rJQ03p@p]lC<>RU#]Jot(hQ%HG.}mwoG rq4&CRPWt# [+sg`C)JQ)7PZNt_N60k'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', '#4)L{B[}XOtU]QpSi~v-oe |4IR{e-Hc%lxmfR6G/,UnAn0l6a},;oITcwwA=nXi'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '*}1-kH$4pN5<_Ikm? ooC}HxpZ/`<mp{tfZbV|S~tk_%@`W/tB0<_GHH6SuSOq I'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


