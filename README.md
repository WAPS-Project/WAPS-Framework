# WAPS Framework

<img src="https://raw.githubusercontent.com/WAPS-Project/WAPS-Framework/master/framework.src/content/img/waps.png" alt="FrameWork Logo" width="400" />

[![Generic badge](https://img.shields.io/badge/Lead_Developer-JosunLP-black.svg?style=for-the-badge&logo=github)](https://josunlp.de/)
[![Ask Me Anything !](https://img.shields.io/badge/Ask%20me-anything-1abc9c.svg?style=for-the-badge)](https://github.com/JosunLP)
[![license](https://img.shields.io/github/license/WebApp-PHP-Sample-Project/WepApp-PHP-Sample-Framework.svg?style=for-the-badge)](https://gitlab.com/webapp-php-sample/framework/blob/master/LICENSE)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg?style=for-the-badge)](https://github.com/WebApp-PHP-Sample-Project/WepApp-PHP-Sample-Framework/graphs/commit-activity)
[![GitHub release](https://img.shields.io/github/v/tag/WAPS-Project/WAPS-Framework.svg?style=for-the-badge&logo=github.svg?style=for-the-badge&logo=github)](https://github.com/WebApp-PHP-Sample-Project/WepApp-PHP-Sample-Framework/releases)
[![Generic badge](https://img.shields.io/badge/Made_with-PHP-blue.svg?style=for-the-badge)](https://www.php.net/)
[![Stars](https://img.shields.io/github/stars/WAPS-Project/WAPS-Framework?style=for-the-badge)](https://github.com/WAPS-Project/WAPS-Framework)
[![Vulnerabilities](https://img.shields.io/snyk/vulnerabilities/github/WebApp-PHP-Sample-Project/WepApp-PHP-Sample-Framework.svg?style=for-the-badge)](https://app.snyk.io/org/webapp-php-sample-project)
[![Documentation](https://img.shields.io/badge/Documentation-Waps--Framework.info-green.svg?style=for-the-badge)](http://waps-framework.info/)

### A PHP web app framework.

It's designed to make small future projects faster and easier. This entire framework has emerged as a learning project and is being continuously developed.

## Setup

- [Dependencies](#dependencies)
    - [Server](#server)
        - [Web Server](#web-server)
        - [Database Server](#database-server)
    - [Packet management](#packet-management)
        - [NPM](#npm)
- [Set up a project](#set-up-a-project)
- [Wiki](#Wiki)

## Dependencies
### Server
#### Web Server

This framework was developed on the basis of the Apache web server. Nevertheless, it is possible with slight modifications,
It also operate on a NGINX web server. But in contrast to the supplied htaccess file, changes to the
NGINX config necessary. Everything necessary for this is explained below.

##### Apache
As long as only one Apache web server is used, the project can be used without adjustments.

##### NGINX
For the operation of the framework under NGINX the following changes have to be made to the nginx config!

    autoindex off;

    error_page 500 /Error_500;

    error_page 404 /Error_404;

    error_page 403 /Error_403;

    location ~ /?\.htaccess$ {
      return 403;
    }

    location ~ ^/?config/config\.json$ {
      return 403;
    }

    location ~ ^/?config/plugin\.config\.json$ {
      return 403;
    }

    location / {
      rewrite ^(.*)$ https://$http_host/$1 redirect;
      if (!-e $request_filename){
        rewrite ^/([\w]+)? /index.php?pagename=$1;
      }
    }

 It replaces the corresponding part that would otherwise be set by the htaccess.

#### Database Server
A MySql server was used to develop the framework, but it is no problem to use MariaDB as an alternative. For other database systems, slight changes have to be made to the framework.

### Packet management

#### NPM
To manage the CSS, JS and TS scripts, the framework uses the NODE Package Manager. To work with the framework, the instalation of the same is necessary.

After installation, first execute the command ```npm install``` in the project folder.

That should install all needed packages.

## Set up a project
To set up a project, all servers named above must be available, a web server and a database server.
At the start of the project, the corresponding access data of the database must be entered in the Config. This can be found in the path ```./config/config.json```

Likewise, all other important data must be entered in the config. This can also be expanded flexibly. All new entries automatically become uppercase constants.

In addition, it is possible to install extensions in the area of plugins. These can be developed separately from projects and then integrated. The path in which plugins must be inserted is ```./custom/plugin/```

### Creating new Pages/Classes
#### Page

To create a new page, simply create a new file after the schema fileName_page_php in folder ```./page/open/```

The File Head of the new page must look like this:

    1 <?php
    2
    3 /*
    4 PageInfo:
    5 Title: true;
    6 */

The title tag can be used to specify whether a header should be generated automatically.

At the same time, menu entries are automatically generated from the pages in the "open" folder.

#### Class

To create a new class, it must be created in the ```./class``` folder. Classes are loaded automatically, it is not necessary to do anymore. The namespace of the classes is ```webapp_php_sample_class```.


#### Wiki
You can find more details about the framework in the -> [Wiki](https://waps-framework.info)
