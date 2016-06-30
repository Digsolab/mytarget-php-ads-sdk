<?php

namespace MyTarget\Domain\V1;

use MyTarget\Mapper\Annotation\Field;

class Products
{
    /**
     * @Field(name="template_type", type="string")
     */
    private $templateType;

    /**
     * @Field(name="button_title", type="string")
     */
    private $buttonTitle;

    /**
     * @Field(name="product_name", type="string")
     */
    private $productName;

    /**
     * @Field(name="about_company", type="string")
     */
    private $aboutCompany;

    /**
     * @Field(name="product_zoom", type="bool")
     */
    private $productZoom;

    /**
     * @Field(name="appearance", type="mixed")
     */
    private $appearance;
}
