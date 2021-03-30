<?php
 
namespace zwierze ;
use PDO ;
 
class Model 
{  
    /**
    * zmienne do połączenia z bazą
    */
    static $dsn = 'pgsql:host=localhost;port=5432; dbname=u8ciurej; user=u8ciurej; password=8ciurej'  ;
    protected static $db ;
    private $sth ;
 
    /**
     * konstruktor klasy Model, połączenie z bazą
     */
    function __construct() { 
      self::$db = new PDO ( self::$dsn ) ;
      self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ; 
    }
    
    /**
     * funkcja wykonująca zapytanie do bazy
     * zwraca wynik funkcji SQL moje_zwierzęta(int)
     */
    public function show() {
      $id_w = $_SESSION['id'] ;
      $sql = "SELECT * FROM projekt.moje_zwierzęta('$id_w') ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
    }

    /**
     * funkcja wykonująca zapytanie do bazy
     * zwraca liczbę wierszy wyniku funkcji SQL moje_zwierzęta(int)
     */
    public function countz() {
      $id_w = $_SESSION['id'] ;
      $sql = "SELECT count(*) as count FROM projekt.moje_zwierzęta('$id_w') ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      if ($result) { 
        foreach ( $result as $row ) { 
          return "Liczba twoich zwierząt to : ".$row['count'] ;
      }}
    }

    /**
     * funkcja wykonująca zapytanie do bazy
     * zwraca wynik funkcji SQL dodaj_zwierzę(varchar, varchar, varchar, varchar, int)
     */
    public function saveAnimal($obj){
      $id_w = $_SESSION['id'] ;
      $sql = "SELECT projekt.dodaj_zwierzę(:imie,:gatunek,:rasa,:wielkosc,'$id_w') ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->bindValue(':imie',$obj->imie,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':gatunek',$obj->gatunek,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':rasa',$obj->rasa,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':wielkosc',$obj->wielkosc,PDO::PARAM_STR) ; 
      $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;
      return $resp ; 
    }
 
}
 
?>