<?php
 
namespace user   ;
 
use appl\ { View, Controller } ;
// use appl\Controller ;
 
class User extends Controller 
{
 
    protected $layout ;
    protected $model ;
 
   /**
     * konstruktor klasy User
     * przesyła nazwe szablonu i tytuł w szablonie main
    */
   function __construct() {
      parent::__construct();
      session_start() ;
      $this->layout = new View('main') ;
      $this->layout->css = $this->css ;
      $this->layout->title  = 'Panel użytkownika' ;
      $this->layout->menu = $this->menu ;
      $this->model  = new Model() ;
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function log_forUser() {
      $this->layout->header = '' ;
      $this->view = new View('paneluser') ;
      $this->layout->content = $this->view ;
      return $this->layout ;
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function register() {
      $this->layout->header = '' ;
      $this->view = new View('register') ;
      $this->layout->content = $this->view ;
      return $this->layout ;
  }

   /**
     * funkcja rejestrująca użytkownika do bazy
     * wywołuje funkcję saveReg($obj) z klasy Model
     * zwraca odpowiedź czy udało się dodać użytkownika do bazy
    */
   function saveReg() {
      $datar = $_POST['datar'] ;
      $obj  = json_decode($datar) ;
      if (isset($obj->imie) and isset($obj->nazwisko) and isset($obj->email) and isset($obj->haslo) and isset($obj->nr_tel)) {    
         $response = $this->model->saveReg($obj) ;
      }
      return ( $response ? "Zarejestrowano użytkownika"."<br><p><a href='index.php?sub=User&action=login'>Zaloguj się</a></p>" : "Użytkownik o podanym emailu jest już zarejestrowany"."<br><p><a href='index.php?sub=User&action=register'>Spróbuj ponownie</a></p>" ) ;
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function login() {
      $this->layout->header = '' ;
      $this->view = new View('login') ;
      $this->layout->content = $this->view ;
      return $this->layout ;
   }

   /**
     * funkcja sprawdza czy użytkownik jest zarejestrowany
     * wywołuje funkcję isRegister($obj) z klasy Model
     */
   function isRegister() {
      $datal = $_POST['datal'] ;
      $obj  = json_decode($datal) ;
      if ( isset($obj->email) and isset($obj->haslo)) {    
         $response = $this->model->isRegister($obj) ;  
      }    
      if($response){
         $_SESSION['auth'] = 'USER' ;
         $_SESSION['user'] = $email ;
      }
      return ( $response ? "Zalogowano użytkownika"."<br><p><a href='index.php'>Powrót do strony glownej</a></p>" : "Zły email lub hasło"."<br><p><a href='index.php?sub=User&action=login'>Spróbuj ponownie</a></p>" ) ;
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję showprofile() z klasy Model
     */
   function showprofile(){
      if($_SESSION['auth'] == 'USER'){
         $this->layout->header = '' ;
         $this->view = new View('userprofile') ;
         $this->view->data = $this->model->showprofile() ;
         $this->layout->content = $this->view ; 
         return $this->layout ; 
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }
   }
  
   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję showvisits() z klasy Model
     */
   function addvisit(){
      if($_SESSION['auth'] == 'USER'){
         $this->layout->header = '' ;
         $this->view = new View('addvisituser') ;
         $this->view->data = $this->model->showvisits() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     *  wywołuje funkcję showets() z klasy Model
     */
   function showwets(){
      if($_SESSION['auth'] == 'USER'){
         $this->layout->header = '' ;
         $this->view = new View('wets') ;
         $this->view->data = $this->model->showwets() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }
   }

    /**
     * funkcja slużaca do umówienia wizyty
     * wywołuje funkcję saveVisitUser($obj) z klasy Model
     * zwraca odpowiedź czy udało się umówić wizytę
     */
   function saveVisitUser() {
      if($_SESSION['auth'] == 'USER'){
         $datavu = $_POST['datavu'] ;
         $obj  = json_decode($datavu) ;
         if ( isset($obj->imie) and isset($obj->nazwisko) and isset($obj->id_budynek) and isset($obj->numer_gabinetu) and isset($obj->nazwa) and isset($obj->data)) {      
            $response = $this->model->saveVisitUser($obj) ;
         }
         return ( $response ? "Umówiono wizytę"."<br><p><a href='index.php?sub=User&action=addvisit'>Odśwież</a></p>" : "Nieprawidłowe dane"."<br><p><a href='index.php?sub=User&action=addvisit'>Spróbuj ponownie</a></p>" ) ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }
   }

    /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję myvisits z klasy Model
     */
   function myvisits(){
      if($_SESSION['auth'] == 'USER'){
         $this->layout->header = '' ;
         $this->view = new View('myvisits') ;
         $this->view->data = $this->model->myvisits() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }
   }

    function index ()  {
       return $this->layout ; 
    }
  
     /**
     * funkcja służaca do wylogowania się
     * usuwa zmienne sesyjne 
     */
    function logout(){
      unset($_SESSION); 
      session_destroy();
      header("Location: index.php");
      exit;
    }
 
} 
 
?>