#!/bin/bash
/usr/local/bin/php /app/artisan optimize
/usr/local/bin/php /app/artisan config:cache
# uncomment di bawah ini jika
# sudah tidak diperlukan di production
/usr/local/bin/php /app/artisan migrate --force
/usr/local/bin/php /app/artisan db:seed --force
