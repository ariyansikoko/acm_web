<?php

function formatRupiah($nominal)
{
    $symbol = "Rp";
    $format = number_format($nominal, 0, ',', '.');

    $result = sprintf('%-2s%15s', $symbol, $format);
    return $result;
}

function formatPercent($nominal)
{
    return number_format($nominal, 0, '', '') . "%";
}
