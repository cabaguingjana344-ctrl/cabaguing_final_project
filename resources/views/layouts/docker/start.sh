set -e

PORT_TO_USE=${PORT_TO_USE:-80}
sed -i "s/Listen 80/Listen ${PORT_TO_USE}/g" /etc/nginx/conf.d/default.confsed
sed -i "s/:80/:$(echo ${PORT_TO_USE}) default_server/g" /etc/nginx/conf.d/default.confsed

php artisan storage:link || true
php artisan migrate --force || true
php artisan optimize

apache2-foreground