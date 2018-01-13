<?php

namespace App\Acme\Traits;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait CreatedUpdateAtTrait
{
    /**
     * @ORM\Column(type="datetime",name="created_at")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime",name="updated_at")
     */
    protected $updatedAt;

    /**
     * @return DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new DateTime(date('Y-m-d H:i:s')));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new DateTime(date('Y-m-d H:i:s')));
        }
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
}
