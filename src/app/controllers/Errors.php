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
    http_response_code(404);
    $this->view('errors/404');
  }

  // Route to /errors/403
  public function ForbiddenAccess () {
    http_response_code(403);
    $this->view('errors/403');
  }

  // Route to /errors/500
  public function InternalServerError () {
    http_response_code(500);
    $this->view('errors/500');
  }
}