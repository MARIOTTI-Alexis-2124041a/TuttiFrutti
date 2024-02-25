# Doc install

Here is the documentation to install the project on a **linux** machine.

## Requirements

First make sure you have the following requirements installed:
- PHP
- MySQL
- Apache
- Composer
- Symfony
- SimpleXML
- Git

if you don't have theses prerequisites installed, you can follow the following steps to install them.

### Install PHP
```bash
sudo apt-get update
sudo apt-get install php-common php-mysql php-cli
php -v
```

### Install MySQL
```bash
sudo apt install mysql-server
sudo systemctl start mysql.service
mysql -V
```

### Install Apache
```bash
sudo apt install apache2
sudo service apache2 restart
```

### Install Composer
```bash
sudo apt install composer
composer -v
```

### Install Symfony
```bash
wget https://get.symfony.com/cli/installer -O - | bash
//move the symfony file to the bin folder
mv /home/alexis/.symfony5/bin/symfony /usr/local/bin/symfony
```

### Install SimpleXML
```bash
sudo apt install php-simplexml
```

### Install Git
```bash
sudo apt install git
git --version
```

## Check the requirements

After installing all the prerequisites, you can check if everything is installed correctly by running the following command:
```bash
symfony check:requirements
```

if you have any missing requirements, you can install them by following the instructions given by the command.

## Install the project

Now that you have symfony and its prerequisites set up correctly, you can clone the project's git repository.
Before doing that, make sure you are in the directory where you want to clone the project.
As like every repository, you can clone it by running the following command:
```bash
git clone https://github.com/MARIOTTI-Alexis-2124041a/TuttiFrutti.git
```

Then you can move to the project's directory and install the dependencies by running the following command:
```bash
cd TuttiFrutti
composer install
npm install
npm run dev
```

The composer install command will install all the dependencies needed for the project to run correctly.

## Run the project

Now you can run this symfony project by using the following command:
```bash
cd ./web
symfony server:start
```

Once the server has started you can access the website via the url given by symfony in the console

The installation is now complete, you can now use the project on your linux machine.
If you have more questions about the project, you can contact me at : **alexis.mariotti@laposte.net** 