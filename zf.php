<?php
try {
    $class = ucfirst($argv[1]);
    $module = new $class();
} catch (Exception $e ) {
    echo $e->getMessage();
    echo "\n We can't found the module " . $argv[1] ;
}

$method = $argv[2];
$module->$method($argv[3]);


class Module
{
    public function create($name)
    {
        echo "Creating new Module ... \n";
        $this->_addModule($name);

        echo "Module $name created \n";
    }

    private function _addModule($name)
    {
        exec('rsync -avz ../skeletons/ZendSkeletonModule/ --exclude .git*  module/' . $name );

    }
}   
    

class Project 
{
    public function create($name)
    {
        echo "Creating new project ... ";
        mkdir($name, 0755);

        $this->_bootstrap($name);
        echo "\nProject created.\n";

    }

    private function _bootstrap($destiny)
    {
        exec('rsync -avz skeletons/ZendSkeletonApplication/ --exclude .git* ' .  $destiny . '/' );
    }
}

