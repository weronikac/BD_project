<?php
 
namespace info ;
use PDO ;
 
class Model 
{
 
   static $dsn = 'pgsql:host=localhost;port=5432; dbname=u8ciurej; user=u8ciurej; password=8ciurej'  ;
   protected static $db ;
   private $sth ;

   function __construct() { 
     self::$db = new PDO ( self::$dsn ) ;
     self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ; 
   }

   function update(){
      $sql = "SELECT * FROM projekt.updatestats() ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
   }

   function showStats(){
      $sql = "SELECT * FROM projekt.statystyki ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
   }

 
}
 
?>