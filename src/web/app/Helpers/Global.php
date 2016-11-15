<?php
function url($link, $name = null) {
  $name = is_null($name) ? $link : $name;
  return '<a href="'.$link.'">'.$name.'</a>';
}
