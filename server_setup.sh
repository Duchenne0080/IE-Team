#/bin/bash
#Author: Duchenne
#E-mail: zxcvbnm_33961@qq.com

echo "server set up......"
sudo -s
apt-get update
apt-get upgrade


echo "Install mysql server"
apt-get install mysql-server
echo "Mysql Server installed"

echo "Install apache2 server"
apt-get install apache2
echo "Apache server installed"

echo "Install PHP7.2 and other package set"
apt-get install php7.2
apt-get install php7.2-fpm
apt-get install php7.2-mysql
apt-get install php libapache2-mod-php
service apache2 restart

echo "Install Phpmyadmin"
apt-get install phpmyadmin php7.2-mbstring php7.2-gettext
ln -s /usr/share/phpmyadmin/ /var/www/html/
systemctl restart apache2

echo "Downloading Wordpress online"
wget https://wordpress.org/latest.zip
apt-get install unzip
unzip latest.zip
mv wordpress /var/www/html/

echo "Your wordpress url: your-ip/wordpress"
echo "e.g. 1.1.1.1/wordpress"
echo "Your Phpmyadmin url: your-ip/phpmyadmin"
echo "e.g. 1.1.1.1/phpmyadmin"


