<?php

class {{Package}}_{{Module}}_Block_Adminhtml_{{Model}}_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('{{model}}_form');
    }

    protected function _prepareForm()
    {
        /** @var {{Package}}_{{Module}}_Model_{{Model}} $model */
        $model = Mage::registry('{{package}}_{{module}}_{{model}}');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('{{package}}_{{module}}')->__('General Information'), 'class' => 'fieldset-wide'));

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', array(
                'name' => 'id',
            ));
        }

        $fieldset->addField('status', 'select', array(
            'label'     => Mage::helper('{{package}}_{{module}}')->__('Status'),
            'title'     => Mage::helper('{{package}}_{{module}}')->__('Status'),
            'name'      => 'status',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('{{package}}_{{module}}')->__('Enabled'),
                '0' => Mage::helper('{{package}}_{{module}}')->__('Disabled'),
            ),
        ));

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('{{package}}_{{module}}')->__('Name'),
            'title'     => Mage::helper('{{package}}_{{module}}')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('content', 'textarea', array(
            'name'      => 'content',
            'label'     => Mage::helper('{{package}}_{{module}}')->__('{{Model}} Content'),
            'title'     => Mage::helper('{{package}}_{{module}}')->__('{{Model}} Content'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
