#Doc install

sudo apt-get update
sudo apt-get install php-common php-mysql php-cli
php -v
sudo apt install mysql-server
sudo systemctl start mysql.service
sudo mysql -u root
sudo service mysql restart
sudo service apache2 restart
sudo apt install apache2
sudo service apache2 restart
mysql -V
wget https://get.symfony.com/cli/installer -O - | bash
mv /home/alexis/.symfony5/bin/symfony /usr/local/bin/symfony
sudo mv /home/alexis/.symfony5/bin/symfony /usr/local/bin/symfony
symfony 
sudo php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer
sudo apt install composer
sudo php composer-setup.php --install-dir=/usr/local/bin/ --filename=composer
symfony check:requirements
sudo apt install php-simplexml
symfony check:requirements

