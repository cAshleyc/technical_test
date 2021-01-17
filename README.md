# KitchenCut Technical Test

### Author: Ashley Clark

This is my attempt at the technical test, as set out by KitchenCUT at  https://github.com/KitchenCut/technical_test

The solution is minimal, with a basic home page and two seperate pages, one for filtering the invoices for task 1, a
second for filtering by locations for task 2. Both sets of filters give a simple table of results, using the jQuery
DataTable plugin

#### My Approach

Whilst this test asks for an application which connects to a MySQL database, my approach is to create a simple Laravel
application. Whilst this is only a basic approach, I have chosen to take this, rather than overcomplicate it by
scaffolding it with a full implementation of docker containers, including MySQL, Composer, NGINX and PHP, as these are
already assumed by the client.

Whilst this means that I am not able to show you the full extent of what I would normally do during this, such as bash
scripting and docker set-ups, I believe this is not the requirements of this task. If you want to see the full project
set up, including the docker side and scripting, please contact me.

#### Setup Requirements Before Testing

Whilst the technical test requires the application to connect to a MySQL database, prior to testing, please ensure that
you change the MySQL connection settings in the .env file located in the root folder. Else, please deploy the
application to a webserver of your choosing with PHP 7.4 and composer installed, then run a composer install / update
from the root directory to ensure the latest version of all required dependencies are installed.

#### My Files

All my files are kept to a minimum, following standard industry practices.

Controllers:

- app\Http\ControllersInvoiceController.php
- app\Http\ControllersLocationController.php
- app\Http\ControllersRootController.php

Models:

- app\Models\InvoiceHeaders.php
- app\Models\InvoiceLines.php
- app\Models\Locations.php

Services:

- app\Services\Invoices.php

Resources:

- resources\views\includes\header.blade.php
- resources\views\layouts\default.blade.php
- resources\views\dashboard.blade.php
- resources\views\invoices.blade.php
- resources\views\locations.blade.php

Routes:

- routes\web.php
 

