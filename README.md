# 欢迎使用Tolowan

------

是基于Phalcon开发的内容管理系统。ps：现在程序并未完善，仅供把玩，请勿用于生产环境
特性：

> * 继承Phalcon框架全功能
> * 多网站支持，异站点用户文件、同网站私有/共有网站隔离
> * 强大的个性化环境，每个用户可以对网站内容和表现形式进行个性化设置
> * 基于用户角色、模块、角色的权限控制系统，当然，您也可以通过回调函数进行更精细控制
> * 提供的站内搜索系统原生支持全文搜索。
> * 使用volt编写主题模板，类twig语法，单比twig更高效
> * Tolowan提供的实体管理、字段管理、表单管理、模型管理等机制，可以大大缩减二次开发的难度和所需时间

------

## 安装phalcon

前往phalcon官网按步骤安装phalcon扩展：https://phalconphp.com/zh/download

## 安装Tolowan

下载安装包解压至web目录

### 1. 修改site.php文件

编辑siteroot/Web/site.php文件，将需要绑定的域名根据文件中格式录入

### 2. 复制public目录

例如在第一步中，我们录入的域名为：baidu.com -> Baidu ,我们则需要将siteroot/public目录复制为siteroot/Baidu 注意：首字母必须未大写

### 3. 复制site/default目录

例如在第一步中，我们录入的域名为：baidu.com -> Baidu ,我们则需要将siteroot/Web/default目录复制为siteroot/Web/Baidu 注意：首字母必须未大写

### 4. 绑定域名 

根据上文设置，以apache服务器为例，需要进行如下设置

    <VirtualHost *:80>
    DocumentRoot siteroot/Baidu
    ServerName baidu.com
    </VirtualHost>

> 注：其中上文中siteroot为程序目录所在地址，QQ交流群：574199144
