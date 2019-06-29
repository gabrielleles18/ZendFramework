<?php

namespace Locacoes;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
	'router' => [
		'routes' => [
			'locacoes' => [
				'type' => \Zend\Router\Http\Segment::class,
				'options' => [
					'route' => '/locacoes[/:action[/:id]]',
					'constraints' => [
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+'
					],
					'defaults' => [
						'controller' => Controller\LocacoesController::class,
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
           'locacoes' => __DIR__ . '/../view',
        ],
    ],
    'db' => [
    	'driver' => 'Pdo_Mysql',
    	'database' => 'locadora',
    	'username' => 'root',
    	'password' => '',
    	'hostname' => 'localhost'
    ],
];