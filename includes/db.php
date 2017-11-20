<?php
  class DB {
    var $db;
    function __construct() {
      try {
          $this->db = new PDO("mysql:host=localhost;dbname=gastenboek", 'root', 'mysql');
          // set the PDO error mode to exception
          $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
      catch(PDOException $e)
          {
            var_dump($e);
            print 'Too many users on site.';
            die();
          }

    }

    function _query($sql,$vars = "") {
      $query = $this->db->prepare($sql);
      if($vars != "") {
        $query->execute($vars);
      } else {
        $query->execute();
      }
      if (strpos($sql, 'INSERT') !== false || strpos($sql, 'UPDATE') !== false) {

      } else {
        return $query->fetch(PDO::FETCH_ASSOC);
      }
    }

    function _queryAll($sql,$vars = "") {
      $query = $this->db->prepare($sql);
      if($vars != "") {
        $query->execute($vars);
      } else {
        $query->execute();
      }
      if (strpos($sql, 'INSERT') !== false || strpos($sql, 'UPDATE') !== false) {

      } else {
        return $query->fetchAll(PDO::FETCH_ASSOC);
      }
    }

  }
?>
