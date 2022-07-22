#!/bin/bash

composer dump-autoload --optimize --no-dev
mkdir -p /app/tmp
php /app/build.php