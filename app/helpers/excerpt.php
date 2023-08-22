<?php

// class Excerpt
// {
//     static function get(string $str, int $len, int $type): string
//     {
//         try {
//             if ($type == 1) {
//                 $str = strip_tags($str);
//             }

//             if ($type == 2) {
//                 return collect(explode(' ', $str))->splice(0, $len);
//             }

//             throw new \Exception("Invalid type");
//         } catch (\Throwable $th) {
//             //throw $th;
//         }
//     }
// }

function excerpt(string $str, int $len)
{
    return collect(explode(' ', $str))->splice(0, $len)->implode(' ');
}
