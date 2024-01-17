#!/bin/bash
docker rm -f gochek
docker build -t myapp .
# Volume mapping for composer packages
docker run -d --network "host" -v $(pwd):/var/www --name gochek myapp
docker exec -it gochek php artisan key:generate
docker exec -it gochek bash -c "echo '* * * * * /usr/local/bin/php /var/www/artisan schedule:run >> /var/log/cron.log 2>&1' | crontab -"
docker exec -d gochek bash -c "cron && php artisan serve --port 8000"
