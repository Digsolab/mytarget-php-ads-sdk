<?php

namespace MyTarget\Domain\V1\Banner;

use MyTarget\Mapper\Annotation\Field;

class Products
{
    /**
     * @var string
     * @Field(name="template_type", type="string")
     */
    private $templateType;

    /**
     * @var string
     * @Field(name="button_title", type="string")
     */
    private $buttonTitle;

    /**
     * @var string
     * @Field(name="product_name", type="string")
     */
    private $productName;

    /**
     * @var string
     * @Field(name="about_company", type="string")
     */
    private $aboutCompany;

    /**
     * @var bool
     * @Field(name="product_zoom", type="bool")
     */
    private $productZoom;

    /**
     * @var array
     * @Field(name="appearance", type="dict")
     */
    private $appearance;

    /**
     * @return mixed
     */
    public function getTemplateType()
    {
        return $this->templateType;
    }

    /**
     * @return string
     */
    public function getButtonTitle()
    {
        return $this->buttonTitle;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return string
     */
    public function getAboutCompany()
    {
        return $this->aboutCompany;
    }

    /**
     * @return bool
     */
    public function isProductZoom()
    {
        return $this->productZoom;
    }

    /**
     * @return array
     */
    public function getAppearance()
    {
        return $this->appearance;
    }
}
