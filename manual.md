# create virtualhost php


installing tilde editor terminal
```
wget http://os.ghalkes.nl/sources.list.d/install_repo.sh ; sudo sh ./install_repo.sh ; sudo apt-get install tilde
```

create file for virtual host

```bash
sudo cp /etc/apache2/sites-available/tienda.com.conf /etc/apache2/sites-available/misite.com.conf
```

create VirtualHost

```apache
<VirtualHost *:80>

    ServerName localhost

    ServerAdmin webmaster@localhost
    DocumentRoot  /var/www/webroot

    <Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>

```

ejecute apache enable
```
sudo a2ensite misite.com.conf
sudo a2ensite test.com.conf

```

change window local host
```
C:\Windows\System32\drivers\etc\hosts
```


How to benchmark an HTTP/HTTPS service using AB (Apache Benchmark) command line tool
```
ab -n 20000 -c 150 http://misite.com/

bombardier -c 125 -n 20000 http://misite.com/


```