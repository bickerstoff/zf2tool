#!/usr/bin/php
<?php

render(__DIR__);
try {
    $class = ucfirst($argv[2]);
    $module = new $class();
} catch (Exception $e) {
    render($e->getMessage());
    render("We can't found the module " . $argv[1]);
}

$method = $argv[1];
$module->$method($argv[3]);

render("\n\n---------------------------------------");
render('Complete');

function render($message, $type = 1)
{
    echo $message . "\n";

    if ($type == 2) { 
        echo "\n-------------\n";
        echo "\n[error] $message\n";
        die("\n!!!! We found erros \n");
    }
}

class Module
{
    public function create($name)
    {
        render("Creating new Module ...");
        $this->_addModule($name);
        render("Module $name created");
    }

    private function _addModule($name)
    {
        exec('rsync -avz ' . __DIR__  . '/templates/ZendSkeletonModule/ --exclude .git*  module/' . $name );

    }
}   
    

class Project 
{
    public function create($name)
    {
        render("Creating new project ... ");

        $this->_createFolder($name);
        $this->_bootstrap($name);
        
        render("Project created");

    }

    private function _createFolder($name)
    {
        if (file_exists($name)) {
            render('The folder exists', 2);
        } 
        mkdir($name, 0755);
    }

    private function _bootstrap($destiny)
    {
        exec('rsync -avz ' . __DIR__ . '/templates/ZendSkeletonApplication/ --exclude .git* ' .  $destiny . '/' );
    }
}

