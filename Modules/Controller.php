<?php
class Controller
{

    const TEMPLATE = 'ZendSkeletonModule/src/ZendSkeletonModule/Controller/SkeletonController.php';
    private $_name;
    private $_module;

    public function create($argv) 
    {
        $this->_name = ucfirst(strtolower($argv[4]));
        $this->_module = ucfirst(strtolower($argv[3]));
        $this->_copy();
        $this->_sed();
        $this->_upgrade();
    }

    private function _copy()
    {
        $destiny =  'module/' . $this->_module . '/src/' . 
            $this->_module . '/Controller/'. $this->_name . 
            'Controller.php';

        exec( 'cp ' . __DIR__  . '/../templates/' . self::TEMPLATE .' '. $destiny);
    }
    
    private function _sed()
    {
        $dir .= $this->_module . '/Controller/';     
        exec("find module/" .$this->_module . " -type f -exec sed -i '' s/Skeleton/" . $this->_name . "/g {} +");
    }
    
    private function _upgrade()
    {
        
        $configFile =  'module/' . $this->_module 
            . '/config/module.config.php';
        $config = file_get_contents($configFile);
        
        $needle = "'invokables' => array(";
        $new = "'invokables' => array(\n            '" 
                . $this->_module . "\Controller\\" . $this->_name .
                "' =>  '" . $this->_module . "\Controller\\". $this->_name .
                "Controller', ";
                                
        $content = str_replace($needle, $new, $config);
        
        file_put_contents($configFile, $content);
    }
    
}
