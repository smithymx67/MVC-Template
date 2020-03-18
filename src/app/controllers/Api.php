<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * The api controller
 */
class Api extends Controller {
  public $data;

  public function __construct() {
    $this->data = [];
  }

  /**
   * ###############################
   * Index method
   * Routes to /api/index
   * ###############################
   */
  public function Index() {
    $this->viewApi(array('error' => 'unauthorized access'));
  }

  /**
   * ###############################
   * Api Version 1 method
   * Routes to /api/v1
   * ###############################
   */
  public function V1() {
    return $this->viewApi(array('success' => 'This was a success'));
  }
}