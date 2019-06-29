<?php

namespace Cliente\Controller;

use Cliente\Form\ClienteForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClienteController extends AbstractActionController {

    private $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function indexAction() {
        return new ViewModel(['clientes' => $this->table->getAll()]);
    }

    public function adicionarAction() {
        $form = new ClienteForm();
        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $cliente = new \Cliente\Model\Cliente();
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return new ViewModel(['form' => $form]);
        }
        $cliente->exchangeArray($form->getData());
        $this->table->salvarCliente($cliente);
        return $this->redirect()->toRoute('cliente');
    }

   
    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('cliente', ['action' => 'adicionar']);
        }
        try {
            $cliente = $this->table->getCliente($id);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('cliente', ['action' => 'index']);
        }
        $form = new ClienteForm();
        $form->bind($cliente);
        $form->get('submit')->setAttribute('value', 'Salvar');
        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }
      //  $cliente->exchangeArray($form->getData());
        $this->table->salvarCliente($form->getData());
        return $this->redirect()->toRoute('cliente');
    }
    public function removerAction() {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (0 === $id) {
            return $this->redirect()->toRoute('cliente');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del','Não');
            if ($del == 'Sim') {
                $id = (int) $request->getPost('id');
                $this->table->deletarCliente($id);
            }
            return $this->redirect()->toRoute('cliente');
        }
        return ['id' => $id, 'cliente' => $this->table->getCliente($id)];
  }
   
    /**
      /cliente -> index
      /cliente/adicionar -> adicionarAction
      /cliente/salvar ->salvarAction
      /cliente/editar/1 ->editarAction
      /cliente/remover/1 ->removerAction
      /cliente/confirmacao ->confirmacaoAction
     */
}
