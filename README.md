# UniDev ShortLink —— 轻量级短链生成工具
## 使用须知
### 目录存放
在本项目中，请您把一整个源码文件存放入您想要的客户区站点目录中，并且将您希望生效的短链母域名指向此目录下的site目录
### 修改站点配置文件
<b>！本项目默认已添加.htaccess文件，一般无需重新配置，如果出现问题，请根据下文逐步配置</b><br/>
请修改您服务器指向本项目站点的配置文件<br/>
如果您使用的是Apache，请在.htaccess文件修改伪静态设置如下：
```C
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^([^\.]+)$ $1.html [NC,L]
    RewriteRule ^([^\.]+)$ $1.php [NC,L]
</IfModule>
```
如果您使用的是Nginx，请在Nginx配置文件的Server中的location /添加如下配置：
```C
try_files $uri $uri.html $uri/ /index.php?$query_string;
```
配置结构应与此相同：
```C
 location / {
            index  index.html index.htm index.php l.php;
           autoindex  on;
           try_files $uri $uri.html $uri/ /index.php?$query_string;
        }
```
<b>注意：本项要求可以仅在指向site目录的短链母域名站点执行</b>
### 源码配置文件修改
请在本项目中找到config.php，并且修改其中的$URL变量，使其为您想要的短链母域名的值<br/>
同时，您也可以在site目录找到delete.php，修改其中的$correctPassword为您想要的删除系统登录密码
## 开始使用
访问您设置的客户区网址，即可开始生成短链！
