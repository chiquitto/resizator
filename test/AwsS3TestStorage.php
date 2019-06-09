<?php

use Chiquitto\Resizator\Img;
use Chiquitto\Resizator\Storage\AwsS3Storage;
use Chiquitto\Resizator\Storage\PublicAccessStorage;

class AwsS3TestStorage extends AwsS3Storage implements PublicAccessStorage
{

    public function __construct(Img $img)
    {
        parent::__construct($img);
        $this->setDir('img');

        $config = require __DIR__ . '/aws.config.php';
        $this->region = $config['region'];
        $this->secretAccessKey = $config['secretAccessKey'];
        $this->accessKeyId = $config['accessKeyId'];
        $this->bucketName = $config['bucketName'];
    }

    public function parsePublicPath(array $params)
    {
        return "https://{$this->bucketName}.s3.amazonaws.com/" . $this->parseDirectory($params);
    }

    public function parsePublicDirectory(array $params)
    {
        return $this->parsePublicPath($params);
    }


}