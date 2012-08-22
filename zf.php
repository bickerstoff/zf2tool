#!/usr/bin/php
<?php
define('APPLICATION_CONF_FILE', 'config/application.config.php');
define('APPLICATION_GLOBAL_CONF', 'config/autoload/global.php');
try {
    $class = ucfirst($argv[2]);
    require_once __DIR__  . '/Modules/' . $class . '.php';
    $module = new $class();
} catch (Exception $e) {
    render($e->getMessage(), 2);
    render("We can't found the module " . $argv[1], 2);
}
$method = $argv[1];
$module->$method($argv);

echo "\n\n-------------------------\n";
echo "Complete\n";

function render($message, $type = 1)
{

    if ($type == 2) { 
        echo "\n-------------\n";
        echo "\n[error] $message\n";
        die("\n!!!! We found erros \n");
    } else {
        echo "\n[info] $message\n";
    }
}

