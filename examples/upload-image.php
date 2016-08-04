<?php

namespace Foo;


use MyTarget\Domain\V1\Image\UploadImage;
use MyTarget\Operator\V1\ImageOperator;

list($client, $mapper) = require __DIR__ . "/bootstrap.php";

$op = new ImageOperator($client, $mapper);

$response = $op->upload(__DIR__ . "/240x400.png", UploadImage::forDimensions(240, 400));

var_dump($response);
