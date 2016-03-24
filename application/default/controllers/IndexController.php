<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction(){
    	$this->_helper->layout->setLayout('main');
    }

	public function registroAction(){
    	$this->_helper->layout->setLayout('main');
    	$this->view->headScript()->appendFile('/jquery/jquery.dataTables.min.js');
    	$this->view->headScript()->appendFile('/js/registro.js');
    	$this->view->headLink()->appendStylesheet($this->view->baseUrl . '/jquery/jquery.dataTables.min.css');  
    }    

    public function reloadAction() {
        $this->getHelper('layout')->disableLayout();
        $this->getHelper('ViewRenderer')->setNoRender();

        $registros = new Registros();
    	$data = $registros->getAll();
        $paquete = array();
        $paquete['draw'] = count($data);
        $paquete['recordsTotal'] = count($data);
        $paquete['recordsFiltered'] = count($data);
        $data_parsed = array();
        foreach ($data as $row) {
            $item = array();
            $item['registro'] = $row['registro'];
            $item['fecha'] = $row['fecha'];
            $data_parsed[] = $item;
        }
        $paquete['data'] = $data_parsed;

        return $this->getResponse()->setBody(Zend_Json::encode($paquete));
    }

    public function addAction() {
        $this->getHelper('layout')->disableLayout();
        $this->getHelper('ViewRenderer')->setNoRender();
        try{
        	$registros = new Registros();
	        $dato = $this->getRequest()->getParam("valor");
	    	$registros->insert(array("id_usuario"=>"234", "registro" => $dato));
        } catch(Exception $e){
        	$error = $e->getMessage();
        }
	        
       
		$out = array('success' => true, 'error' => $error);
        return $this->getResponse()->setBody(Zend_Json::encode($out));
    }
}

