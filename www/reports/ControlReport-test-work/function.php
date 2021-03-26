<?php

function analize(array $array, $colCount, $rowCount)
{
    if ($array[21][0][9] !=
    ($array[22][0][9] + 
    $array[23][0][9] +
    $array[24][0][9] +
    $array[25][0][9] +
    $array[26][0][9] +
    $array[28][0][9] + 
    $array[29][0][9] +
    $array[30][0][9] +
    $array[31][0][9] +
    $array[32][0][9] )
    ) 
    {
        $array[21][0][15] = "ERROR";
    }
    return $array;
}
?>