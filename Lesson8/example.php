<?php
header("Content-type: text/plain; charset=utf-8");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);// Получаем и проверяем
if (isset($_REQUEST['y'])) { $y = stripslashes($_REQUEST['y']); if ($y == '') { unset($y);} } 
if (isset($_REQUEST['n'])) { $n = stripslashes($_REQUEST['n']); if ($n == '') { unset($n);} } 
echo "Получили переменные <strong>$y</strong> и <strong>$n</strong> . Всё работает!";?>