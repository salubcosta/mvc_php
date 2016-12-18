<?php

class homeController extends controller{

  public function index(){
    //Função principal a ser executada caso não seja especificado uma action
    $this->carregarTemplate('home',array());
  }
}
