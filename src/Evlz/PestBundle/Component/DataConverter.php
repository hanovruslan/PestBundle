<?php

namespace  Evlz\PestBundle\Component;

/**
 * Created by PhpStorm.
 * User: rh
 * Date: 20.08.14
 * Time: 12:48
 */

class DataConverter
{

    /**
     * @param array $data
     * @return array|null
     */

    public function convert($data)
    {
        $result = null;
        if(is_scalar($data))
        {
            $result = $data;
        }
        elseif(is_array($data))
        {
            $result = $this->convertArray($data);
        }
        else
        {
            $data = null;
        }

        return $result;
    }

    public function convertArray($array)
    {
        $result = [];
        $callback = [$this, __FUNCTION__];

        foreach($array as $parentKey => $parentValue)
        {
            if(is_scalar($parentValue))
            {
                $result[$parentKey] = $parentValue;
            }
            elseif(is_array($parentValue))
            {
                foreach(call_user_func_array($callback, [$parentValue]) as $childKey => $childValue)
                {
                    $result[$this->convertKey($parentKey, $childKey)] = $childValue;
                }
            }
            else
            {
                $result[$parentKey] = null;
            }
        }

        return $result;
    }

    protected function convertKey($parentKey, $childKey)
    {
        $result = (count($chunks = explode('[', $childKey, 2)) >= 2)
            ? $parentKey . '[' . $chunks[0] . '][' . $chunks[1]
            : $parentKey . '[' . $childKey . ']';

        return $result;
    }

} 