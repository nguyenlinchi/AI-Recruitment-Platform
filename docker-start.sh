#!/bin/sh
set -e
php artisan config:clear
php artisan migrate --force
# Chỉ seed ở lần deploy đầu tiên: đặt RUN_SEED=true trên Render, xong thì xóa biến này
if [ "$RUN_SEED" = "true" ]; then
  php artisan db:seed --force                      # CareerSeeder
  php artisan db:seed --class=AdminSeeder --force  # tài khoản admin
fi
php artisan config:cache
php artisan route:cache || true
exec apache2-foreground