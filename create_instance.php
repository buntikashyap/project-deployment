<?php

`Install Apache` =>
    sudo apt-get update
    sudo apt-get upgrade
    sudo apt-get install apache2
    sudo systemctl start apache2
    sudo systemctl enable apache2
    sudo systemctl status apache2
    // sudo systemctl restart apache2
`Install php` => 
    sudo apt-get update
    sudo apt -y install software-properties-common
    sudo add-apt-repository ppa:ondrej/php  // ( Next, install the repository ppa:ondrej/php, which will give you all your versions of PHP:)sudo apt-get update
    sudo apt-get update // (Finally, you update apt-get again so your package manager can see the newly listed packages:)
    sudo apt -y install php7.4  // (it will ask some permission , hit enter buttton)
    php -v // (check php version)

    sudo apt-get install -y php7.4-cli php7.4-json php7.4-common php7.4-mysql php7.4-zip php7.4-gd php7.4-mbstring php7.4-curl php7.4-xml php7.4-bcmath // (install php version and ask for different persmission then enter)
    
`Php Configuration` => 
    sudo nano /etc/php/7.4/apache2/php.ini
    //changes this settings
    memory_limit  = 1G          
    upload_max_filesize   = 1G                        
    max_execution_time = 1200
    post_max_size = 1G
    
    sudo chmod 777 /var/www/html -R //Give permission 

    // If you want to check php info
    sudo systemctl restart apache2
    sudo nano /var/www/html/phpinfo.php
    /* <?php phpinfo();  */
    // Check in browser http://112.196.38.98/phpinfo.php

`Install mysql` => 

    // Link :- https://www.digitalocean.com/community/tutorials/how-to-install-mysql-on-ubuntu-22-04
    sudo apt update
    sudo apt install mysql-server
    sudo systemctl start mysql.service
    sudo mysql_secure_installation // This can be generate error (This will ask for password validation policy chosse 2 for high validation)
    /*

        Error may be come => ... Failed! Error: SET PASSWORD has no significance for user 'root'@'localhost' as the authentication method used doesn't store authentication data in the MySQL server. Please consider using ALTER USER instead if you want to change authentication parameters.
        if Error come then do
            sudo pkill -f mysql_secure_installation
            sudo mysql
            ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password by 'my-secret-password';
            exit
            sudo mysql_secure_installation // Run and complete steps of securing Mysql.
    */

    //After creating your new user, you can grant them the appropriate privileges. The general syntax for granting user privileges is as follows:
    // Create password for root login
    mysql -u root -p
    CREATE DATABASE test_database;
    


`Remove mysql setup`  => 
    sudo systemctl stop mysql
    sudo apt-get purge mysql-server mysql-client mysql-common mysql-server-core-* mysql-client-core-*
    sudo rm -rf /etc/mysql /var/lib/mysql

    sudo apt autoremove () // Optional
    sudo apt autoclean // Optional

    //We have install our php and mysql successfully and can check with Mysql workbench of filezilla or browser

`Give permission to write or access to https and http otherwise it will not access the project`
    
    sudo nano /etc/apache2/apache2.conf // We have to edit it's content
        '<Directory /var/www/>
			Options Indexes FollowSymLinks
			AllowOverride All
			Require all granted
		</Directory>'
        // instructions find /var/www/

    sudo a2enmod rewrite
    systemctl restart apache2
    sudo service apache2 restart



`Composer install` => 
	sudo apt-get install curl
	sudo curl -s https://getcomposer.org/installer | php
	sudo mv composer.phar /usr/local/bin/composer
	(restart terminal )
	composer (check composer version if now show composer)

`Git installed automatically`=> 
	git config --global user.name "test"
	git config --global user.email "test123@gmail.com"
    ssh-keygen // for generate ssh keys
	cat ~/.ssh/id_rsa.pub (Get SSH keys id of system and upload to github account)

    
        //try to clone if error is ssh: connect to host github.com port 22: Connection timed out
        /*
        sudo nano ~/.ssh/config
            '
                Host github.com
                Hostname ssh.github.com
                Port 443
            '
        ssh -T git@github.com // Not necessary
        */

	git config --global --add safe.directory '*' (if need , this will hide the fatal error or if will ask when taking pull)
    composer install
    // Now it may be run or not check web.php for URLForce or public folder or .htaccess file
    // Check project by enable APP_DEBUG=true in .env file

`Give permission to public folder to upload images`
    sudo chmod -R 777 public
    sudo chmod -R 777 storage

`Node Install` => 
    sudo apt install nodejs
    node -v
    sudo apt install npm
    npm -v

Check memory => 
	df -h


For cron => 
    sudo crontab -e
    * * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1 //(set the path at the bottom and check records entry in the table)

For Update Apache2 (if necessary) =>
    // Currently install 2.4.53 it will update latest version 2.4.54 
    apache2 -v
    sudo add-apt-repository ppa:ondrej/apache2 
    sudo apt update
    sudo apt install apache2
    apache2 -v



`DOWNGRADE PHP 8.0 to PHP 7.4` => 
    sudo update-alternatives --set php /usr/bin/php7.1

`Delete php version` => 
    sudo apt-get purge php7.*
    sudo apt-get autoclean
    sudo apt-get autoremove


`Apache2 remove` =>
    sudo apt remove --purge apache2
    sudo apt autoremove -y