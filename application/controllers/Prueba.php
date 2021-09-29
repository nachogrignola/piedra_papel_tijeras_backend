<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba extends CI_Controller {

  public function index() {
    echo "Hola mundo";
  }

  public function obtenerArreglo($index) {

    $arreglo = array('manzana','peras','naranjas');
    echo json_encode($arreglo[$index]);

  }

}
