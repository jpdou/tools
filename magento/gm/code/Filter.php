<?php
/**
 * Created by PhpStorm.
 * User: jp.dou
 * Date: 2017/7/28
 * Time: 14:45
 */
class Filter
{
    protected $_data = array();
    protected $_content;
    protected $_dir = array(
        'template' => BASE_DIR. DIRECTORY_SEPARATOR. 'template'. DIRECTORY_SEPARATOR,
        'modules'  => BASE_DIR. DIRECTORY_SEPARATOR. 'modules'. DIRECTORY_SEPARATOR,
    );


    public function __construct($data=array())
    {
        if (is_array($data)) {
            $this->_data = $data;
        }
        return $this;
    }

    public function setPackage($package)
    {
        $this->_data['package'] = $package;
        return $this;
    }

    public function setModule($module)
    {
        $this->_data['module'] = $module;
        return $this;
    }

    public function setModel($model)
    {
        $this->_data['model'] = $model;
        return $this;
    }

    public function readTpl()
    {
        if (empty($this->_data['package']) || empty($this->_data['module']) || empty($this->_data['model'])) {
            throw new Exception('empty post data.');
        }
        $folder = BASE_DIR. DIRECTORY_SEPARATOR. 'template/';
        $types = array(
            'adminhtml_form',
            'etc',
            'model',
            'helper'
        );
        $this->readBlockTpl($folder);
    }

    protected function readBlockTpl($folder)
    {
        $files = array(
            'Block_Adminhtml_Model.php.tpl',
            'Block_Adminhtml_Model_Grid.php.tpl',
            'Block_Adminhtml_Model_Edit.php.tpl',
            'Block_Adminhtml_Model_Edit_Form.php.tpl',
        );

        return $this->readFile($files, $folder);
    }

    protected function readFile($files, $folder)
    {
        foreach ($files as $file) {
            $file = str_replace('_', DIRECTORY_SEPARATOR, $file);
            $fullPath = $folder. $file;
            try {
                if (!file_exists($fullPath)) {
                    throw new Exception(sprintf('%s not exists.', $fullPath));
                }
                if (!is_readable($fullPath)) {
                    throw new Exception(sprintf('%s is not readable.', $fullPath));
                }
                $content = $this->filter(file_get_contents($fullPath));
                $this->_content[$file] = $content;
            } catch (Exception $e) {
                print_r($e->getMessage());
                exit();
            }
        }
        return $this->_content;
    }

    protected function filter($content)
    {
        if (!$content) {
            return '';
        }

        $content = str_replace('{{Package}}', $this->_data['package'], $content);
        $content = str_replace('{{package}}', strtolower($this->_data['package']), $content);

        $content = str_replace('{{Module}}', $this->_data['module'], $content);
        $content = str_replace('{{module}}', strtolower($this->_data['module']), $content);

        $content = str_replace('{{Model}}', $this->_data['model'], $content);
        $content = str_replace('{{model}}', strtolower($this->_data['model']), $content);
        return $content;
    }

    public function save()
    {
        foreach ($this->_content as $file => $content) {
            try {
                $file = str_replace('.tpl', '', $file);
                $fullPath = $this->_dir['modules']. $this->_data['module']. DIRECTORY_SEPARATOR. $file;
                S::log($fullPath);
                $dir = dirname($fullPath);
                S::log($dir);
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
                if (!is_writable($dir)) {
                    throw new Exception(sprintf('gm: the %s dir is not writable.', $dir));
                }
                if(file_put_contents($fullPath, $content)) {
                    S::log(sprintf('save %s success.', $fullPath));
                } else {
                    throw new Exception('gm: save file failed.');
                }
            } catch (Exception $e) {
                S::logException($e);
            }
            unset($this->_content[$file]);
        }
    }

}