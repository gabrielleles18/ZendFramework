<?php 

namespace Cliente;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Cliente\Controller\ClienteController;

class Module implements ConfigProviderInterface{

	public function getConfig() {
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig() {
        return [
            'factories' => [
                Model\ClienteTable::class => function($container) {
                    $tableGateway = $container->get(Model\ClienteTableGateway::class);
                    return new Model\ClienteTable($tableGateway);
                },
                Model\ClienteTableGateway::class => function($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Cliente());
                    return new TableGateway('cliente', $dbAdapter, null, $resultSetPrototype);
                },
            ]
        ];
    }

    public function getControllerConfig() {
        return [
            'factories' => [
                ClienteController::class => function($container) {
                    $tableGateway = $container->get(Model\ClienteTable::class);
                    return new ClienteController($tableGateway);
                },
            ]
        ];
    }

}