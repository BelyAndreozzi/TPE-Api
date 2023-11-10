<?php
    require_once 'config.php';
    require_once 'libs/router.php';

    require_once 'src/controllers/agent.api.controller.php';
    /* require_once 'src/controllers/user.api.controller.php'; */

    $router = new Router();

    $router->addRoute('agentes',     'GET',    'AgentApiController', 'get'   ); 
    $router->addRoute('agentes',     'POST',   'AgentApiController', 'create');
    $router->addRoute('agentes/:ID', 'GET',    'AgentApiController', 'get'   );
    $router->addRoute('agentes/:ID/:subrecurso', 'GET',    'AgentApiController', 'get');
    $router->addRoute('agentes/:ID', 'PUT',    'AgentApiController', 'update');
    $router->addRoute('agentes/:ID', 'DELETE', 'AgentApiController', 'delete');
    
    /* $router->addRoute('user/token', 'GET',    'UserApiController', 'getToken'); falta hacer token CAMBIAR*/

    
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

