<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 4:41 PM
 */

namespace Entity\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use Doctrine\ODM\MongoDB\Query\Builder;

/**
 * Trait handleListEntityRepository
 * @package Entity\Repository
 * @property-read DocumentRepository $this
 */
trait handleListEntityRepository
{
    /**
     * @var Builder
     */
    protected $_queryBuilder;

    protected $_page = 1;

    protected $_itemPerPage = 20;

    protected $_total = 1;

    protected $_totalPage = 1;

    protected $_skip = 0;

    public function initQueryBuilder()
    {
        $this->_queryBuilder = $this->createQueryBuilder();
        return $this;
    }

    public function setQueryBuilder(Builder $queryBuilder)
    {
        $this->_queryBuilder = $queryBuilder;
    }

    /**
     * @return Builder
     */
    public function getQueryBuilder()
    {
        if (!$this->_queryBuilder) {
            $this->_queryBuilder = $this->createQueryBuilder();
        }
        return $this->_queryBuilder;
    }

    public function setSkip(int $skip)
    {
        $this->_skip = $skip;
        return $this;
    }

    public function setLimit(int $limit)
    {
        $this->_itemPerPage = $limit;
        return $this;
    }

    public function setPage(int $page)
    {
        if ($page > 0) {
            $this->_page = $page;
        }
        $this->calculateSkip();
        return $this;
    }

    public function setItemPerPage(int $itemPerPage)
    {
        if ($itemPerPage > 0) {
            $this->_itemPerPage = $itemPerPage;
        }
        $this->calculateSkip();
        return $this;
    }

    public function getQuery()
    {
        return $this->getQueryBuilder()->getQuery();
    }

    public function setQuery(array $query = [])
    {
        foreach ($query as $key => $value) {
            if (is_array($value)) {
                if ($key == '$or') {
                    foreach ($value as $op => $val) {
                        $this->getQueryBuilder()->addOr($val);
                    }
                } else {
                    foreach ($value as $op => $val) {
                        switch ($op) {
                            case '$gte':
                                $this->getQueryBuilder()->field($key)->gte($val);
                                break;
                            case '$gt':
                                $this->getQueryBuilder()->field($key)->gt($val);
                                break;
                            case '$lte':
                                $this->getQueryBuilder()->field($key)->lte($val);
                                break;
                            case '$lt':
                                $this->getQueryBuilder()->field($key)->lt($val);
                                break;
                            case '$in':
                                $this->getQueryBuilder()->field($key)->in($val);
                                break;
                            case '$nin':
                                $this->getQueryBuilder()->field($key)->notIn($val);
                                break;
                            case '$ne':
                                $this->getQueryBuilder()->field($key)->notEqual($val);
                                break;
                            case '$ref':
                                $this->getQueryBuilder()->field($key)->references($val);
                                break;
                            default:
                                break;
                        }
                    }
                }
            } else {
                $this->getQueryBuilder()->field($key)->equals($value);
            }
        }
        return $this;
    }

    public function setSortBy($field, $order = -1)
    {
        $this->getQueryBuilder()->sort($field, $order);
        return $this;
    }

    public function getItemPerPage()
    {
        return $this->_itemPerPage;
    }

    public function getPage()
    {
        return $this->_page;
    }

    public function getSkip()
    {
        return $this->_skip;
    }

    public function getLimit()
    {
        return $this->_itemPerPage;
    }

    public function calculateSkip()
    {
        $this->_skip = ($this->_page - 1) * $this->_itemPerPage;
        return $this->_skip;
    }

    public function getTotal()
    {
        /** @var Builder $queryBuilder */
        return $this->getQueryBuilder()->getQuery()->count();
    }

    public function getTotalPage()
    {
        return ceil($this->getTotal() / $this->_itemPerPage);
    }

    /**
     * @return mixed
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function executeQuery()
    {
        return $this->getQueryBuilder()
            ->skip($this->_skip)
            ->limit($this->_itemPerPage)
            ->getQuery()
            ->execute();
    }
}