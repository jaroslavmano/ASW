<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$nowPath = $_SERVER["DOCUMENT_ROOT"];

define("db_prefix","asw_");
define('web_url', "https://asware.local/");



// DEFINICE DB
$configFile = parse_ini_file('db_config.ini');

define('DB_SERVER', $configFile['db_host']);
define('DB_PORT', $configFile['db_port']);
define('DB_USERNAME', $configFile['db_username']);
define('DB_PASSWORD', $configFile['db_password']);
define('DB_DATABASE', $configFile['db_database']);

$configDiscordFile = parse_ini_file('discord_config.ini');

define('OAUTH2_CLIENT_ID', $configDiscordFile['client_id']);
define('OAUTH2_CLIENT_SECRET', $configDiscordFile['client_secret']);

// NASTAVENÍ URL ADRES PRO DISCORD
define('DISCORD_AUTHORIZE', "https://discordapp.com/api/oauth2/authorize");
define('DISCORD_TOKEN', "https://discordapp.com/api/oauth2/token");
define('DISCORD_REVOKE', "https://discordapp.com/api/oauth2/token/revoke");
define('DISCORD_BASE', "https://discordapp.com/api/users/@me");
define('DISCORD_REDIRECT', web_url."login/process.php");

if( file_exists("./inc/php/class/")){
// IMPORT DATABÁZOVÉ TŘÍDY
    require_once("./inc/php/class/mysql.php");

    $db = new SQL(DB_SERVER.":".DB_PORT,DB_DATABASE, DB_USERNAME, DB_PASSWORD);

// PŘIPOJENÍ SE K DB
    $db->Connection();

// IMPORT VŠECH DALŠÍCH TŘÍD
    require_once("./inc/php/class/user.php");
    require_once("./inc/language/czech.php");
    require_once("./inc/php/class/log.php");
    require_once("./inc/php/class/permissions.php");
    require_once("./inc/php/class/groups.php");
    require_once("./inc/php/class/modules.php");
    require_once("./inc/php/class/system.php");
    require_once("./inc/php/class/ranks.php");

    // PŘÍDAVNÉ MODULY
    require_once("./inc/php/class/tags.php");
    require_once("./inc/php/class/games.php");

// VYTVOŘENÍ LOGOVOÁNÍ
    $log = new Log();
    $modules = new Module();

    $system = new system_class();
    $system->GetSettings();
    $system->GetMenu();

    require_once("./inc/php/class/functions_help.php");

}

?>