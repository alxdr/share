NOTE: DO NOT JUST CLONE
ASSUMING YOU SAVED BITNAMI as bitnami
RUN THE FOLLOWING in bitnami/apache2/htdocs:
composer create-project laravel/laravel share
cd share
git init
git remote add origin https://github.com/alxdr/share.git
git remote -v
git stash save -u
git pull
git stash list
git stash pop
git status

CREATE VIRTUAL HOST:
edit bitnami/apache2/conf/bitnami/bitnami.conf
find the first <VirtualHost _default_:80>
append /share/public to DocumentRoot path
append /share/public to Directory path
comment out ErrorDocument
add a line "ErrorLog /path/to/share/storage/logs/error.log"
where path is the relative path to error.log

CHANGE PERMISSIONS (sudo if needed):
cd /path/to/share
chmod o+w storage/framework/cache
chmod o+w storage/framework/sessions
chmod o+w storage/framework/views
chmod o+w storage/logs

Go to localhost and check it is live locally.
