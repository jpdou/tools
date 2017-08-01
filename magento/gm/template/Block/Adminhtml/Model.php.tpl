<?php

class {{Package}}_{{Module}}_Block_Adminhtml_{{Model}} extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_blockGroup = '{{package}}_{{module}}';
        $this->_controller = 'adminhtml_{{model}}';
        $this->_headerText = $this->__('{{Module}} {{Model}}');
        $this->_addButtonLabel = $this->__('Add New {{Model}}');
        parent::__construct();
    }

}
