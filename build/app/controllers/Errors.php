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
    $this->view('errors/404');
  }

  // Route to /errors/403
  public function ForbiddenAccess () {
    $this->view('errors/403');
  }

  // Route to /errors/500
  public function InternalServerError () {
    $this->view('errors/500');
  }
}