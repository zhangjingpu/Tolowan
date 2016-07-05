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
测试通过phalcon版本：2.1.×

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

> 默认后台路径：domain.com/amdin/frame
> 默认登陆地址：domain.com/login.html
>
> 默认管理员账户：
> user：admin@admin.com
> password：guanliyuan


----------


> 注：其中上文中siteroot为程序目录所在地址，**[加入QQ交流群：574199144][1]**


----------


## 特性

### 实体（siteroot/Modules/Entity）

是具有相同功能的对象，在Tolowan中内置了三种实体类型：

 - 基于数据库模型的常规实体
 - 基于配置的配置实体
 - 基于配置列表的配置列表实体

例如，原生模块中，node、comment、user等模块是基于数据库模型的常规实体的实体对象；config是基于配置实体的实体对象；区域（region）、菜单（menu）是基于配置列表实体的实体对象。

> 不同的实体类型，决定了实体的保存、读取方式，但是所有实体都拥有统一的API，而定义实体，我们只需要完成实体声明数组文件和集成相应的基本实体模型即可，而实体的增、改、删、读等常规操作并不需要重新编写。

下面以node模块中的node实体为例：

 1. 在模块配置目录定义实体声明文件（siteroot/Modules/Node/config/entitys.php）
 2. 建立实体管理模型（集成基础实体管理模型类）：siteroot/Modules/Node/Entity/NodeManager.php
 3. 建立实体模型（集成基础实体模型类）：siteroot/Modules/Node/Entity/Node.php

> 2、3步的类文件可以随意在实体声明文件中制定

接下来就可以使用 adminEntity* 系列路由进行相关管理操作，当然你也可以替换/禁用这些默认操作(在此不详述)

### 字段

字段系统可以算是实体系统的一部分，通过它我们可以灵活的对实体进行无限制的模型扩充和灵活访问。

依旧以node实体进行操作示例：

    $nodeEntity = $this->entityManager->get('node');//获取node实体

    $node = $nodeEntity->findFirst(5, true);//获取ID为5的文章

    $nodeUser = $node->uid->user //获取文章作者的user实体

    $node -> delete(); //删除文章和相关所有字段

    $nodeUser->delete(); //删除文章作者


----------


### 配置(siteroot/Core/Config)

Tolowan直接以数组保存配置信息，当然使用前您需要通过命名空间引入该文件

    Config::get('config') //获取config配置

    Config::set('config',array())//设置配置内容

模块和主题下config目录为其配置目录，我们可以通过Config::cache()来获取某个配置的合集

> Config::cache('entitys');
> //合并所有已启用模块、主题config目录下entitys.php文件内容，这个合并操作在您清除配置缓存前只会进行一次


----------


### 表单

Tolowan直接通过数组来声明表单，我们也可以把数组保存在配置文件中，通过配置名来生成表单。

例如：siteroot/Modules/Search/config/searchForm.php 是声明的搜索表单，配置名为：search.searchForm （模块名+文件名），在模板中我们可以这么使用。

{{ form.create('search.searchForm') }} //在模板中就可以直接生成基于bootstarp的表单html（当然也可以替换成自己的模板，此处不详谈）

### 模型

Tolowan中，你可以通过数组的方式来构建查询，简单距离：

     <?php
    $query = array(
        'from' => 'node',
        'andWhere' => array(
            array(
                'conditions' => 'node.id < :id:',
                'bind' => array('id' => 50),
            ),
        ),
        'limit' => 15,
        'page' => 1,
        'paginator' => true,
    );
    Core\Db\Query::find($query);

上面的含义：查询node表中id字段值小于50的数据，且采用分页查询，每页获取15条记录，获取第一页数据


  [1]: http://shang.qq.com/wpa/qunwpa?idkey=0d7af0cd86e319424f9df2bb942c4ad124f587ea98e125631e57700f852fce5f