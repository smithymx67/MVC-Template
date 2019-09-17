<?php
namespace PurplePallet;

class TimeTraveller extends DateTime {
  public function __construct($timezone = 'UTC') {
    parent::__construct("now", new DateTimeZone($timezone));
  }

  public static function now($timezone = 'UTC') {
    return new TimeTraveller($timezone);
  }

  public static function parse($format, $date) {
    $dateObj = parent::createFromFormat($format, $date);
    return TimeTraveller::now()->setTimestamp($dateObj->format('U'));
  }

  public function format($format = 'Y/m/d H:i:s') {
    return parent::format($format);
  }

  public function diffInYears($date = null, $absolute = true) {
    return (int) parent::diff($date, $absolute)->format('%y');
  }

  public function diffInMonths($date = null, $absolute = true) {
    return (int) $this->diffInYears($date, $absolute) * 12 + parent::diff($date, $absolute)->format('%m');
  }

  public function diffInDays($date = null, $absolute = true) {
    return (int) parent::diff($date, $absolute)->format('%a');
  }

  public function diffInWeeks($date = null, $absolute = true) {
    return (int) floor($this->diffInDays($date, $absolute) / 7);
  }

  public function diffInSeconds($date = null, $absolute = true) {
    $diff = parent::diff($date, $absolute);
    $value = ((($diff->days * 24) + $diff->h) * 60 + $diff-> i) * 60 + $diff->s;
    return ($absolute || !$diff->invert) ? $value : -$value;
  }

  public function diffInMinutes($date = null, $absolute = true) {
    return (int) floor($this->diffInSeconds($date, $absolute) / 60);
  }

  public function diffInHours($date = null, $absolute = true) {
    return (int) floor($this->diffInSeconds($date, $absolute) / 60 / 60);
  }

  public function diffInMicroseconds($date = null, $absolute = true) {
    $diff = parent::diff($date, $absolute);
    $value = floor((((($diff->days * 24) + $diff->h) * 60 + $diff-> i) * 60 + ($diff->f + $diff->s)) * 1000000);
    return ($absolute || !$diff->invert) ? $value : -$value;
  }

  public function diffInMilliseconds($date = null, $absolute = true) {
    return ($this->diffInMicroseconds($date, $absolute) / 1000);
  }

  public function getShortYear() {
    return (int) $this->format('y');
  }

  public function getLongYear() {
    return (int) $this->format('Y');
  }

  public function isLeapYear() {
    return (bool) ($this->format('L')) ? true : false;
  }

  public function getMonthNumber() {
    return (int) $this->format('n');
  }

  public function getMonthShortName() {
    return (string) $this->format('M');
  }

  public function getMonthLongName() {
    return (string) $this->format('F');
  }

  public function getDaysInMonth() {
    return (int) $this->format('t');
  }

  public function getDayOfMonth() {
    return (int) $this->format('j');
  }

  public function getDayOfWeek() {
    return (int) $this->format('w');
  }

  public function getWeekShotText() {
    return (string) $this->format('D');
  }

  public function getWeekLongText() {
    return (string) $this->format('l');
  }

  public function getDateSuffix() {
    return (string) $this->format('S');
  }

  public function getDayOfYear() {
    return (int) $this->format('z');
  }

  public function getTimeAmPm($uppercase = false) {
    return (string) ($uppercase) ? $this->format('A') : $this->format('a');
  }

  public function getTime12Hour($leadZeros = false) {
    if($leadZeros) {
      return (string) $this->format('h');
    } else {
      return (int) $this->format('g');
    }
  }

  public function getTime24Hour($leadZeros = false) {
    if($leadZeros) {
      return (string) $this->format('H');
    } else {
      return (int) $this->format('G');
    }
  }

  public function getTimeMinute($leadZeros = false) {
    if($leadZeros) {
      return (string) $this->format('i');
    } else {
      return (int) $this->format('i');
    }
  }

  public function getTimeSecond($leadZeros = false) {
    if($leadZeros) {
      return (string) $this->format('s');
    } else {
      return (int) $this->format('s');
    }
  }

  public function getTimeMillisecond() {
    return (int) $this->format('v');
  }

  public function getTimeMicrosecond() {
    return (int) $this->format('u');
  }

  public function getTimezone() {
    return (string) $this->format('e');
  }

  public function isDaylightSaving() {
    return (bool) $this->format('I');
  }

  public function getGmtDifference($withColon = false) {
    return (string) ($withColon) ? $this->format('P') : $this->format('O');
  }

  public function getTimezoneAbbreviation() {
    return (string) $this->format('T');
  }

  public function getUtcOffsetInSeconds() {
    return (int) $this->format('Z');
  }

  public function getIso8601Date() {
    return (string) $this->format('c');
  }

  public function getRfc2822Date() {
    return (string) $this->format('r');
  }

  public function getSecondsSinceEpoch() {
    return (string) $this->format('U');
  }

  private function addDateTime($amountToAdd = '') {
    return parent::add(new DateInterval($amountToAdd));
  }

  public function addYears($yearsToAdd = 0) {
    return $this->addDateTime('P'.$yearsToAdd.'Y');
  }

  public function addMonths($monthsToAdd = 0) {
    return $this->addDateTime('P'.$monthsToAdd.'M');
  }

  public function addDays($daysToAdd = 0) {
    return $this->addDateTime('P'.$daysToAdd.'D');
  }

  public function addHours($hoursToAdd = 0) {
    return $this->addDateTime('PT'.$hoursToAdd.'H');
  }

  public function addMinutes($minutesToAdd = 0) {
    return $this->addDateTime('PT'.$minutesToAdd.'M');
  }

  public function addSeconds($secondsToAdd = 0) {
    return $this->addDateTime('PT'.$secondsToAdd.'S');
  }

  public function addWeeks($weeksToAdd = 0) {
    return $this->addDateTime('P'.$weeksToAdd.'W');
  }

  private function subDateTime($amountToSub = '') {
    return parent::sub(new DateInterval($amountToSub));
  }

  public function subYears($yearsToSub = 0) {
    return $this->subDateTime('P'.$yearsToSub.'Y');
  }

  public function subMonths($monthsToSub = 0) {
    return $this->subDateTime('P'.$monthsToSub.'M');
  }

  public function subDays($daysToSub = 0) {
    return $this->subDateTime('P'.$daysToSub.'D');
  }

  public function subHours($hoursToSub = 0) {
    return $this->subDateTime('PT'.$hoursToSub.'H');
  }

  public function subMinutes($minutesToSub = 0) {
    return $this->subDateTime('PT'.$minutesToSub.'M');
  }

  public function subSeconds($secondsToSub = 0) {
    return $this->subDateTime('PT'.$secondsToSub.'S');
  }

  public function subWeeks($weeksToSub = 0) {
    return $this->subDateTime('P'.$weeksToSub.'W');
  }

  public function startOfDay() {
    $date = $this->getDayOfMonth() . '/' . $this->getMonthNumber() . '/' . $this->getLongYear();
    return $this->parse('d/m/Y H:i:s', $date . ' 00:00:00');
  }

  public function endOfDay() {
    $date = $this->getDayOfMonth() . '/' . $this->getMonthNumber() . '/' . $this->getLongYear();
    return $this->parse('d/m/Y H:i:s', $date . ' 23:59:59');
  }

  public function startOfMonth() {
    $date = '1/' . $this->getMonthNumber() . '/' . $this->getLongYear();
    return $this->parse('d/m/Y H:i:s', $date . ' 00:00:00');
  }

  public function endOfMonth() {
    $date = $this->getDaysInMonth() . '/' . $this->getMonthNumber() . '/' . $this->getLongYear();
    return $this->parse('d/m/Y H:i:s', $date . ' 23:59:59');
  }

  public function startOfYear() {
    $date = '1/1/' . $this->getLongYear();
    return $this->parse('d/m/Y H:i:s', $date . ' 00:00:00');
  }

  public function endOfYear() {
    $date = '31/12/' . $this->getLongYear();
    return $this->parse('d/m/Y H:i:s', $date . ' 23:59:59');
  }

  public function startOfWeek() {
    return $this->subDays($this->getDayOfWeek())->startOfDay();
  }

  public function endOfWeek() {
    $daysTillEndOfWeek = 6 - $this->getDayOfWeek();
    return $this->addDays($daysTillEndOfWeek)->endOfDay();
  }
}

echo "Default Example<br>";
var_dump(new TimeTraveller());
echo "<br>";
var_dump(TimeTraveller::now());

echo "<br>";
echo "<br>Timezone Example<br>";
var_dump(new TimeTraveller("Europe/Rome"));
echo "<br>";
var_dump(TimeTraveller::now("Europe/Rome"));

echo "<br>";
echo "<br>Parse Example</br>";
var_dump(TimeTraveller::parse("d/m/Y H:i:s", "19/10/2016 14:48:21"));

echo "<br>";
echo "<br>Format Example</br>";
var_dump(TimeTraveller::now()->format());

echo "<br>";
echo "<br>Difference Example</br>";
$d1 = TimeTraveller::parse("d/m/Y H:i:s", "1/12/2018 00:00:00");
$d2 = TimeTraveller::parse("d/m/Y H:i:s", "34/12/2018 00:00:30");
var_dump($d1->diffInYears($d2));
echo "<br>";
var_dump($d1->diffInMonths($d2));
echo "<br>";
var_dump($d1->diffInDays($d2));
echo "<br>";
var_dump($d1->diffInWeeks($d2));
echo "<br>";
var_dump($d1->diffInSeconds($d2));
echo "<br>";
var_dump($d1->diffInMinutes($d2));
echo "<br>";
var_dump($d1->diffInHours($d2));
echo "<br>";
var_dump($d1->diffInMicroseconds($d2));
echo "<br>";
var_dump($d1->diffInMilliseconds($d2));

echo "<br>";
echo "<br>Get Date Examples</br>";
var_dump(TimeTraveller::now()->getShortYear());
echo "<br>";
var_dump(TimeTraveller::now()->getLongYear());
echo "<br>";
var_dump(TimeTraveller::now()->isLeapYear());
echo "<br>";
var_dump(TimeTraveller::now()->getMonthNumber());
echo "<br>";
var_dump(TimeTraveller::now()->getMonthShortName());
echo "<br>";
var_dump(TimeTraveller::now()->getMonthLongName());
echo "<br>";
var_dump(TimeTraveller::now()->getDaysInMonth());
echo "<br>";
var_dump(TimeTraveller::now()->getDayOfMonth());
echo "<br>";
var_dump(TimeTraveller::now()->getDayOfWeek());
echo "<br>";
var_dump(TimeTraveller::now()->getWeekShotText());
echo "<br>";
var_dump(TimeTraveller::now()->getWeekLongText());
echo "<br>";
var_dump(TimeTraveller::now()->getDateSuffix());
echo "<br>";
var_dump(TimeTraveller::now()->getDayOfYear());

echo "<br>";
echo "<br>Get Time Examples</br>";
var_dump(TimeTraveller::now()->getTimeAmPm());
echo "<br>";
var_dump(TimeTraveller::now()->getTimeAmPm(true));
echo "<br>";
var_dump(TimeTraveller::now()->getTime12Hour());
echo "<br>";
var_dump(TimeTraveller::now()->getTime24Hour());
echo "<br>";
var_dump(TimeTraveller::now()->getTime12Hour(true));
echo "<br>";
var_dump(TimeTraveller::now()->getTime24Hour(true));
echo "<br>";
var_dump(TimeTraveller::now()->getTimeMinute());
echo "<br>";
var_dump(TimeTraveller::now()->getTimeSecond());
echo "<br>";
var_dump(TimeTraveller::now()->getTimeMinute(true));
echo "<br>";
var_dump(TimeTraveller::now()->getTimeSecond(true));
echo "<br>";
var_dump(TimeTraveller::now()->getTimeMillisecond());
echo "<br>";
var_dump(TimeTraveller::now()->getTimeMicrosecond());

echo "<br>";
echo "<br>Get Timezone Examples</br>";
var_dump(TimeTraveller::now()->getTimezone());
echo "<br>";
var_dump(TimeTraveller::now()->isDaylightSaving());
echo "<br>";
var_dump(TimeTraveller::now()->getGmtDifference());
echo "<br>";
var_dump(TimeTraveller::now()->getGmtDifference(true));
echo "<br>";
var_dump(TimeTraveller::now()->getTimezoneAbbreviation());
echo "<br>";
var_dump(TimeTraveller::now()->getUtcOffsetInSeconds());
echo "<br>";

echo "<br>";
echo "<br>Get Full Date Examples</br>";
var_dump(TimeTraveller::now()->getIso8601Date());
echo "<br>";
var_dump(TimeTraveller::now()->getRfc2822Date());
echo "<br>";
var_dump(TimeTraveller::now()->getSecondsSinceEpoch());

echo "<br>";
echo "<br>Add Date Time Examples</br>";
var_dump(TimeTraveller::now()->addYears(1));
echo "<br>";
var_dump(TimeTraveller::now()->addMonths(46));
echo "<br>";
var_dump(TimeTraveller::now()->addDays(562));
echo "<br>";
var_dump(TimeTraveller::now()->addHours(4));
echo "<br>";
var_dump(TimeTraveller::now()->addMinutes(186));
echo "<br>";
var_dump(TimeTraveller::now()->addSeconds(3000));
echo "<br>";
var_dump(TimeTraveller::now()->addWeeks(4));

echo "<br>";
echo "<br>Subtract Date Time Examples</br>";
var_dump(TimeTraveller::now()->subYears(1));
echo "<br>";
var_dump(TimeTraveller::now()->subMonths(46));
echo "<br>";
var_dump(TimeTraveller::now()->subDays(562));
echo "<br>";
var_dump(TimeTraveller::now()->subHours(4));
echo "<br>";
var_dump(TimeTraveller::now()->subMinutes(186));
echo "<br>";
var_dump(TimeTraveller::now()->subSeconds(3000));
echo "<br>";
var_dump(TimeTraveller::now()->subWeeks(4));

echo "<br>";
echo "<br>Start / End Examples</br>";
var_dump(TimeTraveller::now()->startOfDay());
echo "<br>";
var_dump(TimeTraveller::now()->endOfDay());
echo "<br>";
var_dump(TimeTraveller::now()->startOfMonth());
echo "<br>";
var_dump(TimeTraveller::now()->endOfMonth());
echo "<br>";
var_dump(TimeTraveller::now()->startOfYear());
echo "<br>";
var_dump(TimeTraveller::now()->endOfYear());
echo "<br>";
var_dump(TimeTraveller::now()->startOfWeek());
echo "<br>";
var_dump(TimeTraveller::now()->endOfWeek());
echo "<br>";
