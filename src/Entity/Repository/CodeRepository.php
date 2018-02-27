<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 4:32 PM
 */

namespace Entity\Repository;


use Doctrine\ODM\MongoDB\DocumentRepository;

class CodeRepository extends DocumentRepository
{

    use handleListEntityRepository;

    public function setStatus($status){
        $this->getQueryBuilder()->field("status")->equals($status);
        return $this;
    }

}