#/bin/bash
#Author: Duchenne
#E-mail: zxcvbnm_33961@qq.com

echo "server set up......"
echo `sudo -s`
echo `apt-get update`
echo `apt-get upgrade`


echo "Install mysql server"
echo `apt-get install mysql-server`
echo "Mysql Server installed"

echo "Install apache2 server"
echo `apt-get install apache2`
echo "Apache server installed"

echo "Install PHP7.2 and other package set"
echo `apt-get install php7.2`
echo `apt-get install php7.2-fpm`
echo `apt-get install php7.2-mysql`
echo `apt-get install php libapache2-mod-php`
echo `service apache2 restart`

echo "Install Phpmyadmin"
echo `apt-get install phpmyadmin php7.2-mbstring php7.2-gettext`
echo `ln -s /usr/share/phpmyadmin/ /var/www/html/`
echo `systemctl restart apache2`

echo "Downloading Wordpress online"
echo `wget https://wordpress.org/latest.zip`
echo `apt-get install unzip`
echo `unzip latest.zip`
echo `mv wordpress /var/www/html/`

echo "Your wordpress url: your-ip/wordpress"
echo "e.g. 1.1.1.1/wordpress"
echo "Your Phpmyadmin url: your-ip/phpmyadmin"
echo "e.g. 1.1.1.1/phpmyadmin"


