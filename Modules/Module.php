<?php

class Module
{
    private $_name;

    public function show($argv)
    {
        
        echo "\n-----------\n";
        echo "\nModule list. \n";

        $config = include 'config/application.config.php';
        
        foreach ($config['modules'] as $m) {
            echo "\n" . $m;
        }
        
    }

    public function create($argv)
    {
        
        $this->_name = strtolower($argv[3]);
        render("Creating new Module ...");
        $this->_activateModule();
        $this->_addModule();
        $this->_updateNewModule();
        $this->_updateFilesName();
        render("Module {$this->_name} created");
    }

    private function _activateModule()
    {
        if (! file_exists(APPLICATION_CONF_FILE)) {
            render('The file ' . APPLICATION_CONF_FILE . " dosen't exists", 2);
        }
        $content = file_get_contents(APPLICATION_CONF_FILE);
        $content = str_replace("'Application',", "'Application',\n        '" 
                . ucfirst($this->_name) . "',", $content
        );
        file_put_contents(APPLICATION_CONF_FILE, $content);
    }

    private function _addModule()
    {
        exec('rsync -avz ' . __DIR__  . '/../templates/ZendSkeletonModule/ ' .
            '--exclude .git*  module/' . ucfirst($this->_name) 
        );

    }

    private function _updateFilesName()
    {
        $dir = 'module/' . ucfirst($this->_name) . '/src/';
        exec( "mv {$dir}ZendSkeletonModule {$dir}" . ucfirst($this->_name) );

        $dir .= ucfirst($this->_name) . '/Controller/';     
        exec("mv {$dir}SkeletonController.php {$dir}" . ucfirst($this->_name) . 'Controller.php');

        $dir = 'module/' . ucfirst($this->_name) . '/tests/';
        exec("mv {$dir}ZendSkeletonModule {$dir}" .ucfirst($this->_name));

        $dir = 'module/' . ucfirst($this->_name) . '/view/';
        exec("mv {$dir}zend-skeleton-module {$dir}" . $this->_name . "");   
        $dir = "{$dir}" . $this->_name . "/";
        exec("mv {$dir}skeleton {$dir}" . $this->_name  );   
    }

    private function _updateNewModule()
    {
        exec("find . -type f -exec sed -i '' s/ZendSkeletonModule/" . ucfirst($this->_name) . "/g {} +" );
        exec("find . -type f -exec sed -i '' s/ZendSkeleton/" . ucfirst($this->_name) . "/g {} +");
        exec("find . -type f -exec sed -i '' s/Skeleton/" . ucfirst($this->_name) . "/g {} +");
        exec("find . -type f -exec sed -i '' s/skeleton/" . $this->_name . "/g {} +" );
        exec("find . -type f -exec sed -i '' s/module-name-here/" . $this->_name . "/g {} +" );
        exec("find . -type f -exec sed -i '' s/module-specific-root/" . $this->_name . "/g {} +" );
        

    }
}   
