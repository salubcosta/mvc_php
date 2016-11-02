<?php
// Inclui environment.php que contém URL_BASE & ENVIRONMENT
require_once 'environment.php';

/*
 * Caso a constante seja = development. Estamos iremos trabalhar com localhost
 * Caso a constante seja != development. Significa que estamos em produção
 */
if(ENVIRONMENT == "development"){
  define("HOST", "localhost");
  define("DBNAME", "dblocal");
  define("DBUSER", "root");
  define("DBPASS", "");
}else{
  define("HOST", "http://servidor.com");
  define("DBNAME", "dbServidor");
  define("DBUSER", "rootServidor");
  define("DBPASS", "SenhaServidor");
}

// Auto Carregamento das Classes do projeto
spl_autoload_register(function($class){
  if(file_exists(DIRETORIO.'/controllers/'.$class.'.php')){
    require_once DIRETORIO.'/controllers/'.$class.'.php';
  }else if (file_exists(DIRETORIO.'/models/'.$class.'.php')) {
    require_once DIRETORIO.'/models/'.$class.'.php';
  }else{
    require_once DIRETORIO.'/core/'.$class.'.php';
  }
});
