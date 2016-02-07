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

Installation
------------
Run deploy script:

```
sh deploy.sh
```

Open http://127.0.0.1:8000 and enjoy!

Problems?
---------
Check if you have everything that is needed:

```
php bin/symfony_requirements
```

Development
===========

Setup IDE
---------
After cloning repo to your phpStorm/webStorm, add Symfony plugin:

File->settings->plugins->more->symfony

Directory structure
-------------------
source: src/

resources: web/

excluded: var/, .idea/

console scripts: bin/

Tests
-----
Run tests with:

```
php codecept run
```

Adding bundles/external libraries
---------------------------------
```
php composer require {vendor}/{lib_name}
```