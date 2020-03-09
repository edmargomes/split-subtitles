<?php

include "nyx/SplitSubtitle.php";

use nyx\SplitSubtitle as ExplodeSubtitle;

$explodeSubtitle = new SplitSubtitle("Friends.S01E01.en.srt");
$percentTotal = 0;

echo "<table>";
foreach ($explodeSubtitle->words as $word => $count ) {

    $percent = $count/$explodeSubtitle->totalWords*100;
    $percentTotal += $percent;
    echo "<tr><td>$word</td><td>$count</td><td>$percent</td><td>$percentTotal</td></tr>";

}
echo "</table>";