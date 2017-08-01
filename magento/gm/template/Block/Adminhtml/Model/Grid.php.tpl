<?php

class {{Package}}_{{Module}}_Block_Adminhtml_{{Model}}_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('{{module}}{{Model}}Grid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        /* @var $collection {{Package}}_{{Module}}_Model_Resource_{{Model}}_Collection */
        $collection = Mage::getModel('{{package}}_{{module}}/{{model}}')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id', array(
            'header'    => $this->__('Id'),
            'align'     => 'center',
            'width'     => 60,
            'index'     => 'id',
        ));

        $this->addColumn('name', array(
            'header'    => $this->__('Name'),
            'align'     => 'left',
            'index'     => 'name',
        ));

        $this->addColumn('status', array(
            'header'    => $this->__('Status'),
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                0 => $this->__('Disabled'),
                1 => $this->__('Enabled')
            ),
        ));

        $this->addColumn('created_at', array(
            'header'    => $this->__('Date Created'),
            'index'     => 'created_at',
            'type'      => 'datetime',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
