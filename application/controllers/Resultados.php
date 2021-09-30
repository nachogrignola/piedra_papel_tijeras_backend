<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once (APPPATH.'/libraries/REST_Controller.php');

use Restserver\libraries\REST_Controller;

session_start();

class Resultados extends REST_Controller {

  public function index() {

  }

  public function obtenerResultados_get() {

    if (isset($_SESSION['resultados'])) {
      $mostrarResultados = $_SESSION['resultados'];
      $respuesta = array('error' => FALSE,
                          'resultados' => $mostrarResultados);
      $this-> response($respuesta, REST_Controller::HTTP_OK);
    } else {
      $respuesta = array('message' => 'arreglo vacio',
                          'resultados' => []);
      $this-> response($respuesta, REST_Controller::HTTP_OK);
    }

  }

  public function guardarResultado_post(){

    $data = $this ->post();
    $items = $data;
    $_SESSION['resultados'][] = $items;
    $respuesta = array('error' => FALSE,
                        'resultado' => $items);
    $this-> response($respuesta, REST_Controller::HTTP_OK);

  }

  public function borrarResultados_delete(){
    if (session_destroy()){
      $this-> response('200');
    } else {
      $this-> response('400');
    }
  }

}
