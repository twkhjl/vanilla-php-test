<?php

/* 
https://leetcode.com/problems/valid-parentheses/

Given a string s containing just the characters '(', ')', '{', '}', '[' and ']', determine if the input string is valid.

An input string is valid if:

Open brackets must be closed by the same type of brackets.
Open brackets must be closed in the correct order.
Every close bracket has a corresponding open bracket of the same type.

*/

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
// $str = "(]";   
// $str="()[]{}";
// $str = "[[[]";
$str = "([)]";
echo isValid($str);
