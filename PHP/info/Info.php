<?php
 
namespace info ;
 
use appl\ { View, Controller } ;
// use appl\Controller ;
 
class Info extends Controller {
 
   protected $layout ;
   protected $model ;
 
   function __construct() {
      parent::__construct();
         session_start() ;
         $this->layout = new View('main') ;
         $this->layout->css = $this->css ;
         $this->layout->title  = 'Klinika weterynaryjna' ;
         $this->layout->menu = $this->menu ;
         $this->model  = new Model() ;
   }
 
  function index() {
      $this->layout->header  = '' ;
      $this->view = new View('strglowna') ;
      $this->layout->content = $this->view ;
      return $this->layout ;
  }
 
  function help() {
    $this->layout->header = '' ;
    $this->view = new View('info') ;
    $this->model->update();
    $this->view->data = $this->model->showStats() ;
    $this->layout->content = $this->view ;
    return $this->layout ;
  }
 
  function error( $text ) {
      $this->layout->content = $text ;
      return $this->layout ;       
  }
}
 
?>