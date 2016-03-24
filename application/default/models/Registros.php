<?php

class Registros extends Zend_Db_Table_Abstract {

    protected $_name = 'registros';

    
    public function getAll() {
        $consulta = $this->select();
        $consulta = parent::fetchAll($consulta)->toArray();
        return $consulta;
    }
}
