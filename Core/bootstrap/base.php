<?php
use Core\Config;
use Core\Flash;
use Core\Mvc\Application;
use Core\Mvc\View;
use Core\Security;
use Core\Volt\ViewFunctionExtension;
use Phalcon\Cache\Backend\File as FileBackend;
use Phalcon\Cache\Frontend\Output as OutputFrontend;
use Phalcon\Crypt;
use Phalcon\Di\FactoryDefault;
use Phalcon\Flash\Session as Sflash;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Session\Adapter\Files as Session;

define('WEB_CODE', $site[$_SERVER['HTTP_HOST']]);
define('ROOT_DIR', __DIR__ . '/../../');
define('MODULES_DIR', ROOT_DIR . 'Modules/');
define('THEMES_DIR', ROOT_DIR . 'Themes/');
define('WEB_DIR', ROOT_DIR . WEB_CODE . '/');
define('CACHE_DIR', ROOT_DIR . 'Web/' . WEB_CODE . '/cache/');
define('CONFIG_DIR', ROOT_DIR . 'Web/' . WEB_CODE . '/config/');
define('DOWNLOAD_DIR', ROOT_DIR . 'Web/' . WEB_CODE . '/cache/download/');
// 初始化设置组件
$config = Config::get('config');
define('ADMIN_PREFIX', $config['adminPrefix']);
define('DEBUG', $config['debug']);
// 是否在开发者模式下运行
if (DEBUG == true) {
    ini_set("display_errors", "On");
    error_reporting(E_ALL | E_STRICT);
}

date_default_timezone_set($config['timezone']);
$di = new FactoryDefault();
$di->setShared('translate', 'Core\Translate');
$di->setShared('eventsManager', 'Phalcon\Events\Manager');
// 注册数据库服务
$di->setShared('db', function () use ($config) {
    $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['db']['adapter'];
    unset($config['db']['adapter']);
    $db = new $dbClass($config['db']);
    return $db;
});

// 实例化路由
$router = new Router(false);
$router->setDefaults(array(
    'namespace' => 'Modules\Core\Controllers',
    'module' => 'Core',
    'controller' => 'Index',
    'action' => 'Index',
));
$router->notFound(array(
    'namespace' => 'Modules\Core\Controllers',
    'module' => 'Core',
    'controller' => 'Index',
    'action' => 'NotFound',
));
// 加载路由和命名空间
$routes = Config::cache('routes');
//Config::printCode($routes);
$translate = Config::get('translate');
foreach ($routes as $key => $route) {
    if ($key == 'index') {
        $router->add($route['pattern'], $route['paths'], $route['httpMethods'])->setName($key);
        $route['pattern'] = '/{language:([a-z]{2})}';
        //Config::printCode($route);
        $key = $key . 'Language';
    } else {
        if ($translate['translate'] && $translate['translate_type'] == 2) {
            $route['pattern'] = '/{language:([a-z]{2})}' . $route['pattern'];
        }
    }
    $router->add($route['pattern'], $route['paths'], $route['httpMethods'])->setName($key);
}
$router->removeExtraSlashes(true);
$di->setShared('router', $router);
$di->setShared('assets', 'Core\Assets\Manager');
// 注册数据库服务
// Set the views cache service
$di->set('viewCache', function () {

    // Cache data for one day by default
    $frontCache = new OutputFrontend(
        array(
            "lifetime" => 864000,
        )
    );

    // Memcached connection settings
    $cache = new FileBackend(
        $frontCache,
        array(
            'cacheDir' => CACHE_DIR . 'view/',
        )
    );

    return $cache;
});
// 注册session服务
$di->setShared('session', function () {
    $session = new Session();
    $session->start();
    return $session;
});
// 註冊消息提醒服務
$di->setShared('flashSession', function () {
    return new Sflash(array(
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
});

// 实例化view服务
$view = new View();

// 注册加密组件
$di->setShared('crypt', function () use ($config) {
    $crypt = new Crypt();
    // 设置全局加密密钥
    $crypt->setKey($config['cryptEncode']);
    return $crypt;
});
$volt = new Volt($view, $di);
$volt->setOptions(array(
    'compiledPath' => __DIR__ . '/../../Web/' . WEB_CODE . '/cache/volt/',
));
$viewstags = Config::cache('viewTags');
$compiler = $volt->getCompiler();
$compiler->addExtension(new ViewFunctionExtension());
if ($viewstags) {
    foreach ($viewstags as $vKey => $vValue) {
        if ($vValue['type'] == 'extension') {
            $compiler->addExtension(new $vValue['function']());
        } elseif ($vValue['type'] == 'function') {
            $compiler->addFunction($vKey, function ($resolvedArgs, $exprArgs) use ($vValue) {
                return $vValue['fun'] . '(' . $resolvedArgs . ')';
            });
        } elseif ($vValue['type'] == 'anonymous_filter') {
            $compiler->addFunction($vKey, function ($resolvedArgs, $exprArgs) use ($vValue) {
                return $vValue['function']($resolvedArgs, $exprArgs);
            });
        } elseif ($vValue['type'] == 'filter') {
            $compiler->addFilter($vKey, $vValue['function']);
        }
    }
}
// 注册volt服务
$di->set('volt', $volt);

$eventsManager = $di->getShared('eventsManager');

// 注册模型管理服务

$modulesList = Config::get('modules');

// 注册消息提醒服务
$di->setShared('flash', function () {
    return new Flash(array(
        'error' => 'alert alert-danger',
        'success' => 'alert alert-success',
        'notice' => 'alert alert-info',
    ));
});

$di->setShared('view', $view);
$di->setShared('url', 'Core\Mvc\Url');

$di->setShared('request', 'Phalcon\Http\Request');
$di->setShared('response', 'Phalcon\Http\Response');
$di->setShared('cookies', 'Phalcon\Http\Response\Cookies');
$di->setShared('tag', 'Phalcon\Tag');
$di->setShared('filter', function () {
    $filter = new \Phalcon\Filter();
    $filter->add('commaExplode', function ($value) {
        return explode(',', $value);
    });
    $filter->add('semicolonExplode', function ($value) {
        return explode(';', $value);
    });
    return $filter;
});
$di->setShared('escaper', 'Phalcon\Escaper');
$di->setShared('annotations', 'Phalcon\Annotations\Adapter\Memory');
$di->setShared('modelsManager', 'Phalcon\Mvc\Model\Manager');
$di->setShared('modelsMetadata', 'Phalcon\Mvc\Model\MetaData\Memory');
$di->setShared('transactionManager', 'Phalcon\Mvc\Model\Transaction\Manager');
require_once __DIR__ . '/../common.php';
foreach ($modulesList as $value) {
    if (file_exists(__DIR__ . '/../../Modules/' . ucfirst($value) . '/Module.php')) {
        require_once __DIR__ . '/../../Modules/' . ucfirst($value) . '/Module.php';
    }
}
// 注册调度器服务
$security = new Security();
$di->setShared('security', $security);
$eventsManager->attach('dispatch', $security);
$dispatcher = new Dispatcher();
$dispatcher->setEventsManager($eventsManager);
$di->setShared('dispatcher', $dispatcher);
try {
    // 创建应用
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo $e->getMessage();
}
