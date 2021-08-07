<?php

if (!function_exists('deleteElement')) {
        function deleteElement($element, &$array)
        {
            $index = array_search($element, $array);
            if ($index !== false) {
                unset($array[$index]);
            }

            return $array;
        }
    }

