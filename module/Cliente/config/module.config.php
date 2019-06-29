<?php

namespace Cliente;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
	'router' => [
		'routes' => [
			'cliente' => [
				'type' => \Zend\Router\Http\Segment::class,
				'options' => [
					'route' => '/cliente[/:action[/:id]]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+'
					],
					'defaults' => [
						'controller' => Controller\ClienteController::class,
						'action' => 'index',
					],
				],
			],
		],
	],
	'controllers' => [
		'factories' => [
		//Controller\ClienteController::class => InvokableFactory::class,
		],
	],
	'view_manager' => [
        'template_path_stack' => [
           'cliente' => __DIR__ . '/../view',
        ],
    ],
    'db' => [
    	'driver' => 'Pdo_Mysql',
    	'database' => 'db_banco',
    	'username' => 'root',
    	'password' => '',
    	'hostname' => 'localhost'
    ],
];