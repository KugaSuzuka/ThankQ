#!/bin/sh

BACKEND_PATH=$(cd $(dirname $0) && pwd)

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "${BACKEND_PATH}:/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
