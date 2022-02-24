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

define('WP_CACHE', true);

$envVars = [
    ["name" => 'AUTH_KEY', "default" => ""],
    ["name" => 'SECURE_AUTH_KEY', "default" => ""],
    ["name" => 'LOGGED_IN_KEY', "default" => ""],
    ["name" => 'NONCE_KEY', "default" => ""],
    ["name" => 'AUTH_SALT', "default" => ""],
    ["name" => 'SECURE_AUTH_SALT', "default" => ""],
    ["name" => 'LOGGED_IN_SALT', "default" => ""],
    ["name" => 'NONCE_SALT', "default" => ""],
    ["name" => 'DB_NAME', "default" => ""],
    ["name" => 'DB_USER', "default" => ""],
    ["name" => 'DB_PASSWORD', "default" => ""],
    ["name" => 'DB_HOST', "default" => "localhost"],
    ["name" => 'DB_CHARSET', "default" => "utf8mb4"],
    ["name" => 'DB_COLLATE', "default" => ""],
    ["name" => 'DB_PREFIX', "default" => "wp_"],
    ["name" => 'AUTOMATIC_UPDATER_DISABLED', "default" => true],
    ["name" => 'DISABLE_WP_CRON', "default" => false],
    ["name" => 'DISALLOW_FILE_EDIT', "default" => true],
    ["name" => 'ABSPATH', "default" => dirname(__FILE__) . '/'],
    ["name" => 'WP_HOME', "default" => ""],
    ["name" => 'WP_SITEURL', "default" => ""],
    ["name" => 'WP_ENV', "default" => "prod"],
    ["name" => 'WP_DEBUG', "default" => false],
    ["name" => 'WP_CACHE', "default" => false],
    ["name" => 'WP_ALLOW_MULTISITE', "default" => false],
    ["name" => 'SUBDOMAIN_INSTALL', "default" => false],
    ["name" => 'DOMAIN_CURRENT_SITE', "default" => ""],
    ["name" => 'PATH_CURRENT_SITE', "default" => "/"],
    ["name" => 'SITE_ID_CURRENT_SITE', "default" => 1],
    ["name" => 'BLOG_ID_CURRENT_SITE', "default" => 1],
    ["name" => 'MULTISITE', "default" => false],
    ["name" => 'WP_POST_REVISIONS', "default" => 5],
    ["name" => 'WPCF7_ADMIN_READ_CAPABILITY', "default" => 'manage_options'],
    ["name" => 'WPCF7_ADMIN_READ_WRITE_CAPABILITY', "default" => 'manage_options']
];

$file_env = __DIR__.'/../.env';

if (file_exists($file_env) && !getenv('DB_HOST')) {
    $ini_env = parse_ini_file($file_env);

    foreach ($envVars as &$envVar) {
        if (isset($ini_env[$envVar['name']])) {
            $envVar['default'] = $ini_env[$envVar['name']];
        }
    }
}

foreach ($envVars as $envVar) {
    if (defined($envVar["name"])) {
        continue;
    }
    $envVarFile = getenv($envVar["name"]."_FILE");
    if (!empty($envVarFile)) {
        define($envVar["name"], file_get_contents($envVarFile));
    } else {
        $envVarValue = getenv($envVar["name"]);
        if (empty($envVarValue)) {
            $envVarValue = $envVar["default"];
        }
        if ($envVarValue === "true") {
            $envVarValue = true;
        }
        if ($envVarValue === "false") {
            $envVarValue = false;
        }
        if (is_numeric($envVarValue)) {
            $envVarValue = intval($envVarValue);
        }
        define($envVar["name"], $envVarValue);
    }
}

$table_prefix =  DB_PREFIX;

/* That's all, stop editing! Happy blogging. */

if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){

    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
}

if (WP_ENV == "development") {
    define('FS_METHOD', 'direct');
}

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');