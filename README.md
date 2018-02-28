#准备

###安装composer
  composer install
 
###测试
  php ./tests/testProcess.php [code]
  
###运行服务器(root)
  sudo php -S 0.0.0.0:8080 -t public index.php
  or
  sudo php -S 0.0.0.0:8080 -t public ./public/index.php
  