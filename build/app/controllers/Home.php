<?php
namespace App\Controllers;

use App\Core\Controller;

/**
 * The home controller
 */
class Home extends Controller {
  public function __construct() {}

  public function Index () {
    $this->view('home/index');
  }
}