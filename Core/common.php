<?php
//输出未知变量
function getVar($data, $varName, $default = null)
{
    if (is_object($data)) {
        //查询是否有render函数
        $methodName = 'render' . ucfirst($varName);
        if (method_exists($data, $methodName)) {
            return $data->{$methodName}();
        }
        //查询是否有get函数
        $methodName = 'get' . ucfirst($varName);
        if (method_exists($data, $methodName)) {
            return $data->{$methodName}();
        }
        if (isset($data->{$varName})) {
            return $data->{$varName};
        }
    } elseif (is_array($data)) {
        if (isset($data[$varName])) {
            return $data[$varName];
        }
    } elseif (is_string($data)) {
        $varName = intval($varName);
        return $data[$varName];
    }
    return $default;
}

//转换附加属性成字符串
function renderAttributes($attributes)
{
    $output = array();
    foreach ($attributes as $key => $value) {
        if (is_string($value)) {
            $output[] = "$key = '$value'";
        }

    }
    return implode(' ', $output);
}

//转换时间
function timeTran($the_time)
{
    //echo $now_time;
    $now_time = time();
    $show_time = $the_time;
    $the_time = date("Y年m月d日", time());
    $dur = $now_time - $show_time;
    if ($dur < 0) {
        return $the_time;
    } else {
        if ($dur < 60) {
            return $dur . '秒前';
        } else {
            if ($dur < 3600) {
                return floor($dur / 60) . '分钟前';
            } else {
                if ($dur < 86400) {
                    return floor($dur / 3600) . '小时前';
                } else {
                    if ($dur < 259200) {
                        //3天内
                        return floor($dur / 86400) . '天前';
                    } else {
                        return $the_time;
                    }
                }
            }
        }
    }
}

//自动闭合html标签
function closeHtmlTags($html)
{
    preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
    $openedtags = $result[1];
    preg_match_all('#</([a-z]+)>#iU', $html, $result);
    $closedtags = $result[1];
    $len_opened = count($openedtags);
    $len_closed = count($closedtags);
    if ($len_closed == $len_opened) {
        return $html;
    }
    $openedtags = array_reverse($openedtags);
    for ($i = 0; $i < $len_opened; $i++) {
        if (!in_array($openedtags[$i], $closedtags)) {
            $html .= '</' . $openedtags[$i] . '>';
        } else {
            unset($closedtags[array_search($openedtags[$i], $closedtags)]);
        }
    }
    return $html;
}

//截取字符串，并自动闭合html标签
function subString($string, $length, $stripTags = false, $start = 0)
{
    if ($stripTags === true) {
        return strip_tags(trim(mb_substr($string, $start, $length, 'utf-8')));
    }
    return closeHtmlTags(mb_substr($string, $start, $length, 'utf-8'));
}

//获取不带参数的当前地址
function staticUrl($params = array())
{
    global $di;
    $urlName = $di->getShared('router')->getMatchedRoute()->getName();
    $urlParams = $di->getShared('router')->getParams();
    $urlParams['for'] = $urlName;
    return $di->getShared('url')->get($urlParams, $params);
}

//处理分页数据
function paginator($total, $current, $item)
{
    if ($total == 0) {
        return array();
    }
    $output = array();
    $nowItem = intval($item / 2);
    for ($i = $nowItem; $i >= 1; $i--) {
        $index = $current - $i;
        if ($index <= 1) {
            $output[1] = 1;
        } else {
            $output[$index] = $index;
        }
    }
    $output[$current] = 'current';
    for ($i = 1; $i <= $nowItem + 1; $i++) {
        $index = $current + $i;
        if ($index > $total) {
            $output[$total] = $total;
        } else {
            $output[$index] = $index;
        }
    }
    return $output;
}

//转换驼峰命名为数组
function exEntityNameInfo($str)
{
    if (is_string($str) === false) {
        //@warning The Exception is an E_ERROR in the original API
        //@note changed "camelize" to "uncamelize"
        throw new Exception('Invalid arguments supplied for uncamelize()');
    }

    $l = strlen($str);
    $output = '';

    for ($i = 0; $i < $l; ++$i) {
        $ch = ord($str[$i]);

        if ($ch === 0) {
            break;
        }

        if ($ch >= 65 && $ch <= 90) {
            if ($i > 0) {
                $output .= '_';
            }
            $output .= chr($ch + 32);
        } else {
            $output .= $str[$i];
        }
    }
    return explode('_', $output);
}

// nestableJson数据转化为数组
function nestableJsonToArray($data)
{
    $output = array();
    foreach ($data as $t) {
        $output[$t->id] = $t->id;
        if (isset($t->children)) {
            $output[$t->id] = nestableJsonToArray($t->children);
        }
    }
    return $output;
}

//从多维数组中删除某一项目
function arrayDeleteItem($hierarchy, $item)
{
    $output = $hierarchy;
    if (isset($hierarchy[$item])) {
        if (is_array($hierarchy[$item])) {
            $output = array_merge($hierarchy[$item], $output);
        }
        unset($output[$item]);

        return $output;
    }
    foreach ($hierarchy as $key => $value) {
        if (is_array($value)) {
            $hierarchy[$key] = arrayDeleteItem($value, $item);
            if (empty($hierarchy[$key])) {
                $hierarchy[$key] = $key;
            }
        }
    }
    return $hierarchy;
}

//基于数组的数据库查询构建
function attachToString($attach)
{
    $output = '';
    if (is_string($attach)) {
        $output = $attach;
    } elseif (is_array($attach)) {
        $output = array();
        foreach ($attach as $value) {
            if (isset($value['key']) && isset($value['value']) && !empty($value['key']) && !empty($value['value'])) {
                $output[$value['key']] = $value['value'];
            }
        }
        $output = serialize($output);
    }
    return $output;
}
//将多维数组转为一维数组
function toFlat($a)
{
    $output = array();
    if (is_array($a)) {
        foreach ($a as $key => $value) {
            if (is_array($value)) {
                $output[$key] = $key;
                $output += toFlat($value);
            } else {
                $output[$key] = $value;
            }
        }
    }
    return $output;
}
//从多维数组中根据键名取回值
function search($a, $key)
{
    $output = array();
    $newa = array();
    if (isset($a[$key])) {
        return $a[$key];
    }
    foreach ($a as $v) {
        if (is_array($v)) {
            $a = search($v, $key);
            if ($a != false) {
                return $a;
            }
        }
    }
    return false;
}
function toOne($items)
{
    foreach ($items as $key => $value) {
        $items[$key] = $key;
    }
    return $items;
}
//通过单一数组生成结构树
function tree($items)
{
    $tree = array();
    $oneItems = toOne($items);
    foreach ($items as $key => $item) {
        if (isset($items[$item['parent']])) {
            if (!is_array($oneItems[$item['parent']])) {
                $oneItems[$item['parent']] = array();
            }
            $oneItems[$item['parent']][$key] = &$oneItems[$key];
        } else {
            $tree[$key] = &$oneItems[$key];
        }
    }
    return $tree;
}
function attachToArray($attach)
{
    if (is_array($attach)) {
        return $attach;
    } elseif (is_string($attach)) {
        if (($attach = @unserialize($attach)) == true) {
            return $attach;
        }
    }
    return array();
}
function rurl($name, $params, $key, $value)
{
    global $di;
    if (!isset($params[$key])) {
        return '#';
    }
    $params[$key] = $value;
    $url_arr = array_merge($params, array('for' => $name));
    return $di->getShared('url')->get($url_arr);
}
