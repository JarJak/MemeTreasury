MemeTreasury
============
(todo: travis, scrutinizer)

[![Build Status](https://travis-ci.org/JarJak/memy.svg?branch=master)](https://travis-ci.org/JarJak/memy)
[![Build Status](https://scrutinizer-ci.com/g/JarJak/memy/badges/build.png?b=master)](https://scrutinizer-ci.com/g/JarJak/memy/build-status/master)

Prerequisites
-------------
What you need to run app:

 - php7
 - mariadb
 - composer

Instantiation
-------------
After cloning repo to your phpStorm, add Symfony plugin:

File->settings->plugins->more->symfony

Directory structure
-------------------
you can configure it in phphStorm as follows:

source: src/

resources: web/

excluded: var/, .idea/

console scripts: bin/

Database
--------
You need to create your local mariadb database. Default config params are:

host: localhost

user: meme

pass: meme

db name: meme

If you want to use your own params, edit ```app/config/parameters/loc.yml``` file.

Installation
------------
Run deploy script:

```
sh deploy.sh
```

Check if you have everything that is needed:

```
php bin/symfony_requirements
```

Now the website should be available under ```http://localhost:8000/app_loc.php```

Tests
-----
Run tests:

```
php codecept run
```

Adding bundles/external libraries
---------------------------------
```
php composer require {vendor}/{lib_name}
```
