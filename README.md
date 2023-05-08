
# Project Title: Designing a User-friendly Software for CI/CD on the Cloud and Containers Environment

## Description

In this research project, we aim to explore how to design software that serves as an interface between end users and the infrastructure. Our goal is to create a tool that simplifies the process of deploying, managing, and monitoring containers in a cloud environment. By providing a user-friendly interface and automating complex tasks, we hope to enable more people to leverage the benefits of containerization and cloud computing.

## Installation

###

###

### PHP Composer
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

sudo mv composer.phar /usr/local/bin/composer
```

### Libraries
```
composer install
npm install
```

### Install Docker Engine

Follow the instruction in [Docker installation](https://docs.docker.com/engine/install/ubuntu/)

```
curl -fsSL https://get.docker.com -o get-docker.sh
sudo sh ./get-docker.sh --dry-run
```

### Install OpenLDAP

Follow tutorial in [OpenLDAP installation](https://www.openldap.org/doc/admin22/quickstart.html)


### Install Wetty

Project [Wetty](https://github.com/butlerx/wetty) is used to connect to a container terminal via browser

```
yarn global add wetty
```

