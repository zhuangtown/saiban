# test
saiban
http://qiita.com/yoshis2/items/a7eec8cc9b34d3fb3d38
用意した
composer.bat
composer.phar
httpd.conf
httpd-vhosts.conf
環境変数に
HTTP_PROXY = http://192.168.210.1:18080
HTTPS_PROXY = http://192.168.210.1:18080
PATH = c:\xampp\php
を登録

cd c:\xampp\htdocs
composer create-project --prefer-dist -s dev cakephp/app cake

cd c:\xampp\htdocs\cake
composer dumpautoload

session-viewlist
http://qiita.com/kazu56/items/a54596e963d9e2b71f2e
