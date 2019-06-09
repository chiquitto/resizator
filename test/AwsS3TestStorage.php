<?php

use Chiquitto\Resizator\Img;
use Chiquitto\Resizator\Storage\AwsS3Storage;

class AwsS3TestStorage extends AwsS3Storage
{

    public function __construct(Img $img)
    {
        parent::__construct($img);

        $config = require __DIR__ . '/aws.config.php';
        $this->region = $config['region'];
        $this->secretAccessKey = $config['secretAccessKey'];
        $this->accessKeyId = $config['accessKeyId'];
        $this->bucketName = $config['bucketName'];
    }

}