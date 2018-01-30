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


    public function testAction() {
        $this->getHelper('layout')->disableLayout();
        $this->getHelper('ViewRenderer')->setNoRender();
        
	        
       
		$out = array('success' => true, 'error' => $error);
        return $this->getResponse()->setBody(Zend_Json::encode($out));
    }
}

