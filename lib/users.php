<?php

namespace lib;

class Users {
  
  public static function connected() {

    $result = array();

    $dataRaw = shell_exec("who -u");
    $dataRawDNS = shell_exec("who --lookup");

    foreach (explode ("\n", $dataRawDNS) as $line) {
      $line = preg_replace("/ +/", " ", $line);

      if (strlen($line)>0) {
        $line = explode(" ", $line);
        $temp[] = $line[5];
      }
    }

    $i = 0;
    foreach (explode ("\n", $dataRaw) as $line) {
      $line = preg_replace("/\s\s+/", " ", $line);
      if (strlen($line)>0) {
        $line = explode(" ", $line);

        $result[] = array(
          'user' => $line[0],
          'ip' => str_replace(array("(",")"), "", $line[6]),
          'dns' => $temp[$i],
          'date' => $line[2],
          'hour' => $line[3]
          );
      }
      $i++;
    }

    return $result;
  }   

}

?>
