<?php
 
namespace wet ;
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
    * funkcja rejestrująca weterynarza
    * sprawdza czy email weterynarza jest już bazie, jeśli tak zwraca false
    * w przeciwnym wypadku wysyła zapytanie do bazy aby dodac weterynarza
    */
   public function saveWet($obj) {
      $this->sth = self::$db->prepare('SELECT * FROM projekt.weterynarze') ;
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
            $this->sth = self::$db->prepare('INSERT INTO projekt.weterynarze(imię, nazwisko, email, hasło) VALUES (:imie, :nazwisko, :email, :haslo) ') ;
            $this->sth->bindValue(':imie',$obj->imie,PDO::PARAM_STR) ; 
            $this->sth->bindValue(':nazwisko',$obj->nazwisko,PDO::PARAM_STR) ; 
            $this->sth->bindValue(':email',$obj->email,PDO::PARAM_STR) ; 
            $this->sth->bindValue(':haslo',$obj->haslo,PDO::PARAM_STR) ;  
            $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;     
      }
      
      return ($isinbase) ? false : $resp ; 
   }

   /**
    * funkcja sprawdzająca czy email i hasło się zgadzają
    * jeśli dane są zgodne ustawia zmienne sesyjne
    */
   public function isRegister($obj) {
      $this->sth = self::$db->prepare('SELECT * FROM projekt.weterynarze') ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      $resp = false;
      if ($result) { 
         foreach ( $result as $row ) { 
            if($row['email'] == $obj->email && $row['hasło'] == $obj->haslo){
               $resp = true;
               $_SESSION['id'] = $row['id_weterynarz'] ;
               $_SESSION['imie'] = $row['imię'] ;
               $_SESSION['email'] = $row['email'] ;
               $_SESSION['haslo'] = $row['hasło'] ;
               $_SESSION['nazwisko'] = $row['nazwisko'] ;
            }
         }
      }
      return $resp;
   }

   /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca wynik funkcji SQL moje_dane_wet(varchar, varchar), czyli dane weterynarza
    */
   public function showprofile() {
      $email = $_SESSION['email'] ;
      $haslo = $_SESSION['haslo'] ;
      $sql = "SELECT * FROM projekt.moje_dane_wet('$email','$haslo') ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
    }


    /**
    * funkcja wykonująca zapytanie do bazy
    * wstawia dane do tabeli budynki
    */
   public function saveClinic($obj){
      $sql = "INSERT INTO projekt.budynki(miasto, ulica, numer_budynku) VALUES (:miasto, :ulica, :numer_budynku)";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->bindValue(':miasto',$obj->miasto,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':ulica',$obj->ulica,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':numer_budynku',$obj->numer_budynku,PDO::PARAM_STR) ; 
      $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;
      return $resp ; 
   }

   /**
    * funkcja wykonująca zapytanie do bazy
    * wstawia dane do tabeli gabinety wcześniej sprawdzając czy dany numer gabinetu już istnieje w danym budynku
    */
   public function saveOffice($obj){
      $this->sth = self::$db->prepare('SELECT * FROM projekt.gabinety') ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      $isinbase = false;
      if ($result) { 
         foreach ( $result as $row ) { 
            if($row['numer_gabinetu'] == $obj->numer_gabinetu && $row['id_budynek'] == $obj->id_budynku)
               $isinbase = true;
         }  
      }
      if($isinbase == false) {     
         $id_w = $_SESSION['id'] ;
         $sql = "INSERT INTO projekt.gabinety(id_budynek, numer_gabinetu,id_weterynarz) VALUES (:id_budynku, :numer_gabinetu, '$id_w')";
         $this->sth = self::$db->prepare($sql) ;
         $this->sth->bindValue(':id_budynku',$obj->id_budynku,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':numer_gabinetu',$obj->numer_gabinetu,PDO::PARAM_STR) ; 
         $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;
      }
      return ($isinbase) ? false : $resp ; 
   }

   /**
    * funkcja wykonująca zapytanie do bazy
    * wywołuje funkcję dodaj_wizyte_wet(varchar,int) wcześniej sprawdzając czy dana nazwa wizyty już istnieje 
    */
   public function saveVisit($obj){
      $this->sth = self::$db->prepare('SELECT * FROM projekt.wizyta') ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      $isinbase = false;
      if ($result) { 
         foreach ( $result as $row ) { 
            if($row['nazwa'] == $obj->nazwa)
               $isinbase = true;
         }  
      }
      if($isinbase == false) {     
         $sql = "SELECT * FROM projekt.dodaj_wizyte_wet(:nazwa,:cena)";
         $this->sth = self::$db->prepare($sql) ;
         $this->sth->bindValue(':nazwa',$obj->nazwa,PDO::PARAM_STR) ; 
         $this->sth->bindValue(':cena',$obj->cena,PDO::PARAM_STR) ; 
         $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;
      }
      return ($isinbase) ? false : $resp ; 
   }

   public function myvisits() {
      $id_w = $_SESSION['id'] ;  
      $sql = "SELECT DISTINCT * FROM projekt.moje_wizyty_wet WHERE id_weterynarz ='$id_w' ORDER BY data";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
    }

   /**
    * funkcja wykonująca zapytanie do bazy
    * dodaje szczepienie dla zwierzęcia poprzez wywołanie funkcji SQL dodaj_szczepienie(varchar, varchar, varchar, timestamp)
    */
   public function saveVaccine($obj){
      $sql = "SELECT * FROM projekt.dodaj_szczepienie(:imie,:nazwisko,:nazwa,:data)";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->bindValue(':imie',$obj->imie,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':nazwisko',$obj->nazwisko,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':nazwa',$obj->nazwa,PDO::PARAM_STR) ; 
      $this->sth->bindValue(':data',$obj->data,PDO::PARAM_STR) ;
      $resp = ( $this->sth->execute() ? 'true' : 'false' ) ;
      return $resp ; 
   }

   /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca dane z tabeli budynki
    */
   public function showclinics() {
      $sql = "SELECT * FROM projekt.budynki ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
   }

    /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca dane z tabel wizyta i rodzaj
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
    * zwraca dane z widoku wszystkie_zwierzęta
    */
   public function showallanimals() {
      $sql = "SELECT DISTINCT * FROM projekt.wszystkie_zwierzęta ";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
   }
  
    /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca wynik funkcji moi_pacjenci(int) w według alfabetycznej kolejności imion zwierząt
    */
   public function myanimals() {
      $id_w = $_SESSION['id'] ;
      $sql = "SELECT DISTINCT * FROM projekt.moi_pacjenci('$id_w') ORDER BY imię";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
   }

   /**
    * funkcja wykonująca zapytanie do bazy
    * zwraca dane z widoku szczepienia_widok
    */
   public function vaccines() {
      $sql = "SELECT * FROM projekt.szczepienia_widok ORDER BY data";
      $this->sth = self::$db->prepare($sql) ;
      $this->sth->execute() ;
      $result = $this->sth->fetchAll() ;
      return $result ;
   }


}
 
?>