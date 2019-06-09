<?php

namespace Chiquitto\Resizator\Storage;


use Aws\S3\S3Client;
use Intervention\Image\Image;

abstract class AwsS3Storage extends AbstractStorage
{

    protected $bucketName;
    protected $accessKeyId;
    protected $secretAccessKey;
    protected $region;
    private $s3Instance;

    public function save(Image $image, array $params)
    {
        $absolutePath = $this->parseAbsolutePath($params);
        $this->getS3Instance()->putObject([
            'Bucket' => $this->bucketName,
            'Key' => $absolutePath,
            'Body' => $image->stream('jpg')->getContents(),
            'ContentType' => 'image/jpeg', // $image->mime()
        ]);
    }

    public function parseAbsolutePath(array $params = [])
    {
        return $this->parseFilename($params);
    }

    /**
     * @return S3Client
     */
    private function getS3Instance()
    {
        if ($this->s3Instance === null) {
            $this->s3Instance = new S3Client([
                'service' => 's3',
                'region' => $this->region,
                'version' => 'latest',
                'signature_version' => 'v4',
                'credentials' => [
                    'key' => $this->accessKeyId,
                    'secret' => $this->secretAccessKey
                ]
            ]);
        }

        return $this->s3Instance;
    }


}