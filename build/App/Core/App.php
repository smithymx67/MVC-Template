<?php
namespace MvcTemplate\App\Core;

use MvcTemplate\App\Controllers\Errors;
use MvcTemplate\App\Controllers\Home;

/**
 * Runs the app and makes the magic happen
 */
class App {
  // Set home/index to be the default route
  protected $controller = 'Home';
  protected $method     = 'Index';
  protected $params     = [];

  /**
   * App Constructor
   */
  public function __construct() {
    // Prepare the URL
    $url = $this->parseUrl();

    // Controller
    if(isset($url[0])) {
      // Check to see if the given controller exists
      if(file_exists(ROOT_APP_DIR . 'Controllers/' . $this->standardize($url[0]) . '.php')) {
        $this->controller = $this->standardize($url[0]);
        unset($url[0]);

        // Require and create the controller
        require_once ROOT_APP_DIR . 'Controllers/' . $this->controller . '.php';
        $nsClass = "\\MvcTemplate\\\App\\Controllers\\$this->controller";
        $this->controller = new $nsClass;

        // Model
        if(isset($url[1])) {
          // Check to see if the passed method exists in the controller
          if(method_exists($this->controller, $this->standardize($url[1]))) {
            $this->method = $this->standardize($url[1]);
            unset($url[1]);
          } else {
            // Else show a 404 page not found error
            $this->pageNotFound();
          }
        } else {
          if(!method_exists($this->controller, 'Index')){
            $this->pageNotFound();
          }
        }
      } else {
        // Special case, if a controller can't be found check the Home controller for the method instead
        // this will allow us to code up a route to /about rather than /home/about :)
        $this->getDefaultController();
        if(method_exists($this->controller, $this->standardize($url[0]))){
          $this->method = $this->standardize($url[0]);
          unset($url[0]);
        } else {
          $this->pageNotFound();
        }
      }
    }

    if ($this->controller == 'Home') {
      $this->getDefaultController();
    }

    // Call the given method and pass any parameters
    $this->params = $url ? array_values($url) : [];
    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  // Set the default route
  private function getDefaultController() {
    require_once ROOT_APP_DIR . 'Controllers/Home.php';
    $this->controller = new Home();
    $this->method     = 'index';
  }

  // Set up route to 404 error page
  private function pageNotFound() {
    require_once ROOT_APP_DIR . 'Controllers/Errors.php';
    $this->controller = new Errors();
    $this->method     = 'PageNotFound';
  }

  // Standardize the input to uppercase the first letter only
  private function standardize($input) {
    $temp = strtolower($input);
    return ucfirst($temp);
  }

  // Convert the URL into an array
  private function parseUrl() {
    if(isset($_GET['url'])) {
      return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    } else {
      return false;
    }
  }
}