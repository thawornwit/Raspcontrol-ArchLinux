<?php

namespace lib;

class Network {
  
  public static function connections() {

    $connections = shell_exec("netstat -nta --inet | wc -l");
    $connections--;

    return array(
      'connections' => substr($connections, 0, -1),
      'alert' => ($connections >= 50 ? 'warning' : 'success')
      );
  }

  public static function ethernet() {

  $rxData = shell_exec("/sbin/ifconfig eth0 | grep RX\ packets");
  $rxData = trim($rxData);
  $rxData = explode(" ", $rxData);      
  $rxRaw = $rxData[5] / 1024 / 1024;
  $rx = round($rxRaw, 2);
  
  $txData = shell_exec("/sbin/ifconfig eth0 | grep TX\ packets");
  $txData = trim($txData);
  $txData = explode(" ", $txData);
  $txRaw = $txData[5] / 1024 / 1024;
  $tx = round($txRaw, 2);
  
  return array(
    'up' => $tx,
    'down' => $rx,
    'total' => $rx + $tx
    );
  }

}
