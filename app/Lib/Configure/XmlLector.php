<?php
// in app/Lib/Configure/XmlLector.php
App::uses('Xml', 'Utility');


class XmlLector implements ConfigReaderInterface
{
    public function __construct($path = null)
    {
        if (!$path) {
            $path = APP . 'Config' . DS;
        }
        $this->_path = $path;
    }

    public function read($key)
    {
        $xml = Xml::build($this->_path . $key . '.xml');
        return Xml::toArray($xml);
    }
}