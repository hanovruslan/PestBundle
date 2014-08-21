<?php

namespace  Evlz\PestBundle\Component;

/**
 * Created by PhpStorm.
 * User: rh
 * Date: 20.08.14
 * Time: 12:48
 */

class DataConvertor
{

    /**
     * @param array $data
     * @return array|null
     */

    public function convert($data)
    {
        $result = null;
        switch(gettype($data))
        {
            case 'string':
            {
                $result = $data;
                break;
            }
            case 'array':
            {
                $result = $this->restructArray($data);
                break;
            }
            default:
            {
                // do nothing
                break;
            }
        }

        return $result;
    }

    public function restructArray($array)
    {
        $result = [];
        $callback = [$this, __FUNCTION__];

        foreach($array as $parentKey => $parentValue)
        {
            switch(gettype($parentValue))
            {
                case 'string':
                {
                    $result[$parentKey] = $parentValue;
                    break;
                }
                case 'array':
                {
                    foreach(call_user_func_array($callback, [$parentValue]) as $childKey => $childValue)
                    {
                        $result[$this->restructKeyPath($parentKey, $childKey)] = $childValue;
                    }
                    break;
                }
            }
        }

        return $result;
    }

    protected function restructKeyPath($parentKey, $childKey)
    {
        if(count($chunks = explode('[', $childKey, 2)) >= 2)
        {
            $result = $parentKey . '[' . $chunks[0] . '][' . $chunks[1];
        }
        else
        {
            $result = $parentKey . '[' . $childKey . ']';
        }

        return $result;
    }

} 