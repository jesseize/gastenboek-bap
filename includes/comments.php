<?php

class comments extends DB {

  function addComment($message) {
    parent::_query("INSERT INTO comments (comment) VALUES (:comment)",array(":comment" => $message));
  }

  function checkProfanity($message) {
    $words = array("kut","klootzak","flikker","nazi","heil","fuck","fock","fack");
    $matches = array();
    $badWords = preg_match_all("/\b(" . implode($words,"|") . ")\b/i", $message, $matches);
    if($badWords) {
      return false;
    } else {
      return true;
    }
  }

  function getComments() {
    return parent::_queryAll("SELECT * FROM comments ORDER BY id desc");
  }

}

?>
