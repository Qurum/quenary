#!/bin/bash

composer dump-autoload --optimize --no-dev
mkdir -p /app/tmp
php /app/example/build.php