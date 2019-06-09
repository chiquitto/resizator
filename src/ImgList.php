<?php

namespace Chiquitto\Resizator;


use Chiquitto\Resizator\Storage\LocalStorage;

class ImgList
{
    /**
     * @var Img[]
     */
    private $list = [];

    function __construct(array $imgList)
    {
        $this->list = $imgList;
    }

    /**
     * @param $idFamily
     *
     * @return ImgList
     */
    public static function factoryFamily($idFamily)
    {
        $r = [];

        $r[$idFamily] = new Img([
                'id' => $idFamily
            ] + Resizator::$families[$idFamily]);

        foreach (Resizator::$families as $id => $img) {
            if (!isset($img['original'])) {
                continue;
            }

            if ($img['original'] == $idFamily) {
                $r[$id] = new Img([
                        'id' => $id
                    ] + $img);
            }
        }

        return new ImgList($r);
    }

    /**
     * @param $key
     *
     * @return Img|mixed
     */
    public function get($key)
    {
        return $this->list[$key];
    }

    public function getKeys()
    {
        return array_keys($this->list);
    }

    /**
     * @return Img[]
     */
    public function getList()
    {
        return $this->list;
    }


}