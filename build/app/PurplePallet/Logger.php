<?php
namespace PurplePallet;

class Logger {
  private $now;
  private $logFilename;
  private $logLocation;

  public $DEFAULT;
  public $ERROR;
  public $WARNING;
  public $INFO;

  function __construct() {
    $this->now = (new \DateTime())->format('Y-m-d');
    $this->logFilename = "log_".$this->now.".log";
    $this->logLocation = "/var/log/PurplePallet/";

    $this->DEFAULT  = "DEFAULT";
    $this->ERROR    = "ERROR";
    $this->WARNING  = "WARNING";
    $this->INFO     = "INFO";
  }

  public function log($logCategory, $logMsg) {
    $msg = (new \DateTime())->format('Y-m-d H:i:s.u')." ".$logCategory." ~ ".$logMsg."\r\n";
    file_put_contents($this->logLocation.$this->logFilename, $msg, FILE_APPEND | LOCK_EX);
  }

  public function setLogLocation($logLocation) {
    $this->logLocation = $logLocation;
  }

  public function setLogFilename($logFilename) {
    $this->logFilename = $logFilename."_".$this->now.".log";
  }

  public function resetLogLocation() {
    $this->logLocation = "/var/log/PurplePallet/";
  }

  public function resetLogFilename() {
    $this->logFilename = "log_".$this->now.".log";
  }
}