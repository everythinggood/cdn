<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 4:30 PM
 */

namespace Entity;


use Gedmo\Mapping\Annotation as Gedmo;

trait handleTimeStampAble
{
    /**
     * @var \DateTime
     * @ODM\Field(type="date", name="create_at")
     * @Gedmo\Timestampable(on="create")
     */
    protected $createAt;

    /**
     * @var \DateTime
     * @ODM\Field(type="date", name="update_at")
     * @Gedmo\Timestampable
     */
    protected $updateAt;


    /**
     * @return \DateTime
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdateAt(): \DateTime
    {
        return $this->updateAt;
    }
}