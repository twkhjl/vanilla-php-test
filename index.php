<?php



$a = 1;
$b = 2;
$c = $a + $b;



function isValid($s)
{

  $len = strlen($s);


  if ($len % 2 !== 0) return false;


  $arr = [
    "(" => ")",
    "[" => "]",
    "{" => "}"
  ];

  $arr_left_bracket = ["(", "[", "{"];

  $stack = [];

  for ($i = 0; $i < $len; $i++) {
    if (in_array($s[$i], $arr_left_bracket)) {
      $stack[] = $s[$i];
    } elseif ($arr[end($stack)] === $s[$i]) {

      array_pop($stack);
    } else {
      return false;
    }
  }
  if (count($stack) == 0) {
    return true;
  } else {
    return false;
  }
}

// $str="(){}}{";    
// $str="()[]{}";
// $str = "[[[]";
$str = "([)]";
echo isValid($str);
