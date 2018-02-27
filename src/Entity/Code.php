<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/27/18
 * Time: 4:26 PM
 */

namespace Entity;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * Class Code
 * @package Entity
 * @ODM\Document(
 *     collection="code",
 *     repositoryClass="\Entity\Repository\CodeRepository",
 *     indexes={
 *         @ODM\Index(keys={"status"="desc"}),
 *     },
 *     requireIndexes="true"
 * )
 */
class Code
{

    use handleTimeStampAble;

    const STATUS_PENDING = 'pending';
    const STATUS_RUNNING = 'running';

    static $labels = [
        self::STATUS_PENDING => "离线",
        self::STATUS_RUNNING => "正在运行"
    ];

    /**
     * @var string
     * @ODM\Id
     */
    protected $id;
    /**
     * @var string
     * @ODM\Field(type="string")
     */
    protected $status;
    /**
     * @var string
     * @ODM\Field(type="int",name="loading_time")
     */
    protected $loadingTime;

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getLoadingTime(): string
    {
        return $this->loadingTime;
    }

    /**
     * @param string $loadingTime
     */
    public function setLoadingTime(string $loadingTime): void
    {
        $this->loadingTime = $loadingTime;
    }

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }


}