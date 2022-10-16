<?php

namespace App\Service;

class Common
{
    /**
     * Aplanie un tableau multidimensionnel
     */
    public static function boo(array $array): array
    {
        $result = [];
        array_walk_recursive($array, function ($a) use (&$result) {
            $result[] = $a;
        });

        return $result;
    }

    /**
     * retourne un tableau avec le premier tableau passé en parametre sans modification
     * et y ajoute la donnée qui a l'index K dans le 2nd tableau comme index de la donnée V
     */
    public static function foo(array $array1, array $array2): array
    {
        return [...$array1, $array2['k'] => $array2['v']];
    }

    /**
     * Return true si les deux tableau sont vide
     */
    public static function bar(array $array1, array $array2): bool
    {
        $r = array_filter(array_keys($array1), fn ($k) => !in_array($k, $array2));

        return count($r) == 0;
    }
}
