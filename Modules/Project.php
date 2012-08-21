<?php

class Project 
{
    private $_name;

    public function create($name)
    {
        $this->_name = strtolower($name);
        render("Creating new project ... ");
        $this->_createFolder();
        $this->_bootstrap();
        $this->_vhost();
        
        render("Project created");

    }

    private function _vhost()
    {
        $vhost = file_get_contents(__DIR__ . '/../templates/vhost');
    
        $path = getcwd() . '/' . $this->_name; 
        $vhost = str_replace("{path}", $path, $vhost);
        $vhost = str_replace("{project}", $this->_name, $vhost);
        
        echo "\n Virtual Host, copy and paste the code below in your httpd.conf file\n";
        echo "\n" . $vhost . "\n";
        echo "\n\n####\n";
    }

    private function _createFolder()
    {
        if (file_exists($this->_name)) {
            render('The folder exists', 2);
        } 
        mkdir($this->_name, 0755);
    }

    private function _bootstrap()
    {
        exec('rsync -avz ' . __DIR__ . '/../templates/ZendSkeletonApplication/ --exclude .git* ' .  $this->_name . '/' );
    }
}

