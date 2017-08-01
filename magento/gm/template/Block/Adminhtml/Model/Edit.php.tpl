<?php

class {{Package}}_{{Module}}_Block_Adminhtml_{{Model}}_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = '{{package}}_{{module}}';
        $this->_controller = 'adminhtml_{{model}}';

        parent::__construct();

        $this->_updateButton('save', 'label', $this->__('Save'));
        $this->_updateButton('delete', 'label', $this->__('Delete'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        $currentModel = $this->getCurrentModel();
        if ($currentModel->getId()) {
            return $this->__("Edit {{Module}} {{Model}}");
        } else {
            return $this->__('New {{Module}} {{Model}}');
        }
    }

    /**
     * @return {{Package}}_{{Module}}_Model_{{Model}}
     */
    protected function getCurrentModel()
    {
        return Mage::registry('{{package}}_{{module}}_{{model}}');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('*/*/save');
    }
}
