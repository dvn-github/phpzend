<?php

/**
 * Clase Usuarios
 *
 * Clase del modelo que contiene los métodos para acceder al modelo de datos de la tabla 
 * Usuarios
 * 
 * @category   
 * @package    
 */
class Usuarios extends Zend_Db_Table_Abstract {

    protected $_name = 'usuarios';

     /**
     * Verificar si el usuario ya existe
     *
     * Método que permite verificar si un nombre de usuario ya se encuentra registrado.
     * 
     * @param string $name
     * @return boolean 0.
     * @return boolean 1.
     */
    public function userExists($username) {
        $consulta = $this->select()->where('nombre = ?', $username);
        $consulta = parent::fetchAll($consulta)->toArray();
        $consulta = $consulta[0];

        if (empty($consulta)) {
            return 0;
        } else {
            return 1;
        }
    }
}
