<?php

use php\core\Router;

// Default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^main$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^sup$', ['controller' => 'Sup', 'action' => 'sup']);
Router::add('^(?:p<controller>[a-z-]+)/?(?:p<action>[a-z-]+)?$');
