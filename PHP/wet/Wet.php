<?php
 
namespace wet   ;
 
use appl\ { View, Controller } ;
// use appl\Controller ;
 
class Wet extends Controller 
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
      $this->layout->title  = 'Panel weterynarza' ;
      $this->layout->menu = $this->menu ;
      $this->model  = new Model() ;
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function add() {
      $this->layout->header = '' ;
      $this->view = new View('addwet') ;
      $this->layout->content = $this->view ;
      return $this->layout ;
   }


   /**
     * funkcja rejestrująca weterynarza do bazy
     * wywołuje funkcję saveWet($obj) z klasy Model
     * zwraca odpowiedź czy udało się dodać weterynarza do bazy
    */
   function saveWet() {
      $datawet = $_POST['datawet'] ;
      $obj  = json_decode($datawet) ;
      if (isset($obj->imie) and isset($obj->nazwisko) and isset($obj->email) and isset($obj->haslo)) {     
         $response = $this->model->saveWet($obj) ;
      }
      // last error tutaj rozdzielić dwukropkami
      return ( $response ? "Dodano weterynarza"."<br><p><a href='index.php?sub=Wet&action=login'>Zaloguj się</a></p>" : "Weterynarz o podanym emailu jest już dodany"."<br><p><a href='index.php?sub=Wet&action=register'>Spróbuj ponownie</a></p>" ) ;
   }


   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function log_forWet() {
      $this->layout->header = '' ;
      $this->view = new View('panelwet') ;
      $this->layout->content = $this->view ;
      return $this->layout ;
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function login() {
      $this->layout->header = '' ;
      $this->view = new View('wetlogin') ;
      $this->layout->content = $this->view ;
      return $this->layout ;
   }


   /**
     * funkcja sprawdza czy weterynarz jest zarejestrowany
     * wywołuje funkcję isRegister($obj) z klasy Model
    */
   function isRegister() {
      $dataw = $_POST['dataw'] ;
      $obj  = json_decode($dataw) ;
      if ( isset($obj->email) and isset($obj->haslo)) {      
         $response = $this->model->isRegister($obj) ;  
      }    
      if($response){
         $_SESSION['auth'] = 'WET' ;
         $_SESSION['user'] = $email ;
      }
      return ( $response ? "Zalogowano weterynarza"."<br><p><a href='index.php'>Powrot do strony glownej</a></p>" : "Zły email lub hasło"."<br><p><a href='index.php?sub=Wet&action=login'>Spróbuj ponownie</a></p>" ) ;
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję showprofile() z klasy Model
    */
   function showprofile(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('wetprofile') ;
         $this->view->data = $this->model->showprofile() ;
         $this->layout->content = $this->view ; 
         return $this->layout ; 
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function addclinic(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('addclinic') ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję showclinics() z klasy Model
    */
   function addoffice(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('addoff') ;
         $this->view->data = $this->model->showclinics() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja slużaca do dodania budynku
     * wywołuje funkcję saveClinic($obj) z klasy Model
     * zwraca odpowiedź czy udało się dodać budynek
    */
   function saveClinic() {
      if($_SESSION['auth'] == 'WET'){
         $datac = $_POST['datac'] ;
         $obj  = json_decode($datac) ;
         if ( isset($obj->miasto) and isset($obj->ulica) and isset($obj->numer_budynku)) {     
            $response = $this->model->saveClinic($obj) ;
         }
         return ( $response ? "Dodano klinikę"."<br><p><a href='index.php?sub=Wet&action=addclinic'>Odśwież</a></p>" : "Nie udało się dodać zwierzęcia"."<br><p><a href='index.php?sub=Wet&action=addclinic'>Spróbuj ponownie</a></p>" ) ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja slużaca do dodania gabinetu
     * wywołuje funkcję saveOffice($obj) z klasy Model
     * zwraca odpowiedź czy udało się dodać gabinet
    */
   function saveOffice() {
      if($_SESSION['auth'] == 'WET'){
         $dataof = $_POST['dataof'] ;
         $obj  = json_decode($dataof) ;
         if ( isset($obj->id_budynku) and isset($obj->numer_gabinetu)) {    
            $response = $this->model->saveOffice($obj) ;
         }
         return ( $response ? "Dodano gabinet"."<br><p><a href='index.php?sub=Wet&action=addoffice'>Odśwież</a></p>" : "Taki gabinet już istnieje"."<br><p><a href='index.php?sub=Wet&action=addoffice'>Spróbuj ponownie</a></p>" ) ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję showvisits() z klasy Model
    */
   function addvisit(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('addvisitwet') ;
         $this->view->data = $this->model->showvisits() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję myvisits z klasy Model
     */
    function myvisits(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('myvisitsvet') ;
         $this->view->data = $this->model->myvisits() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja slużaca do dodania wizyty
     * wywołuje funkcję saveVisitUser($obj) z klasy Model
     * zwraca odpowiedź czy udało się dodać wizytę
    */
   function saveVisit() {
      if($_SESSION['auth'] == 'WET'){
         $datavis = $_POST['datavis'] ;
         $obj  = json_decode($datavis) ;
         if ( isset($obj->nazwa) and isset($obj->cena)) {    
            $response = $this->model->saveVisit($obj) ;
         }
         return ( $response ? "Dodano wizytę"."<br><p><a href='index.php?sub=Wet&action=addvisit'>Odśwież</a></p>" : "Taka wizyta już istnieje"."<br><p><a href='index.php?sub=Wet&action=addvisit'>Spróbuj ponownie</a></p>" ) ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function addvaccine(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('addvaccine') ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }
      
   /**
     * funkcja slużaca do dodania szczepienia dla zwierzęcia
     * wywołuje funkcję saveVisitUser($obj) z klasy Model
     * zwraca odpowiedź czy udało się dodac szczepienie
    */
   function saveVaccine() {
      if($_SESSION['auth'] == 'WET'){
         $datavacc = $_POST['datavacc'] ;
         $obj  = json_decode($datavacc) ;
         if (isset($obj->imie) and isset($obj->nazwisko) and isset($obj->nazwa) and isset($obj->data)) {
            $response = $this->model->saveVaccine($obj) ;
         }
         return ( $response ? "Dodano szczepienie"."<br><p><a href='index.php?sub=Wet&action=addvaccine'>Odśwież</a></p>" : "Nie udało się dodać szczepienia"."<br><p><a href='index.php?sub=Wet&action=addvaccine'>Spróbuj ponownie</a></p>" ) ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
    */
   function animals(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('animals') ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję showallanimals() z klasy Model
    */
   function allanimals(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('allanimals') ;
         $this->view->data = $this->model->showallanimals() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję myanimals() z klasy Model
    */
   function myanimals(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('myanimals') ;
         $this->view->data = $this->model->myanimals() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
         return $this->layout ;
      }
   }

   /**
     * funkcja przesyłająca nazwe szablonu
     * wywołuje funkcję vaccines() z klasy Model
    */
   function vaccines(){
      if($_SESSION['auth'] == 'WET'){
         $this->layout->header = '' ;
         $this->view = new View('vaccines') ;
         $this->view->data = $this->model->vaccines() ;
         $this->layout->content = $this->view ;
         return $this->layout ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako weterynarz' ; 
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