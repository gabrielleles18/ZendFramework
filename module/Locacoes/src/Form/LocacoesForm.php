<?php
namespace Locacoes\Form;

use Zend\Form\Form;

class LocacoesForm extends Form{
	public function __construct() {
        parent::__construct('locacoes', []);
        
        $this->add(new \Zend\Form\Element\Hidden('id_locacoes'));
        $this->add(new \Zend\Form\Element\Text("datasaida",['label' => "DataSaida"]));
        $this->add(new \Zend\Form\Element\Text("dataretorno",['label' => "DataRetorno"]));
        $this->add(new \Zend\Form\Element\Text("cliente_id",['label' => "ClienteID"]));
        
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes(['value'=>'Salvar','id_locacoes'=>'submitbutton']);
        $this->add($submit);
    }
}