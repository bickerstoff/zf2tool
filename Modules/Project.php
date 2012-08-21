<?php

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
        exec('rsync -avz ' . __DIR__ . '/../templates/ZendSkeletonApplication/ --exclude .git* ' .  $destiny . '/' );
    }
}

