sudo apt-get install apache2
sudo apt-get install git
sudo apt-get install mysql-server
sudo apt-get install php5 libapache2-mod-php5
sudo apt-get install php5-mysql
sudo /etc/init.d/apache2 restart
php -r 'echo "\n\nYour PHP installation is working fine.\n\n\n";'

cd ~

echo "Cloning git into home directory"
git clone https://github.com/ash-21/aaa.git
