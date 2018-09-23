# Sample Laravel Project From Scratch

## Kevin Chow 2018-09-16

Before you setup a new Laravel project, we need to setup a local PHP environment,
which will be required for local testing/installation. Laravel has its own built in
CLI web server; however, I think it's good practice to learn how to set up Apache Web Server
which you will need anyways to make sure your PHP version has been configured correctly.
Once this is done, then we will configure our Laravel development environment using Composer
package manager and establish a DB connection to our basic web app from a local MySQL Database.

## Setup guide

1. Download a copy of the newest stable version of PHP (7.2.10)

    -the windows VC15 x64 Thread Safe version, along with other versions is found at:
    https://windows.php.net/download/.

2. We need to download Apache web server to create our local PHP web server. Use this tutorial:
    https://www.sitepoint.com/how-to-install-apache-on-windows/

    **Note1:** Start at step 2 for the Apache tutorial.

    **Note2:** The file lines are different for the latest Apache version (2.4.34) but just use
    a search command to file the right config lines. The most important thing here is defining
    your ROOT path correctly in conf/ini files and in your path env variable.

    **Note3:** To start/stop your Apache server, run the httpd -k start/stop command from your
    \Apache24\bin folder. This should be the same directory you ran your install command.

    If this tutorial is done correctly, you should see a "Apache is working!" message on
    http://localhost/.

3. I used this tutorial to configure my PHP, you should also follow this one:
    https://www.sitepoint.com/how-to-install-php-on-windows/

    **Note1:** When you enable extensions, uncomment "extension=fileinfo", this is needed for Laravel install
    You can also enable T"extension=openssl" in case we need this later for web portal security
    Also you can edit your "sendmail_from" config, which may be helpful for testing.

    **Note2:** When configuring PHP with Apache, the Apache conf file has been renamed **httpd.conf**
    and is found in the ./conf folder.

    **Note3:** Since we are loading PHP7 module in Apache, the configs should be modified to match
    the updated php7 syntax. Here is what mine looks like as an example:

    > \# PHP7 module <br />
    > LoadModule php7_module "C:/Program Files/php/php7apache2_4.dll" <br />
    > AddType application/x-httpd-php .php <br />
    > PHPIniDir "C:/Program Files/php"

    If this tutorial is done correctly, you should see the PHP info page on
    http://localhost/ with the header "PHP Version 7.2.10".

4. To configure Laravel, we will install Composer package manager. Download the setup.exe file here:
    https://getcomposer.org/download/
    
    -Make sure the CLI-PHP php.exe matches the one we installed earlier.

5. I used the tutorial here: https://laravel.com/docs/5.7. You can follow along to get your Laravel running.

    1. Download the Laravel installer using Composer using this command:
     composer global require "laravel/installer".

    2. Now, create a new Laravel project using the command: laravel new projectName
    -If you clone this project, you will need to create your own .env file with your own app key by following these steps:
    https://stackoverflow.com/questions/38602321/cloning-laravel-project-from-github

    3. Run the "php artisan serve" command to turn on your local Laravel web server.
    If everything has been configured correctly, you should see the project appear at http://localhost:8000/.

6. We will need to setup a local MySQL database so we can develop using non-production data. Here is the download link:
    https://dev.mysql.com/downloads/mysql/

    -Create a default user named "root" to use for when we connect to our local database later.
    
    -I chose the MySQL Server Only download because I already have preferred MySQL clients, **DBeaver** (https://dbeaver.io/download/) and **HeidiSQL** (https://www.heidisql.com/download.php).
    I recommend HeidiSQL as a good starting DB client because it's relatively simple and quick to learn.

    **Important:** If you want to use a DB client besides MySQL Workbench then you **WILL** have issues setting up a connection to your local database.
    The 8.0.4 MySQL update changes the "default_authentication_plugin" setting to use the "caching_sha2_password" plugin which most DB clients do not support.
    In order to configure this correctly you will have to:

    1. Modify the "C:\ProgramData\MySQL\MySQL Server 8.0\my.ini" file to use the "default_authentication_plugin=mysql_native_password" setting. This will change the default configurations when a new MySQL instance is generated.

    2. Modify the default DB admin user that you created when installing MySQL by running this command in the MySQL command line client:
    
    > "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';"

    -The username and password will be your login credentials when you attempt to login to your local DB at default port 3306. 

    3. Restart your instance of MySQL by running the "net stop MySQL80" and "net start MySQL80" commands from your command line.
    MySQL80 is the default MySQL 8.0 naming convention for the windows web service background process, but may appear under a different name, so use whatever appears. 
    
    If this tutorial is done correctly, you should be able to successfully connect to your local MySQL DB from whatever DB client you are using.

7. All team members need a common local database schema to ensure that our data model is consistent. For this example we will download the MySQL demo **sakila** database:
    https://dev.mysql.com/doc/index-other.html

    -You can import this database into your local database by running the **sakila-schema.sql**, then **sakila-data.sql** files in the zip folder in HeidiSQL.

    If this is done correctly, clicking on the "Example" link on the project http://localhost:8000/ page should now display some of your local data!
