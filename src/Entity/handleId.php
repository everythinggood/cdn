<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 4:28 PM
 */

namespace Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

trait handleId
{
    /**
     * @var string
     * @ODM\Id
     */
    protected $id;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

}