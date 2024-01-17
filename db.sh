#!/bin/bash

docker rm -f gochekdb
# Create a volume for the database
if [ ! "$(docker volume ls | grep mysql)" ]; then
    echo "Creating mysql volume..."
    docker volume create mysql
fi
# Start the database container
docker run -d -p 3307:3306 --name gochekdb -e MYSQL_DATABASE=laravel -e  MYSQL_ALLOW_EMPTY_PASSWORD=true -v mysql:/var/lib/mysql mysql:8.0.26
