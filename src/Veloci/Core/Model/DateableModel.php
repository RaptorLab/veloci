<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 07/03/16
 * Time: 03:43
 */

namespace Veloci\Core\Model;


use DateTime;

trait DateableModel
{

    /**
     * @var DateTime
     */
    private $createdAt;

    /**
     * @var DateTime
     */
    private $updatedAt;

    /**
     * @var DateTime
     */
    private $deletedAt;

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }

    public function update()
    {
        $this->updatedAt = new DateTime();
    }

    public function delete()
    {
        $this->deletedAt = new DateTime();
    }

    public function isDeleted()
    {
        return $this->deletedAt !== null;
    }
}