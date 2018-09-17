# Sample Laravel Project

## Laravel Project From Scratch Guide - Kevin Chow 2018-09-16

Before you setup a new Laravel project, we need to setup a local PHP environment,
which will be required for local testing/installation. Laravel has its own built in
CLI web server; however, I think it's good practice to learn how to set up Apache Web Server
which you will need anyways to make sure your PHP version has been configured correctly.
Once this is done, then we will configure our Laravel development environment using Composer
package manager and establish a DB connection to our basic web app from a local MySQL Database.

## Setup guide

1. Download a copy of the newest stable version of PHP (7.2.10)
    -the windows VC15 x64 Thread Safe version, along with other versions is found at:
    https://windows.php.net/download/

2. We need to download Apache web server to create our local PHP web server. Use this tutorial:
    https://www.sitepoint.com/how-to-install-apache-on-windows/

    **Note1:** The file lines are different for the latest Apache version (2.4.34) but just use
    a search command to file the right config lines. The most important thing here is defining
    your ROOT path correctly in conf/ini files and in your path env variable

    **Note2:** To start/stop your Apache server, run the httpd -k start/stop command from your
    \Apache24\bin folder. This should be the same directory you ran your install command

    If this tutorial is done correctly, you should see a "Apache is working!" message on
    http://localhost/

3. I used this tutorial to configure my PHP, you should also follow this one:
    https://www.sitepoint.com/how-to-install-php-on-windows/

    **Note1:** When you enable extensions, uncomment extension=fileinfo, this is needed for Laravel install
    You can also enable extension=openssl in case we need this later for web portal security
    Also you can edit your sendmail_from config, which may be helpful for testing

    **Note2:** When configuring PHP with Apache, the Apache conf file has been renamed httpd.conf
    and is found in the ./conf folder

    **Note3:** Since we are loading PHP7 module in Apache, the configs should be modified to match
    the updated php7 syntax. Here is what mine looks like as an example:

    > \# PHP7 module
    > LoadModule php7_module "C:/Program Files/php/php7apache2_4.dll"
    > AddType application/x-httpd-php .php
    > PHPIniDir "C:/Program Files/php"

    If this tutorial is done correctly, you should see the PHP info page on
    http://localhost/ with the header "PHP Version 7.2.10"

4. To configure Laravel, we will install Composer package manager. Download the setup.exe file here:
    https://getcomposer.org/download/
    -Make sure the CLI-PHP php.exe matches the one we installed earlier

5. I used the tutorial here: https://laravel.com/docs/5.7. You can follow along to get your Laravel running.

    1. Download the Laravel installer using Composer using this command:
     composer global require "laravel/installer"

    2. Run the "php artisan serve" command to turn on your local Laravel web server.
    If everything has been configured correctly, you should see the project appear at http://localhost:8000/
    