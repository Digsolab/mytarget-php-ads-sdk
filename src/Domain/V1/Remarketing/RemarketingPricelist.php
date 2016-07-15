<?php

namespace MyTarget\Domain\V1\Remarketing;

use MyTarget\Mapper\Annotation\Field;

class RemarketingPricelist
{
    /**
     * @var int
     * @Field(name="id", type="int")
     */
    private $id;

    /**
     * @var string
     * @Field(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     * @Field(name="export_url", type="string")
     */
    private $exportUrl;

    /**
     * @var int
     * @Field(name="shop_id", type="int")
     */
    private $shopId;

    /**
     * @var int
     * @Field(name="feed_id", type="int")
     */
    private $feedId;

    /**
     * @var \DateTime
     * @Field(name="created", type="DateTime")
     */
    private $created;

    /**
     * @var \DateTime
     * @Field(name="last_import_finished", type="DateTime")
     */
    private $lastImportFinished;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getExportUrl()
    {
        return $this->exportUrl;
    }

    /**
     * @param string $exportUrl
     */
    public function setExportUrl($exportUrl)
    {
        $this->exportUrl = $exportUrl;
    }

    /**
     * @return int
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param int $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @return int
     */
    public function getFeedId()
    {
        return $this->feedId;
    }

    /**
     * @param int $feedId
     */
    public function setFeedId($feedId)
    {
        $this->feedId = $feedId;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @return \DateTime
     */
    public function getLastImportFinished()
    {
        return $this->lastImportFinished;
    }

    /**
     * @param \DateTime $lastImportFinished
     */
    public function setLastImportFinished($lastImportFinished)
    {
        $this->lastImportFinished = $lastImportFinished;
    }
}
