<?php

$str = 'абрак';
$len = strlen($str);
$inArr = mb_str_split($str);
debug($inArr);
/*foreach ($inArr as $key => $value){

}*/
/*for($i=0; $i<$len; $i++){
    $startLetter = $inArr[$i];

}*/
// начинаем со 2 буквы (б)
$startIndex = 1;
$arr1 = array_slice($inArr, 0, $startIndex);
$arr2 = array_slice($inArr, $startIndex + 1);
$arr = array_merge($arr1, $arr2);
//debug($arr1);
//debug($arr2);
//debug($arr);

/*$arr = ['A','B','C','D','E'];
$resArr = [];

for ($i=0;$i<count($arr);$i++){
    for ($j=$i+1;$j<count($arr);$j++){
        array_push($resArr,$arr[$i].$arr[$j]);
    }
}
var_dump($resArr);*/

function variant($chars, $length, &$words, $prefix = '') {
    $arr = mb_str_split($chars);
    if (strlen($prefix) == $length) {
        $words[] = $prefix;
        return;
    }

    for ($i = 0; $i < strlen($chars); $i++) {
        variant($chars, $length, $words, $prefix . $chars[$i]);
    }
}

variant('abcd', 3, $words);
debug($words);

