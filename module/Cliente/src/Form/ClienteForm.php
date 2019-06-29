<?php
namespace Cliente\Form;

use Zend\Form\Form;

class ClienteForm extends Form{
	public function __construct() {
        parent::__construct('cliente', []);
        
        $this->add(new \Zend\Form\Element\Hidden('id'));
        $this->add(new \Zend\Form\Element\Text("nome",['label' => "Nome"]));
        $this->add(new \Zend\Form\Element\Text("telefone",['label' => "Telefone"]));
        $this->add(new \Zend\Form\Element\Text("cpf",['label' => "CPF"]));
        
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes(['value'=>'Salvar','id'=>'submitbutton']);
        $this->add($submit);
    }
}