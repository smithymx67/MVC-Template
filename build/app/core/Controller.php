<?php
namespace App\Core;

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
    require_once ROOT_APP_DIR . 'views/' . $view . '.php';
  }

  // Api output
  public function viewApi($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    return true;
  }
}