# ZF2 Tool
#
In the last version of zf2 we have modules, and this modules are plugable. 

This tool is about create new project from bash, and add new modules, and maybe scaffolding. 

For a better use add the zftool folder to $PATH and give execution permissions to zf.php

## You can

### Create a project

    zf.php create project projectName

### Modules 

Inside the project folder


### Create new module

    zf.php create module moduleName


### Show actived modules
    zf.php show module


### Add Db Connection
    zf.php conn db Pdo mydb myhost myuser mypassword


### Add Controllers
    zf.php create controller ModuleName NewControllerName
