<?php

use MvcTemplate\App\Core\DbController;

require_once 'secrets.php';
date_default_timezone_set("UTC");
session_start();

// Env tracking variables
const DEVELOPMENT = "dev";
const STAGING     = "staging";
const PRODUCTION  = "production";
$env = null;

// Decide the environment
switch($_SERVER['HTTP_HOST']) {
  case DEVELOPMENT_URL:   $env = DEVELOPMENT; break;
  case STAGING_URL:       $env = STAGING;     break;
  case PRODUCTION_URL:    $env = PRODUCTION;  break;
  default:                $env = null;
}
define("ENV", $env);

// Define the systems directory separator
define("DIR_SEP" , DIRECTORY_SEPARATOR);

// Decide on what protocol is being used and set root paths
$protocol             = (isset($_SERVER['HTTPS'])) ? "https://" : "http://";
$rootURL              = $protocol . $_SERVER['HTTP_HOST'];
$rootPublicDir        = $_SERVER['DOCUMENT_ROOT'] . DIR_SEP;
$rootAppDir           = dirname($_SERVER['DOCUMENT_ROOT']) . DIR_SEP . "App" . DIR_SEP;
$rootVendorsDir       = dirname($_SERVER['DOCUMENT_ROOT']) . DIR_SEP . "vendors" . DIR_SEP;

// Email Details
$emailHost              = PRODUCTION_EMAIL_HOST;
$emailUsername          = PRODUCTION_EMAIL_USERNAME;
$emailPassword          = PRODUCTION_EMAIL_PASSWORD;
$emailFromAddress       = PRODUCTION_EMAIL_FROM_ADDRESS;
$emailFromName          = PRODUCTION_EMAIL_FROM_NAME;
$emailContactToAddress  = PRODUCTION_EMAIL_CONTACT_TO_ADDRESS;

// Change links for dev setup
if ($env == DEVELOPMENT) {
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Update these vars to reflect dev setup
  $rootURL            .= '/MVC-Template/public_html';
  $rootPublicDir      .= "MVC-Template" . DIR_SEP . "public_html" . DIR_SEP;
  $rootAppDir         = $_SERVER['DOCUMENT_ROOT'] . DIR_SEP . "MVC-Template" . DIR_SEP . "App" . DIR_SEP;
  $rootVendorsDir     = $_SERVER['DOCUMENT_ROOT'] . DIR_SEP . "MVC-Template" . DIR_SEP . "vendors" . DIR_SEP;

  $emailHost              = DEVELOPMENT_EMAIL_HOST;
  $emailUsername          = DEVELOPMENT_EMAIL_USERNAME;
  $emailPassword          = DEVELOPMENT_EMAIL_PASSWORD;
  $emailFromAddress       = DEVELOPMENT_EMAIL_FROM_ADDRESS;
  $emailFromName          = DEVELOPMENT_EMAIL_FROM_NAME;
  $emailContactToAddress  = DEVELOPMENT_EMAIL_CONTACT_TO_ADDRESS;
}

if ($env == STAGING) {
  $emailHost              = STAGING_EMAIL_HOST;
  $emailUsername          = STAGING_EMAIL_USERNAME;
  $emailPassword          = STAGING_EMAIL_PASSWORD;
  $emailFromAddress       = STAGING_EMAIL_FROM_ADDRESS;
  $emailFromName          = STAGING_EMAIL_FROM_NAME;
  $emailContactToAddress  = STAGING_EMAIL_CONTACT_TO_ADDRESS;
}

// Define root paths
define("BASE_URL"         , $protocol . $_SERVER['HTTP_HOST']);
define("ROOT_URL"         , $rootURL);
define("ROOT_PUBLIC_DIR"  , $rootPublicDir);
define("ROOT_APP_DIR"     , $rootAppDir);

// Define Email variables
define("EMAIL_HOST", $emailHost);
define("EMAIL_USERNAME", $emailUsername);
define("EMAIL_PASSWORD", $emailPassword);
define("EMAIL_FROM_ADDRESS", $emailFromAddress);
define("EMAIL_FROM_NAME", $emailFromName);
define("EMAIL_CONTACT_TO_ADDRESS", $emailContactToAddress);

// Site variables
define("SITE_AUTHOR",   "Sam Smith");
define("SITE_LANGUAGE", "en-gb");
define("SITE_CHARSET",  "utf-8");
define("SITE_TITLE",    "MVC Template");
define("VERSION",       "v1.0.0");

// CSS File Links
define("CSS_MAIN_LIB",  $rootURL."/styles/vendor/bluePallet.min.css");
define("CSS_CUSTOM",    $rootURL."/styles/main.min.css");

// JS File Links
define("JS_MAIN_LIB",     $rootURL."/scripts/vendor/yellowPallet.min.js");
define("JS_CUSTOM_LIB",   $rootURL."/scripts/main.min.js");

// Setup database connection
if (!empty(DEVELOPMENT_DB_DATABASE)) {
  if ($env == DEVELOPMENT) {
    DbController::connect(
      DEVELOPMENT_DB_HOSTNAME,
      DEVELOPMENT_DB_USERNAME,
      DEVELOPMENT_DB_PASSWORD,
      DEVELOPMENT_DB_DATABASE
    );
  } elseif ($env == STAGING) {
    DbController::connect(
      STAGING_DB_HOSTNAME,
      STAGING_DB_USERNAME,
      STAGING_DB_PASSWORD,
      STAGING_DB_DATABASE
    );
  } elseif ($env == PRODUCTION) {
    DbController::connect(
      PRODUCTION_DB_HOSTNAME,
      PRODUCTION_DB_USERNAME,
      PRODUCTION_DB_PASSWORD,
      PRODUCTION_DB_DATABASE
    );
  }
}