<?php

namespace App\Controllers;

use App\Core\Controller;
/**
 * The error controller.
 */
class Errors extends Controller {
  // Route to /errors/index
  public function Index() {
    $this->view('errors/index');
  }

  // Route to /errors/404
  public function PageNotFound () {
    header("HTTP/1.0 404 Not Found");
    $this->view('errors/404');
  }

  // Route to /errors/403
  public function ForbiddenAccess () {
    header("HTTP/1.0 403 Forbidden");
    $this->view('errors/403');
  }

  // Route to /errors/500
  public function InternalServerError () {
    header("HTTP/1.0 500 Internal Server Error");
    $this->view('errors/500');
  }
}