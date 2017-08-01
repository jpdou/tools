<?php

class S
{
    static function log($message, $flag=null)
    {
        $date = date('Y-m-d H:i:s');
        $_message = "[{$date}]";
        if(is_object($message)){
            $_message .= get_class($message);
        }elseif(is_null($message) || is_bool($message)){
            $_message .= var_export($message, true);
        }elseif(is_array($message)){
            $_message .= print_r($message, true);
        }else{
            $_message .= $message;
        }
        $file = __DIR__. DIRECTORY_SEPARATOR. 'msg.log';
        if ($flag) {
            $_message = "====". (string)$flag. "====\n". $_message;
        }
        file_put_contents($file, $_message."\n", FILE_APPEND);
    }

    /**
     * @param Exception $e
     */
    public static function logException($e)
    {
        self::log($e->getMessage());
        self::log($e->getTraceAsString());
    }

    public static function logTrace()
    {
        self::log(self::getTrace());
    }

    public static function getTrace()
    {
        $e = new Exception();
        return $e->getTraceAsString();
    }

    /**
     * @param array $time
     * @return float
     */
    static public function getExpendedTime(&$time)
    {
        $analyseEntity = self::_getAnalyseEntity();
        $beginTime = $analyseEntity->getData('begin_time');
        if (is_null($beginTime)) {
            $beginTime = self::_getMicroTime();
            $analyseEntity->setData('begin_time', $beginTime);
        }
        $previous = $analyseEntity->getData('previous_time');
        $currentTime = self::_getMicroTime();
        $timeIncrement = 0;
        if (!is_null($previous)) {
            $timeIncrement = $currentTime - $previous;
        }
        $analyseEntity->setData('previous_time', $currentTime);
        $time['current'] = $currentTime - $beginTime;
        $time['increment'] = $timeIncrement;
        return $time;
    }

    static public function performanceAnalyseLog($message)
    {
        $analyseEntity = self::_getAnalyseEntity();
        $id = $analyseEntity->getData('identifier');
        if (is_null($id)) {
            $id = substr(md5(self::_getMicroTime()), 0, 5);
            $analyseEntity->setData('identifier', $id);
            $uri = Mage::app()->getRequest()->getRequestUri();
            $analyseEntity->setData('request_uri', $uri);
        }
        $message = $analyseEntity->getData('log'). '['. $id. ']' . $message."\n";
        $analyseEntity->setData('log', $message);
    }

    static public function flushLog()
    {
        $analyseEntity = self::_getAnalyseEntity();
        $file = 'performance_analyse.log';
        $log = $analyseEntity->getData('log');
        $log .= '['. $analyseEntity->getData('identifier'). ']'. 'request_uri '. $analyseEntity->getData('request_uri'). "\n";
        $log .= '['. $analyseEntity->getData('identifier'). ']'. 'begin_time '. $analyseEntity->getData('begin_time'). "\n";
        file_put_contents($file, $log, FILE_APPEND);
        $analyseEntity->setData('log', '');
    }

    static protected function _getMicroTime()
    {
        $time = explode(' ', microtime(false));
        return (float) $time[0] + (float) $time[1];
    }

    /**
     * @return Varien_Object
     */
    static protected function _getAnalyseEntity()
    {
        $obj = Mage::registry('analyse_obj');
        if (is_null($obj)) {
            $obj = new Varien_Object();
            Mage::register('analyse_obj', $obj);
        }
        return $obj;
    }
}