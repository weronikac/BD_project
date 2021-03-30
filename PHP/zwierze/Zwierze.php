<?php
 
namespace zwierze   ;
 
use appl\ { View, Controller } ;
// use appl\Controller ;
 
class Zwierze extends Controller 
{
 
   protected $layout ;
   protected $model ;
 
    /**
     * konstruktor klasy Zwierze
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
     * wywołuje funkcje countz() i show() z klasy Model
     */
   function show() {   
      if($_SESSION['auth'] == 'USER'){  
         $this->layout->header = $this->model->countz() ;
         $this->view = new View('listzw') ;
         $this->view->data = $this->model->show() ;
         $this->layout->content = $this->view ; 
         return $this->layout ; 
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }      
   }


    /**
     * funkcja przesyłająca nazwe szablonu 
     */
   function add() {
      if($_SESSION['auth'] == 'USER'){
         $this->layout->header = '' ;
         $this->view = new View('addanimal') ;
         $this->layout->content = $this->view ;
         return $this->layout ; 
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }
   }

    /**
     * funkcja służąca do dodawania zwierzęcia do bazy
     * wywołuje funkcję saveAnimal($obj) z klasy Model
     * zwraca odpowiedź czy udało się dodać zwierzę do bazy 
     */
   function saveAnimal() {
      if($_SESSION['auth'] == 'USER'){
         $datazw = $_POST['datazw'] ;
         $obj  = json_decode($datazw) ;
         if ( isset($obj->imie) and isset($obj->gatunek) and isset($obj->rasa) and isset($obj->wielkosc) ) {    
            $response = $this->model->saveAnimal($obj) ;
         }
         return ( $response ? "Dodano zwierzę"."<br><p><a href='index.php?sub=Zwierze&action=show'>Odśwież</a></p>" : "Nie udało się dodać zwierzęcia"."<br><p><a href='index.php?sub=Zwierze&action=add'>Spróbuj ponownie</a></p>" ) ;
      }else { 
         $this->layout->header = 'Aby zobaczyć zawartość należy się zalogować jako właściciel zwierzęcia' ; 
         return $this->layout ;
      }
   }  

} 
 
?>
