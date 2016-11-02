<?php

class core{

  // executa o processarURL(). Basicamente o main desta estrutura MVC
  public function run(){
    $this->processarURL();
  }

  public function processarURL(){
    // implementar
    echo "Debug...";
  }

  /*
   * Retorna o array em sua respectiva posição.
   * utlizando para trabalhar controllers e actions e verificar os params
   */
  public function verficarArray($array, $key){
    if(isset($array[$key])){
      return $array[$key];
    }
    return null;
  }
}
