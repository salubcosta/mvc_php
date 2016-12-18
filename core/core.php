<?php

class core{

  // executa o processarURL(). Basicamente o main desta estrutura MVC
  public function run(){
    $this->processarURL();
  }

  public function processarURL(){
    $params = array();
    if(isset($_GET['url'])){
      /*
      filter_var = remove caracteres ilegais | strtolower = torna toda a url minúscula | rtrim = remove os espaços
      */
      $url = filter_var(strtolower(rtrim($_GET['url'])), FILTER_SANITIZE_URL);

      $url = explode('/',$url); //retorna um array
      // print_r($url);
      // exit; //teste
      $controller = $this->verificarArray($url,0) ? $this->verificarArray($url,0).'Controller' : "homeController";
      $action = $this->verificarArray($url,1) ? $this->verificarArray($url,1) : "index";

      if($this->verificarArray($url,2)){
        unset($url[0]);
        unset($url[1]);
        $params = $url;
      }
    }else{
      $controller = "homeController";
      $action = "index";
    }

    //Se não validar controller, uma opção seria chamar o arquivo 404.php
    if(!$this->validaController($controller))
    {
      echo "Página (Controller) não encontrada. <br />Ótima opção seria chamar a página 404.php/html";
      exit;
    }

    //Se apenas uma chamada para o controller.php
    require_once DIRETORIO.'/core/controller.php';

    $_controller = new $controller;
    //Se não validar a action, uma opção seria chamar o arquivo 404.php
    if(!$this->validaAction($_controller,$action)){
      echo "Página (Action/Método) não encontrada (Ou não implementado), por que o controller existe: {$controller}. <br />Ótima opção seria chamar a página 404.php/html";
      exit;
    }

    call_user_func_array(array($_controller, $action), $params);
  } //fim processarURL

  /*
   * Retorna o array em sua respectiva posição.
   * utlizando para trabalhar controllers e actions e verificar os params
   */
  public function verificarArray($array, $key){
    if(isset($array[$key])){
      return $array[$key];
    }
    return false;
  }
  //retorna true ou false na validação da existência do controller
  public function validaController($controller){
    return (file_exists(DIRETORIO.'/controllers/'.$controller.'.php'));
  }
  //retorna true ou false na validação da existência da action;
  public function validaAction($obj,$action){
    return (method_exists($obj,$action));
  }
}
