<?php
namespace Core\Mvc;

use Core\Mvc\Router\Route;
use Phalcon\Mvc\Router as Prouter;

class Router extends Prouter
{
    /**
     * Adds a route to the router without any HTTP constraint
     *
     *<code>
     * $router->add('/about', 'About::index');
     *</code>
     *
     * @param string $pattern
     * @param string|array|null $paths
     * @param string|null $httpMethods
     * @return \Core\Mvc\Router\Route
     */
    public function add($pattern, $paths = null, $httpMethods = null)
    {
        //Every route is internally stored as a Phalcon\Mvc\Router\Route
        $route = new Route($pattern, $paths, $httpMethods);

        $this->_routes[] = $route;
        return $route;
    }

    /**
     * Handles routing information received from the rewrite engine
     *
     *<code>
     * //Read the info from the rewrite engine
     * $router->handle();
     *
     * //Manually passing an URL
     * $router->handle('/posts/edit/1');
     *</code>
     *
     * @param string|'' $uri
     * @throws Exception
     */
    public function handle($uri = '')
    {
        if (!$uri) {
            $uri = $this->getRewriteUri();
        }

        //Remove extra slashes in the route
        if ($this->_removeExtraSlashes === true) {
            $uri = self::phalconRemoveExtraSlashes($uri);
        }

        //Runtime variables
        $request = '';
        $currentHostName = '';
        $routeFound = false;
        $matches = '';
        $parts = array();
        $params = array();

        //Set status properties
        $this->_wasMatched = false;
        $this->_matchedRoute = '';

        $routes = (is_array($this->_routes) === true ? $this->_routes : array());

        //Routes are traversed in reversed order
        foreach ($routes as $route) {
            //Look for HTTP method constraints
            $methods = $route->getHttpMethods();
            if ($methods) {
                //Retrieve the request service from the container
                if (!$request) {
                    if (is_object($this->_dependencyInjector) === false) {
                        throw new Exception("A dependency injection container is required to access the 'request' service");
                    }

                    $request = $this->_dependencyInjector->getShared('request');
                    //@note no interface or object validation
                }

                //Check if the current method is allowed by the route
                if ($request->isMethod($methods) === false) {
                    continue;
                }
            }

            //Look for hostname constraints
            $hostname = $route->getHostname();
            if ($hostname) {
                //Retrieve the request service from the container
                if (!$request) {
                    if (is_object($this->_dependencyInjector) === false) {
                        throw new Exception("A dependency injection container is required to access the 'request' service");
                    }

                    $request = $this->_dependencyInjector->getShared('request');
                }

                //Check if the current hostname is the same as the route
                if (!$currentHostName) {
                    $currentHostName = $request->getHttpHost();
                }

                //No HTTP_HOST, maybe in CLI mode?
                if (!$currentHostName) {
                    continue;
                }

                //Check if the hostname restriction is the same as the current in the route
                if (strpos($hostname, '(') !== false) {
                    if (strpos($hostname, '#') === false) {
                        $hostname = '#^' . $hostname . '$#';
                    }

                    $matched = (preg_match($hostname, $currentHostName) == 0 ? false : true);
                } else {
                    $matched = ($currentHostName === $hostname ? true : false);
                }

                if ($matched === false) {
                    continue;
                }
            }

            //If the route has parentheses use preg_match
            $pattern = $route->getCompiledPattern();
            if (strpos($pattern, '^') !== false) {
                echo $pattern.'<br>';
                $routeFound = (preg_match($pattern, $uri, $matches) == 0 ? false : true);
            } else {
                $routeFound = ($pattern === $uri ? true : false);
            }

            //Check for beforeMatch conditions
            if ($routeFound === true) {
                $beforeMatch = $route->getBeforeMatch();
                if ($beforeMatch) {
                    //Check first if the callback is callable
                    if (is_callable($beforeMatch) === false) {
                        throw new Exception('Before-Match callback is not callable in matched route');
                    }

                    //Call the function
                    $routeFound = call_user_func_array($beforeMatch, array($uri, $route, $this));
                }
            }

            //Apply converters
            if ($routeFound === true) {
                //Start from the default paths
                $paths = $route->getPaths();
                $parts = $paths;

                //Check if the matches has variables
                if (is_array($matches) === true) {
                    //Get the route converters if any
                    $converters = $route->getConverters();
                    foreach ($paths as $part => $position) {
                        if (is_string($part) === false || $part[0] !== chr(0)) {
                            if (isset($matches[$position]) === true) {
                                $matchPosition = $matches[$position];

                                //Check if the part has a converter
                                if (isset($converters[$part]) === true) {
                                    $converter = $converters[$part];
                                    $parts[$part] = call_user_func_array($converter, $matchPosition);
                                    continue;
                                }

                                //Update the parts if there is no coverter
                                $parts[$part] = $matchPosition;
                            } else {
                                //Apply the converters anyway
                                if (isset($converters[$part]) === true) {
                                    $converter = $converters[$part];
                                    $parts[$part] = call_user_func_array($converter, array($position));
                                }
                            }
                        }
                    }

                    //Update the matches generated by preg_match
                    $this->_matches = $matches;
                }
                $this->_matchedRoute = $route;
                break;
            }
        }

        //Update the wasMatched property indicating if the route was matched
        $this->_wasMatched = ($routeFound === true ? true : false);

        //The route wasn't found, try to use the not-found paths
        if ($routeFound !== true) {
            if ($this->_notFoundPaths) {
                $parts = $this->_notFoundPaths;
                $routeFound = true;
            }
        }

        //Check route
        if ($routeFound === true) {
            //Check for a namespace
            if (isset($parts['namespace']) === true) {
                if (is_numeric($parts['namespace']) === false) {
                    $this->_namespace = $parts['namespace'];
                }
                unset($parts['namespace']);
            } else {
                $this->_namespace = $this->_defaultNamespace;
            }

            //Check for a module
            if (isset($parts['module']) === true) {
                if (is_numeric($parts['module']) === false) {
                    $this->_module = $parts['module'];
                    unset($parts['module']);
                } else {
                    $this->_module = $this->_defaultModule;
                }
            }

            //Check for exact controller name
            $exactStrIdentifer = chr(0) . 'exact';
            if (isset($parts[$exactStrIdentifer]) === true) {
                $this->_isExactControllerName = $parts[$exactStrIdentifer];
                unset($parts[$exactStrIdentifer]);
            } else {
                $this->_isExactControllerName = false;
            }

            //Check for a controller
            if (isset($parts['controller']) === true) {
                if (is_numeric($parts['controller']) === false) {
                    $this->_controller = $parts['controller'];
                }
                unset($parts['controller']);
            } else {
                $this->_controller = $this->_defaultController;
            }

            //Check for an action
            if (isset($parts['action']) === true) {
                if (is_numeric($parts['action']) === false) {
                    $this->_action = $parts['action'];
                }
                unset($parts['action']);
            } else {
                $this->_action = $this->_defaultAction;
            }

            //Check for parameters
            $params = array();
            if (isset($parts['params']) === true) {
                $paramStr = (string) substr($parts['params'], 1, 0);
                if (empty($paramStr) === false) {
                    $params = explode($paramStr, '/');
                }

                unset($parts['params']);
            }

            if (empty($params) === false) {
                $params = array_merge($params, $parts);
            } else {
                $params = $parts;
            }

            $this->_params = $params;
        } else {
            //Use default values if the route hasn't matched
            $this->_namespace = $this->_defaultNamespace;
            $this->_module = $this->_defaultModule;
            $this->_controller = $this->_defaultController;
            $this->_action = $this->_defaultAction;
            $this->_params = $this->_defaultParams;
        }
    }
    /**
     * Removes slashes at the end of a string
     */
    private static function phalconRemoveExtraSlashes($str)
    {
        if (is_string($str) === false) {
            return '';
        }

        if ($str === '/') {
            return $str;
        }

        return rtrim($str, '/');
    }
}
