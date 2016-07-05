<?php
namespace Core\Mvc\Router;

use Exception;
use Phalcon\Text;
use Phalcon\Mvc\Router\Route as Proute;

class Route extends Proute
{
    /**
     * Reconfigure the route adding a new pattern and a set of paths
     *
     * @param string $pattern
     * @param array|null|string $paths
     * @throws Exception
     */
    public function reConfigure($pattern, $paths = false)
    {

        $originalPattern = $pattern;

        if (is_string($paths)) {
            $moduleName = false;
            $controllerName = false;
            $actionName = false;

            //Explode the short paths using the :: separator
            $parts = explode('::', $paths);
            $numberParts = count($parts);

            //Create the array paths dynamically
            switch ($numberParts) {
                case 3:
                    $moduleName = $parts[0];
                    $controllerName = $parts[1];
                    $actionName = $parts[2];
                    break;
                case 2:
                    $controllerName = $parts[0];
                    $actionName = $parts[1];
                    break;
                case 1:
                    $controllerName = $parts[0];
                    break;
                    //@note no default
            }

            $routePaths = array();

            //Process module name
            if ($moduleName !== false) {
                $routePaths['module'] = $moduleName;
            }

            //Process controller name
            if ($controllerName !== false) {
                //Check if we need to obtain the namespace
                if (strpos($controllerName, '\\') !== false) {
                    $classWithNamespace = get_class($controllerName);

                    //Extract the real class name from the namespaced class
                    //Extract the namespace from the namespaced class
                    $pos = strrpos($classWithNamespace, '\\');
                    if ($pos !== false) {
                        $namespaceName = substr($classWithNamespace, 0, $pos);
                        $realClassName = substr($classWithNamespace, $pos);
                    } else {
                        $realClassName = $classWithNamespace;
                    }

                    //Update the namespace
                    if (isset($namespaceName) === true) {
                        $routePaths['namespace'] = $namespaceName;
                    }
                } else {
                    $realClassName = $controllerName;
                }

                //Always pass the controller to lowercase
                $realClassName = Text::uncamelize($realClassName);

                //Update the controller path
                $routePaths['controller'] = $realClassName;
            }

            //Process action name
            if ($actionName !== false) {
                $routePaths['action'] = $actionName;
            }
        } elseif (is_array($paths) === true) {
            $routePaths = $paths;
        } elseif ($paths === true) {
            $routePaths = array();
        } else {
            throw new Exception('The route contains invalid paths');
        }

        //If the route starts with '#' we assume that it is a regular expression
        if (Text::startsWith($pattern, '#') === false) {
            $pattern = preg_replace_callback('|\{([a-z]+?):([a-z]+?)\}|',array($this,'initPattern'),$pattern);
            if (strpos($pattern, '{') !== false) {
                //The route has named parameters so we need to extract them
                $pattern = self::extractNamedParameters($pattern, $routePaths);
            }

            //Transform the route's pattern to a regular expression
            $pattern = $this->compilePattern($pattern);
        }

        //Update member variables
        $this->_pattern = $originalPattern;
        $this->_compiledPattern = $pattern;
        //echo $this->_pattern.'<br>';
        $this->_paths = $routePaths;
    }
    public function initPattern($matches)
    {
        switch($matches[2]){
            case 'id':
                $newPattern = '([1-9]{1}[0-9]{0,11})';
                break;
            case 'machine':
                $newPattern = '([a-z\\_\\-]{2,})';
                break;
            case 'page':
                $newPattern = '([1-9]{1}[0-9]{0,11})';
                break;
            case 'config':
                $newPattern = '([a-z\\_\\-\\.]{2,})';
                break;
        }
        if(isset($newPattern)){
            return $newPattern;
        }
        return '{'.$matches[1].'}';
    }
    public function compilePattern($pattern)
    {
        if (is_string($pattern) === false) {
            throw new Exception('Invalid parameter type.');
        }

        $compiledPattern = $pattern;

        //If a pattern contains ':', maybe there are placeholders to replace
        if (strpos($pattern, ':') !== false) {
            //This is a pattern for valid identifers
            $idPattern = '/([a-zA-Z0-9\\_\\-]+)';

            //Replace the module part
            if (strpos($pattern, '/:module') !== false) {
                $compiledPattern = str_replace('/:module', $idPattern, $compiledPattern);
            }

            //Replace the controller placeholder
            if (strpos($pattern, '/:controller') !== false) {
                $compiledPattern = str_replace('/:controller', $idPattern, $compiledPattern);
            }

            //Replace the namespace placeholder
            if (strpos($pattern, '/:namespace') !== false) {
                $compiledPattern = str_replace('/:namespace', $idPattern, $compiledPattern);
            }

            //Replace the action placeholder
            if (strpos($pattern, '/:action') !== false) {
                $compiledPattern = str_replace('/:action', $idPattern, $compiledPattern);
            }

            //Replace the params placeholder
            if (strpos($pattern, '/:params') !== false) {
                $compiledPattern = str_replace('/:params', '(/.*)*', $compiledPattern);
            }

            //Replace the int placeholder
            if (strpos($pattern, '/:int') !== false) {
                $compiledPattern = str_replace('/:int', '/([0-9]+)', $compiledPattern);
            }
        }

        //Check if the pattern has parantheses in order to add the regex delimiters
        if (strpos($compiledPattern, '(') !== false ||
            strpos($compiledPattern, '[') !== false) {
            return '#^' . $compiledPattern . '$#';
        }

        return $compiledPattern;
    }
    private static function extractNamedParameters($str, &$matches)
    {
        if (is_string($str) === false ||
            strlen($str) <= 0 ||
            is_array($matches) === false) {
            return false;
        }

        $bracketCount = 0;
        $parenthesesCount = 0;
        $intermediate = 0;
        $numberMatches = 0;
        $regexpLength = 0;
        $notValid = false;
        $marker = null;
        $variable = null;
        $item = null;
        $regexp = null;
        $cursorVar = null;
        $routeStr = '';
        $cursor = 0;

        $l = strlen($str);
        for ($i = 0; $i < $l; ++$i) {
            $ch = $str[$i];

            if ($ch === "\0") {
                break;
            }

            if ($parenthesesCount === 0) {
                if ($ch === '{') {
                    if ($bracketCount === 0) {
                        $marker = $i;
                        $intermediate = 0;
                        $notValid = false;
                    }
                    ++$bracketCount;
                } elseif ($ch === '}') {
                    --$bracketCount;
                    if ($intermediate > 0) {
                        if ($bracketCount === 0) {
                            $numberMatches++;
                            $variable = null;
                            $length = $cursor - $marker - 1;
                            $item = substr($str, $marker + 1, $length);
                            $cursorVar = $marker + 1;
                            $marker = $marker + 1;
                            for ($j = 0; $j < $length; ++$j) {
                                $ch = $str[$cursorVar];
                                $cha = ord($ch);

                                if ($ch === "\0") {
                                    break;
                                }

                                if ($j === 0 && !(($cha >= 97 && $cha <= 122) || ($cha >= 65 && $cha <= 90))) {
                                    $notValid = true;
                                    break;
                                }

                                if (($cha >= 97 && $cha <= 122) || ($cha >= 65 && $cha <= 90) || ($cha >= 48 && $cha <= 57) || $ch === '-' || $ch === '_' || $ch === ':') {
                                    if ($ch === ':') {
                                        $regexpLength = $length - $j - 1;
                                        $variableLength = $cursorVar - $marker;
                                        $variable = substr($str, $marker, $variableLength);
                                        $regexp = substr($str, $cursorVar + 1, $regexpLength);
                                        break;
                                    }
                                } else {
                                    $notValid = true;
                                    break;
                                }

                                $cursorVar++;
                            }

                            if ($notValid === false) {
                                $tmp = $numberMatches;
                                if (isset($variable) === true) {
                                    if ($regexpLength > 0) {
                                        if ($regexp === null) {
                                            throw new Exception('Invalid assumption.');
                                        }

                                        //Check if we need to add parentheses to the expressions
                                        $foundPattern = 0;
                                        for ($k = 0; $k < $regexpLength; ++$k) {
                                            if ($regexp[$k] === "\0") {
                                                break;
                                            }

                                            if ($foundPattern === false) {
                                                if ($regexp[$k] === '(') {
                                                    $foundPattern = 1;
                                                }
                                            } else {
                                                if ($regexp[$k] === ')') {
                                                    $foundPattern = 2;
                                                    break;
                                                }
                                            }
                                        }

                                        if ($foundPattern !== 2) {
                                            $routeStr .= '(' . $regexp . ')';
                                        } else {
                                            $routeStr .= $regexp;
                                        }
                                        $matches[$variable] = $tmp;
                                    }
                                } else {
                                    $routeStr .= '([^/]*)';
                                    $matches[$item] = $tmp;
                                }
                            }
                        } else {
                            $routeStr .= '{' . $item . '}';
                        }

                        $cursor++;
                        continue;
                    }
                }
            }

            if ($bracketCount === 0) {
                if ($ch === '(') {
                    $parenthesesCount++;
                } else {
                    if ($ch === ')') {
                        $parenthesesCount--;
                        if ($parenthesesCount === 0) {
                            $numberMatches++;
                        }
                    }
                }
            }

            if ($bracketCount > 0) {
                $intermediate++;
            } else {
                $routeStr .= $ch;
            }

            $cursor++;
        }

        return $routeStr;
    }
}
