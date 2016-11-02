<?php

// inclui o arquivo de confirguração
require_once 'config.php';

/*
 * classe core é a base desta arquitetura MVC;
 * esta classe é responsável para as chamadas dos:
 * (controllers) controladores, (actions) ações/métodos e (params) parâmetros.
 */
$core = new core();
$core->run();
