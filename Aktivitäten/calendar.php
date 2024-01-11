<?php
$year = $_GET['year'];
$month = $_GET['month'];

$firstDay = new DateTime("$year-$month-01");
$firstDayOfWeek = $firstDay->format('N');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

echo "<table>";
echo "<tr><th colspan='7'>" . date('F Y', strtotime("$year-$month-01")) . "</th></tr>";
echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

$dayCounter = 1;

echo "<tr>";
for ($i = 1; $i < $firstDayOfWeek; $i++) {
    echo "<td></td>";
}

for ($i = $firstDayOfWeek; $i <= 7; $i++) {
    $currentDate = "$year-$month-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT);
    echo "<td>$dayCounter</td>";
    $dayCounter++;
}

echo "</tr>";

for ($i = 2; $i <= 6; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= 7; $j++) {
        if ($dayCounter <= $daysInMonth) {
            $currentDate = "$year-$month-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT);
            echo "<td>$dayCounter</td>";
            $dayCounter++;
        } else {
            echo "<td></td>";
        }
    }
    echo "</tr>";
}

echo "</table>";
?>
