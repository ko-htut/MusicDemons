<h1>LyricDB</h1>
This is an example of a Laravel project.

<h2>Run on a Raspberry Pi</h2>
<h3>Used hardware/software</h3>
<ul>
  <li>Raspberry Pi 3</li>
  <li>Micro-SD card (32 GB)</li>
  <li>Mobile phone charger</li>
  <li>Ethernet cable</li>
</ul>
<h3>Steps to execute</h3>
<h4>Preparing SD-card</h4>
<ol>
  <li>Start by downloading <a href="https://downloads.raspberrypi.org/raspbian_latest" target="_blank">the latest version of Raspbian</a></li>
  <li>When the download is complete, extract the ZIP-file</li>
  <li>Next, run <a href="https://sourceforge.net/projects/win32diskimager/" target="_blank">Win32DiskImager</a> as administrator</li>
  <li>Click on the browse-button next to the textbox and select the extracted *.img-file</li>
  <li>Select, if necessary, the proper disk in the <b>Device</b>-dropdown</li>
  <li>Start writing the Raspbian image to the SD-card by clicking the <b>Write</b>-button</li>
  <li>When the operation is complete, open the SD-card in the <b>Windows Explorer</b></li>
  <li>Create a file with the name <b>ssh</b> directly on the SD-card. The content doesn't matter</li>
</ol>
<h4>Wire-up</h4>
<ol>
  <li>Put your SD-card in the Raspberry Pi</li>
  <li>Connect your Raspberry Pi to your internet router at home, using the ethernet-cable</li>
  <li>Finally power-up your Raspberry Pi</li>
</ol>
<h4>Find IP-address</h4>
<ol>
  <li>There isn't a noob-proof way to find your pi's IP-address. If you don't know about networking, I'd suggest downloading an <a href="https://www.advanced-ip-scanner.com/news/" target="_blank">IP-scanner</a></li>
  <li>Start a scan and search for a device with a MAC-address which starts with <b>B8:27:EB</b>
</ol>
<h4>Installation MobaXterm</h4>
MobaXterm is a free application that allows you to connect to a server through FTP, SSH, SFTP, ...
<br>
<a href="https://mobaxterm.mobatek.net/download.html" target="_blank">Download MobaXterm</a>
<h4>Basic setup of the Raspberry Pi</h4>
<ol>
  <li>Start MobaXterm and click on the Session-button</li>
  <li>In the dialog choose for SSH, and enter the IP-address of your Raspberry Pi in the <b>Remote host</b> box and <b>pi</b> in the <b>username</b> box</li>
  <li>The SSH-prompt requests a password. The default password for the pi-user is <b>raspberry</b></li>
  <li>Moba proposes to remember the password. Postpone this until you've set a new password</li>
  <li>Start by changing the password:
    
```
sudo passwd pi
```

  </li>
  <li>Enter a new password and confirm it</li>
  <li>Set the timezone-data for the device:
  
```
sudo dpkg-reconfigure tzdata
```

  </li>
  <li>Update the package-repository. Next, update the installed packages:
  
```
sudo apt-get update && sudo apt-get -y upgrade
```

  </li>
  <li>Update Raspbian. Next, choose to restart the Raspberry Pi:
  
```
sudo rpi-update
```

  </li>
  <li>Install the Apache-webserver. This software allows us to host websites:
  
```
sudo apt-get -y install apache2
```

  </li>
  <li>Install PHP7 and the module to Apache2. This software allows us to use server-side scripting when handling webrequests:
  
```
sudo apt-get -y install php7.0 libapache2-mod-php7.0
```

  </li>
  <li>Install MySQL-server and the module to PHP7. This software allows us to host databases and access the databases from PHP.
  
```
sudo apt-get -y install mysql-server mysql-client php7.0-mysql
```

  </li>
  <li>Install PHPMyAdmin. This software allows us to manage the databases on the SQL-server through a webinterface.
  
```
sudo apt-get -y install phpmyadmin
```

  </li>
  <li>At last, we'll need Composer. This is a dependency-manager that allows us to pull Laravel and automatically install the required packages. Note: Composer is only available in the apt-get repository starting from Raspbian Stretch. If you use older versions of Raspbian, you'll have to use <a href="http://getcomposer.org">getcomposer.org</a>.
  
```
sudo apt-get -y install composer
```

  </li>
  <li>Now we're going to configure everything</li>
</ol>
<h4>Create an SQL-user</h4>
<ol>
  <li>Log in as root sql-user:

```        
sudo mysql -u root
```

  </li>
  <li>Create a new user (I called him <b>pi</b> as well). Replace <b>password</b> with a password of your choice:

```        
CREATE USER 'pi'@'localhost' IDENTIFIED BY 'password';
```

  </li>
  <li>Allow your new SQL-user to do anything:

```        
GRANT ALL PRIVILEGES ON *.* TO 'pi'@'localhost';
```

  </li>
  <li>Reload the priviliges:

```        
FLUSH PRIVILEGES;
```

  </li>
  <li>Exit the SQL command prompt:
        
```        
exit
```

  </li>
  <li>Restart the SQL-server:
        
```        
sudo service mysql restart
```

  </li>
  <li>To hide the unimportant databases in PHPMyAdmin, modify this file:
        
```        
sudo nano /etc/phpmyadmin/config.inc.php
```

  </li>
  <li>Add following line in the appropriate position (you'll see where). Save and exit (ctrl+O &#8594; Enter &#8594; ctrl+X):
        
```        
$cfg['Servers'][$i]['hide_db'] = 'information_schema|performance_schema|mysql|phpmyadmin';
```

  </li>
</ol>
<h4>Configure FTP:</h4>
<ol>
  <li>Become the owner of the webfolder:

```        
sudo chown -R pi /var/www
```

  </li>
  <li>Install vSFTPd:

```        
sudo apt-get -y install vsftpd
```

  </li>
  <li>Modify the configuration file:

```        
sudo nano /etc/vsftpd.conf
```

  </li>
  <li>Change write_enable=NO to:

```        
write_enable=YES
```

  </li>
  <li>Add this line at the end of the file:

```        
force_dot_files=YES
```

  </li>
  <li>Save and exit (ctrl+O &#8594; Enter &#8594; ctrl+X)</li>
  <li>Restart vSFTPd:

```        
sudo service vsftpd restart
```

  </li>
  <li>Create a softlink to the webfolder in your home-directory:

```        
ln -s /var/www ~/www
```

  </li>
</ol>
<h4>NPM</h4>
<ol>
  <li>Install the node-package-manager:

```        
sudo apt-get -y install npm
```

  </li>
  <li>Sadly this probably installed node-legacy. Uninstall nodejs and add the correct debian package to the apt-get repository. Finally install this version:

```        
sudo apt-get -y remove nodejs
curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
sudo apt-get -y install nodejs
```

  </li>
  <li>Finally, install dh-autoreconf

```        
sudo apt-get -y install dh-autoreconf
```

  </li>
</ol>
<h4>Clone the LyricDB repository</h4>
<ol>
  <li>Go to the webfolder:

```        
cd /var/www
```

  </li>
  <li>Remove the testsite:

```        
sudo rm -R html
```

  </li>
  <li>Clone the source code for LyricDB:

```        
git clone https://github.com/PieterjanDeClippel/LyricDB
```

  </li>
  <li>Go to the folder:

```        
cd LyricDB
```

  </li>
  <li>Install the required packages:

```        
composer install
```

  </li>
  <li>Copy the example .env-file. This file contains any configuration about the environment (passwords, ...):

```        
cp .env.example .env
```

  </li>
  <li>Edit the file:

```        
sudo nano .env
```

  </li>
  <li>Set <b>APP_NAME, APP_URL (http://[your-ip-address]), DB_DATABASE (LyricDB), DB_USERNAME (pi), DB_PASSWORD (your sql-password)</b> to the proper values</li>
  <li>Save and exit nano (ctrl+O &#8594; Enter &#8594; ctrl+X)</li>
  <li>Generate an application key:

```        
php artisan key:generate
```

  </li>
  <li>Create the database. Log in into the SQL command prompt:

```        
sudo mysql -u root
CREATE DATABASE LyricDB;
exit;
```

  </li>
  <li>Install the database. This may take some time:

```        
php artisan migrate
```

  </li>
  <li>In the latest version of Raspbian, the rewrite module is probably disabled. To enable mod-rewrite, run:

```        
sudo a2enmod rewrite
```

  </li>
  <li>Also in the latest version of Apache, there's a big chance Apache doesn't allow rewriting for the webfolder. Check the following file:

```        
sudo nano /etc/apache2/apache2.conf
```

  </li>
  <li>Ensure <b>AllowOverride</b> is set to <b>All</b>:

```        
<Directory /var/www/>
	Options Indexes FollowSymLinks
	AllowOverride All
	Require all granted
</Directory>
```

  </li>
  <li>Restart Apache:

```        
sudo systemctl restart apache2
```

  </li>
  <li>Create a new site by first copying the default VirtualHost-file:

```        
cd /etc/apache2/sites-available/
sudo cp 000-default.conf lyricdb.conf
```

  </li>
  <li>Modify the file. Change following settings:

```        
ServerName lyricdb
DocumentRoot /var/www/LyricDB/public
```

  </li>
  <li>Enable the site:

```        
sudo a2ensite lyricdb.conf
```

  </li>
  <li>Restart Apache:

```        
sudo systemctl reload apache2
```

  </li>
  <li>Change the owner of the <b>storage</b> folder:

```        
cd /var/www/LyricDB
sudo chown -R www-data:www-data storage
```

  </li>
  <li>Restart Apache:

```        
sudo systemctl restart apache2
```

  </li>
</ol>
<h4>Set hostname</h4>
At last, we can set a hostname for our Rapsberry Pi.
<ol>
	<li>Change the hostname-file:

```        
sudo nano /etc/hostname
```

	</li>
	<li>Put <b>lyricdb</b> in the file. Save and exit nano (ctrl+O &#8594; Enter &#8594; ctrl+X)</li>
	<li>Change the hosts-file:

```        
sudo nano /etc/hosts
```

	</li>
	<li>Modify the entry for <b>127.0.1.1</b>. Replace <b>localhost</b> with <b>lyricdb</b>. Save and exit nano (ctrl+O &#8594; Enter &#8594; ctrl+X)</li>
	<li>Install Samba and Winbind. This will ensure that the hostname is being broadcasted in the network:

```        
sudo apt-get -y install samba winbind
```

	</li>
	<li>Restart the Raspberry Pi:

```        
sudo reboot
```

	</li>
	<li>Now you can visit <a href="http://lyricdb" target="_blank">http://lyricdb</a> and you should see the Laravel website</li>
</ol>
