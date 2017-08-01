<?php

class {{Package}}_{{Module}}_Model_Resource_{{Model}} extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('{{package}}_{{module}}/{{model}}', 'id');
    }
}