<?php
namespace Core\Db;

use Core\Db\Paginator\QueryBuilder as Paginator;
use Core\Db\Query\Builder;
use Core\Config;
use Phalcon\Db\Exception;

class Query
{
    public static $modelsList = null;

    /*
     **$query array 检索条件
     *form array()
     *form@id table 短名
     *form @columns 需要列举的列
     *join array()
     *join@id table 短名
     *join@conditions join筛选条件
     *where array()
     *where@conditions string
     *where@bind array 绑定参数
     *where@type array() 绑定参数类型
     *order string 排序规则
     */
    public static function find($query)
    {
        if (!isset($query['from'])) {
            throw new Exception('At least one model is required to build the query');
        }
        $sql = new Builder();
        $sql->from($query['from']);
        foreach (array('join', 'leftJoin', 'rightJoin') as $value) {
            if (isset($query[$value]) && !empty($query[$value]) && is_array($query[$value])) {
                foreach ($query[$value] as $item) {
                    if (isset($item['id']) && isset($item['conditions']) && isset($item['id'])) {
                        $sql->{$value}($item['id'], $item['conditions'], $item['id']);
                    }
                }
            }
        }
        foreach (array('where', 'andWhere', 'inWhere', 'orWhere', 'betweenWhere', 'notBetweenWhere', 'notInWhere') as $value) {
            if (isset($query[$value]) && !empty($query[$value]) && is_array($query[$value])) {
                foreach ($query[$value] as $item) {
                    if (isset($item[2])) {
                        $sql->{$value}($item[0], $item[1], $item[2]);
                    } elseif (isset($item[1])) {
                        $sql->{$value}($item[0], $item[1]);
                    }
                }
            }
        }
        if (isset($query['order'])) {
            $sql->orderBy($query['order']);
        }
        if (isset($query['paginator']) && $query['paginator'] == true) {
            if (!isset($query['limit'])) {
                $query['limit'] = 10;
            }
            if (!isset($query['page'])) {
                $query['page'] = 1;
            }
            $output = new Paginator(array(
                'builder' => $sql,
                'limit' => $query['limit'],
                'page' => $query['page'],
            ));
            return $output->getPaginate();
        }
        if (!isset($query['limit'])) {
            $query['limit'] = array(0, 10);
        }
        if (isset($query['limit'])) {
            if (is_array($query['limit'])) {
                $sql->orderBy($query['limit'][0], $query['limit'][1]);
            } else {
                $sql = $sql->orderBy($query['limit']);
            }
        }
        Config::printCode($sql->getPhql());
        $result = $sql->execute();
        $result->setFetchMode(PDO::FETCH_OBJ);
        return $result->fetchAll();
    }

}
