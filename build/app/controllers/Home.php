<?php
namespace MvcTemplate\App\Controllers;

use MvcTemplate\App\Core\Controller;

/**
 * The home controller
 */
class Home extends Controller {
  public $data;

  public function __construct() {
    $this->data = [];
  }

  public function Index () {
    $this->view('home/index', $this->data);
  }
}