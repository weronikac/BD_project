<?php
 
namespace user ;
use PDO ;
 
class Model 
{  
   /**
    * zmienne do połączenia z bazą
    */
   static $dsn = 'pgsql:host=localhost; port=5432; dbname=u8ciurej; user=u8ciurej; password=8ciurej'  ;
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
    * funkcja rejestrująca uzytkownika
    * sprawdza czy email użytkownika jest już bazie, jeśli tak zwraca false
    * w przeciwnym wypadku wysyła zapytanie do bazy aby dodac użytkownika
    */
   public function saveReg($obj) {
      $this->sth = self::$db->prepare('SELECT * FROM projekt.właściciele') ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      $isinbase = false;
      if ($result) { 
         foreach ( $result as $row ) { 
            if($row['email'] == $obj->email)
               $isinbase = true;
         }  
      }
      if($isinbase == false) { 
            $this->sth = self::$db->prepare('INSERT INTO projekt.właściciele(imię, nazwisko, email, hasło, nr_tel) VALUES (:imie, :nazwisko, :email, :haslo, :nr_tel) ') ;
            $this->sth->bindValue(':imie',$obj->imie,PDO::PARAM_STR) ; 
            $this->sth->bindValue(':nazwisko',$obj->nazwisko,PDO::PARAM_STR) ; 
            $this->sth->bindValue(':email',$obj->email,PDO::PARAM_STR) ; 
            $this->sth->bindValue(':haslo',$obj->haslo,PDO::PARAM_STR) ; 
            $this->sth->bindValue(':nr_tel',$obj->nr_tel,PDO::PARAM_STR) ; 
            $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;     
      }
      
      return ($isinbase) ? false : $resp ; 
   }

   /**
    * funkcja sprawdzająca czy email i hasło się zgadzają
    * jeśli dane są zgodne ustawia zmienne sesyjne
    */
   public function isRegister($obj) {
      $em = $obj->email;
      $ha = $obj->haslo;
      $this->sth = self::$db->prepare('SELECT * FROM projekt.właściciele') ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      $resp = false;
      if ($result) { 
         foreach ( $result as $row ) { 
            if($row['email'] == $em && $row['hasło'] == $ha){
               $resp = true;
               $_SESSION['id'] = $row['id_właściciel'] ;
               $_SESSION['imie'] = $row['imię'] ;
               $_SESSION['email'] = $row['email'] ;
               $_SESSION['nazwisko'] = $row['nazwisko'] ;
               $_SESSION['haslo'] = $row['hasło'] ;
               $_SESSION['nr_tel'] = $row['nr_tel'] ;
            }
         }
      }
      return $resp;
   }

   /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca wynik funkcji SQL moje_dane(varchar, varchar), czyli dane użytkownika
    */
   public function showprofile() {
      $email = $_SESSION['email'] ;
      $haslo = $_SESSION['haslo'] ;
      $sql = "SELECT * FROM projekt.moje_dane('$email','$haslo') ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
    }

    /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca dane z tabel projekt.wizyta i projekt.rodzaj
    */
    public function showvisits() {
      $sql = "SELECT * FROM projekt.wizyta JOIN projekt.rodzaj on projekt.rodzaj.id_wizyta = projekt.wizyta.id_wizyta ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
    }

    /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca dane z widoku projekt.wets
    */
    public function showwets() {
      $sql = "SELECT * FROM projekt.wets ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
    }

    /**
    * funkcja dodająca wizytę 
    * sprawdza czy data jest już zajęta, jeśli tak zwraca false
    * w przeciwnym wypadku wysyła zapytanie do bazy aby dodac wizytę
    */
    public function saveVisitUser($obj){
      $this->sth = self::$db->prepare('SELECT * FROM projekt.zwierzę_wizyta') ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      $isinbase = false;
      if ($result) { 
         foreach ( $result as $row ) { 
            if($row['data'] == $obj->data)
               $isinbase = true;
         }  
      }
      if($isinbase == false) {   
         $id_w = $_SESSION['id'] ;  
         $sql = "SELECT * FROM projekt.dodaj_wizyte_wlasc(:imie,:nazwisko,:id_budynek,:numer_gabinetu,:nazwa,:data,'$id_w',:dolegliwosci)";
         $this->sth = self::$db->prepare($sql) ;
         $this->sth->bindValue(':imie',$obj->imie,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':nazwisko',$obj->nazwisko,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':id_budynek',$obj->id_budynek,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':numer_gabinetu',$obj->numer_gabinetu,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':nazwa',$obj->nazwa,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':data',$obj->data,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':dolegliwosci',$obj->dolegliwosci,PDO::PARAM_STR) ; 
         $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;
      }
      return ($isinbase) ? false : $resp ; 
   }

   /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca dane z widoku projekt.moje_wizyty, w których zgadza się id właściciela 
    * sortuje według daty
    */
   public function myvisits() {
      $id_w = $_SESSION['id'] ;  
      $sql = "SELECT DISTINCT * FROM projekt.moje_wizyty WHERE id_właściciel ='$id_w' ORDER BY data";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
    }

    
}
 
?>