<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require_once (APPPATH.'/libraries/REST_Controller.php');

use Restserver\libraries\REST_Controller;



class Resultados extends REST_Controller {

  public function __construct(){

    parent::__construct();

    header("Access-Control-Allow-Methods: POST, PUT, DELETE, UPDATE");
    header("Access-Control-Allow-Origin: * ");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
  }

  public function index() {

  }

  public function obtenerResultados_get() {

      if($this->cache->get('todos')){
        $mostrarResultados = $this->cache->get('todos');
        $mostrarResultados = array_slice($mostrarResultados, -10);
        $mostrarResultados = array_reverse($mostrarResultados);
        $respuesta = array('error' => FALSE,
                            'resultados' => $mostrarResultados);
        $this-> response($respuesta, REST_Controller::HTTP_OK);
        return;
      } else {
        $respuesta = array('error' => FALSE,
                            'resultados' => []);
        $this-> response($respuesta, REST_Controller::HTTP_OK);
        return;
      }

  }

  public function guardarResultado_post(){
    $data = $this ->post();
    json_encode($data);
    $items = $data;
    $arrayCargaData = array();

    if($this->cache->get('resultado')){
      $arrayCargaData = $this->cache->get('todos');
      array_push($arrayCargaData, $items);
    } else {
      $this->cache->save('resultado', $items);
      array_push($arrayCargaData, $items);
    }

    $this->cache->save('todos', $arrayCargaData);
    $respuesta = array('error' => FALSE,
                        'resultado' => $arrayCargaData);
    $this-> response($respuesta, REST_Controller::HTTP_OK);
    return;

  }

  public function borrarResultados_delete(){
      $this->cache->delete('resultado');
      $this->cache->delete('todos');
      $this-> response('200');
  }

}
