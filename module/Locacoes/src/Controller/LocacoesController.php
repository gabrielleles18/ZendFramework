<?php

namespace Locacoes\Controller;

use Locacoes\Form\LocacoesForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LocacoesController extends AbstractActionController {

    private $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function indexAction() {
        return new ViewModel(['locacoess' => $this->table->getAll()]);
    }

    public function adicionarAction() {
        $form = new LocacoesForm();
        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return new ViewModel(['form' => $form]);
        }
        $locacoes = new \Locacoes\Model\Locacoes();
        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return new ViewModel(['form' => $form]);
        }
        $locacoes->exchangeArray($form->getData());
        $this->table->salvarLocacoes($locacoes);
        return $this->redirect()->toRoute('locacoes');
    }

   
    public function editarAction() {
        $id_locacoes = (int) $this->params()->fromRoute('id_locacoes', 0);
        if (0 === $id_locacoes) {
            return $this->redirect()->toRoute('locacoes', ['action' => 'adicionar']);
        }
        try {
            $locacoes = $this->table->getLocacoes($id_locacoes);
        } catch (Exception $exc) {
            return $this->redirect()->toRoute('locacoes', ['action' => 'index']);
        }
        $form = new LocacoesForm();
        $form->bind($locacoes);
        $form->get('submit')->setAttribute('value', 'Salvar');
        $request = $this->getRequest();
        $viewData = ['id_locacoes' => $id_locacoes, 'form' => $form];
        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setData($request->getPost());
        if (!$form->isValid()) {
            return $viewData;
        }
      //  $cliente->exchangeArray($form->getData());
        $this->table->salvarLocacoes($form->getData());
        return $this->redirect()->toRoute('locacoes');
    }
    public function removerAction() {
        $id_locacoes = (int) $this->params()->fromRoute('id_locacoes', 0);
        if (0 === $id_locacoes) {
            return $this->redirect()->toRoute('locacoes');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del','Não');
            if ($del == 'Sim') {
                $id_locacoes = (int) $request->getPost('id_locacoes');
                $this->table->deletarLocacoes($id_locacoes);
            }
            return $this->redirect()->toRoute('locacoes');
        }
        return ['id_locacoes' => $id_locacoes, 'locacoes' => $this->table->getLocacoes($id_locacoes)];
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
