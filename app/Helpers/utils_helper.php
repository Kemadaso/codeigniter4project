<?php


if(!function_exists('do_password')) {
  function do_password ($str) {
    return md5($str);
  }
}

if(!function_exists('check_password')) {
  function check_password ($str, $hash) {
    if (md5($str) == $hash) {
      return true;
    } else {
      return false;
    }
  }
}

if(!function_exists('do_json')) {
  function do_json($arr) {
    if(is_array($arr)) {
      return json_encode($arr);
    } else {
      return json_encode([]);
    }
  }
}

if(!function_exists('do_object')) {
  function do_obj($arr) {
    if($obj = json_decode($arr)) {
      return $obj;
    } else {
      return null;
    }
  }
}

if(!function_exists('is_email')) {
  function is_email($str) {
    if(filter_var($str, FILTER_VALIDATE_EMAIL)) {
      return true;
    } else {
      return false;
    }
  }
}

function parse_querywhere($str = '') {
  # post_status='publish'post_title'%nueva%'
  
  $str = preg_replace('/([^a-z0-9_-s="%.,|])/im', "", $str);
  $str = preg_replace('/\|/i', " ", $str);
  $str = preg_replace('/,/i', " ", $str);
  $str = preg_replace('/"/i', "'", $str);
  
  return $str;

}

function slugify(string $text)
{
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, '-');

  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function parse_queryuri($str) {
  if(isset($str)) {
    return $str;
  } else {
    return null;
  }

}

