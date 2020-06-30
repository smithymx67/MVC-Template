<?php
namespace MvcTemplate\App\Core;

/**
 * Super class for all controllers
 */
abstract class Controller {
  // Fetch and return new model
  public function model($model) {
    require_once ROOT_APP_DIR . 'models/' . $model . '.php';
    return new $model();
  }

  // Fetch a view
  public function view($view, $data = []) {
    $this->setHeaders();
    require_once ROOT_APP_DIR . 'views/' . $view . '.php';
  }

  // Api output
  public function viewApi($data) {
    $this->setHeaders();
    header('Content-Type: application/json');
    echo json_encode($data);
    return true;
  }

  private function setHeaders() {
    // https://scotthelme.co.uk/hsts-the-missing-link-in-tls/
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');

    // https://scotthelme.co.uk/content-security-policy-an-introduction/
    if(ENV == DEVELOPMENT)      { $url = DEVELOPMENT_URL; }
    elseif (ENV == STAGING)     { $url = STAGING_URL; }
    elseif (ENV == PRODUCTION)  { $url = PRODUCTION_URL; }
    $contentSecPolicy = "default-src $url 'unsafe-inline'; ";
    $contentSecPolicy .= "script-src $url https://kit.fontawesome.com https://www.google.com https://www.gstatic.com 'unsafe-inline'; ";
    $contentSecPolicy .= "img-src 'self' data:; ";
    $contentSecPolicy .= "frame-src https://www.google.com; ";
    $contentSecPolicy .= "style-src $url https://kit-free.fontawesome.com 'unsafe-inline'; ";
    $contentSecPolicy .= "font-src https://kit-free.fontawesome.com; ";
    header("Content-Security-Policy: $contentSecPolicy");

    // https://scotthelme.co.uk/hardening-your-http-response-headers/#x-frame-options
    header('X-Frame-Options: DENY');

    // https://scotthelme.co.uk/hardening-your-http-response-headers/#x-content-type-options
    header('X-Content-Type-Options: nosniff');

    // https://scotthelme.co.uk/a-new-security-header-referrer-policy/
    header('Referrer-Policy: strict-origin');

    // https://scotthelme.co.uk/a-new-security-header-feature-policy/
    header("Feature-Policy: fullscreen 'self'");
  }
}