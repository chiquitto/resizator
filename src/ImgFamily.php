<?php


namespace Chiquitto\Resizator;


use ArrayObject;

class ImgFamily extends ArrayObject
{

    /**
     * @var Img[]
     */
    private $list = [];

    function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * @param $idFamily
     *
     * @return ImgFamily
     */
    public static function factoryFamily($idFamily)
    {
        $r = [];

        $r[$idFamily] = new Img([
                'id' => $idFamily
            ] + Resizator::getFamilies()[$idFamily]);

        foreach (Resizator::getFamilies() as $id => $img) {
            if (!isset($img['original'])) {
                continue;
            }

            if ($img['original'] == $idFamily) {
                $r[$id] = new Img([
                        'id' => $id
                    ] + $img);
            }
        }

        return new ImgFamily($r);
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