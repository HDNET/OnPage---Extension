<?php

/**
 * ArrayService
 */

namespace HDNET\OnpageIntegration\Service;

/**
 * Class ArrayService
 */
class ArrayService extends AbstractService
{

    /**
     * Replace a key $replaceKey with $replaceItem
     *
     * @param array $array
     * @param       $replaceItem
     * @param       $replaceKey
     *
     * @return array
     */
    public function replaceRecursiveByKey(array $array, $replaceItem, $replaceKey)
    {
        foreach ($array as $key => &$item) {
            if ($key === $replaceKey) {
                $item = $replaceItem;
            } elseif (is_array($item)) {
                $item = $this->replaceRecursiveByKey($item, $replaceItem, $replaceKey);
            }
        }
        return $array;
    }
}
