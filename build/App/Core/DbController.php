<?php

namespace MvcTemplate\App\Core;

use mysqli;

abstract class DbController {
  /** @var mysqli */
  private static $conn = null;

  /**
   * Connect to the database
   * @param $hostname
   * @param $username
   * @param $password
   * @param $database
   */
  public static function connect($hostname, $username, $password, $database) {
    if(!self::$conn) {
      self::$conn = new mysqli($hostname, $username, $password, $database);
      if (self::$conn->connect_error) {
        die("Connection to database failed:: " . self::$conn->connect_error);
      }
    }
  }

  public function __destruct() {
    self::$conn->close();
  }

  /**
   * Run a query on the database
   * @param $query
   * @param null $bindDataTypes
   * @param null $bindDataParams
   * @return array
   */
  public static function runQuery($query, $bindDataTypes = null, $bindDataParams = null) {
    $stmt = self::$conn->prepare($query);
    if($bindDataTypes && $bindDataParams) {
      $params = array();
      $params[] = $bindDataTypes;
      for($i = 0; $i < sizeof($bindDataParams); $i++) {
        $params[] = $bindDataParams[$i];
      }
      call_user_func_array(array($stmt, 'bind_param'), self::refValues($params));
    }
    $stmt->execute();
    $result = [
      "insert_id" => $stmt->insert_id,
      "results" => $stmt->get_result()
    ];
    $stmt->close();
    return $result;
  }

  public static function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
      $refs = array();
      foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
      return $refs;
    }
    return $arr;
  }
}