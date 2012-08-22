<?php

class Db
{

    /**
     * 3 => db Adapter
     * 4 => dbname 
     * 5 => host
     * 6 => user
     * 7 => pass
     */
    public function conn($argv)
    {
        $connection = file_get_contents(__DIR__ . '/../templates/Connection.php');
        $connection = str_replace('{adapter}', $argv[3], $connection);
        $connection = str_replace('{dbname}', $argv[4], $connection);
        $connection = str_replace('{host}', $argv[5], $connection);
        $connection = str_replace('{user}', $argv[6], $connection);
        $connection = str_replace('{pass}', $argv[7], $connection);
    
        if (! file_exists(APPLICATION_GLOBAL_CONF)) {
            render('You must be in the project root', 2);
            return false;
        }

        file_put_contents(APPLICATION_GLOBAL_CONF, $connection);
        
        render("Connection successuful");
    }
}   
