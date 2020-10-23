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


/**
 * make uri valid to seo frendly
 *
 * @param  string $text
 * @return string
 */
function slugify(string $text): string
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


function getBody() {
  
  $request = \Config\Services::request();
  $input = (array) json_decode($request->getBody(), true);

  return $input;

}



function _noempty($str) {
  $str = (array) $str;
  
  if(count($str) > 0) {
    return true;
  }
  return false;

}



/**
 * array_map_recursive
 *
 * @param  mixed $f
 * @param  mixed $xs
 * @return void
 */
function array_map_recursive($f, $xs) {
  $out = [];
  foreach ($xs as $k => $x) {
      $out[$k] = (is_array($x)) ? array_map_recursive($f, $x) : $f($x);
  }
  return $out;
}



/**
 * recursive nested if the parent have term_child key
 *
 * @param  array $term_parents
 * @param  array $term_childs
 * @return void
 */
function recursive_term_child(array &$term_parents, array &$term_childs) {
  
    foreach($term_parents as $pk => $pterm) {

      if(_noempty($term_childs)) {
        
        foreach($term_childs as $ck => $cterm) {
        
          if($pterm['term_id'] == $cterm['term_parent']) {
            $term_parents[$pk]['term_child'][] = $cterm;
            unset($term_childs[$ck]);
          }
  
        }
  
        if(isset($term_parents[$pk]['term_child'])) {
          recursive_term_child($term_parents[$pk]['term_child'], $term_childs);
        }

      }
      
    }
  
}


/**
 * return array nested term according to term_parent
 *
 * @param  array $terms
 * @param  int $depth optional parameter
 * @return array
 */
function filter_term_nested(array $terms, $depth = 3):?array
{
  $parent = $child = [];
  foreach($terms as $key => $value) {
    if(_noempty($value['term_parent'])) {
      $child[] = $value;
    } else {
      $parent[] = $value;
    }
  }

  recursive_term_child($parent, $child);

  return $parent;
  
}


