<?php
namespace App\Controllers;

use App\Core\Controller;

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