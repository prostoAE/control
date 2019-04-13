<?php

use php\core\Router;

// Default routes
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
//Router::add('^main$', ['controller' => 'Main', 'action' => 'index']);
//Router::add('^sup$', ['controller' => 'Sup', 'action' => 'sup']);
//Router::add('^ajax', ['controller' => 'Ajax', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)\/?(?P<action>[a-z-]+)?$');
