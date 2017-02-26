NOTE: DO NOT JUST CLONE

ASSUMING YOU SAVED BITNAMI as bitnami

RUN THE FOLLOWING in bitnami/apache2/htdocs:

composer create-project laravel/laravel share

cd share

git init

git remote add origin https://github.com/alxdr/share.git

git remote -v

git stash save -u

git pull origin master

git stash list

git stash pop

git status

CREATE .env.ini FILE:

edit .env to input your OWN DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD credentials

cp .env app/.env.ini

edit .env.ini

rm all lines except for DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD

CREATE VIRTUAL HOST:

edit bitnami/apache2/conf/bitnami/bitnami.conf

find the first <VirtualHost _default_:80>

append /share/public to DocumentRoot path

append /share/public to Directory path

comment out ErrorDocument

add a line "ErrorLog /path/to/share/storage/logs/error.log"

where path is the relative path to error.log

restart your apache server

CHANGE PERMISSIONS (sudo if needed):

cd /path/to/share

chmod o+w storage/framework/cache

chmod o+w storage/framework/sessions

chmod o+w storage/framework/views

chmod o+w storage/logs

Go to localhost and check it is live locally.
