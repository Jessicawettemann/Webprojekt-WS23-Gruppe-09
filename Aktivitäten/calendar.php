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

for ($i = 0; $i < 6; $i++) {
    echo "<tr>";
    for ($j = 1; $j <= 7; $j++) {
        if ($i === 0 && $j < $firstDayOfWeek) {
            echo "<td></td>";
        } elseif ($dayCounter <= $daysInMonth) {
            $currentDate = "$year-$month-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT);

            // Datenbankabfrage für Ereignisse an diesem Tag
            $events = getEventsForDate($currentDate);

            echo "<td>";
            echo "<strong>$dayCounter</strong>";
            echo "<ul>";
            foreach ($events as $event) {
                echo "<li>{$event['thema']}</li>";
            }
            echo "</ul>";
            echo "</td>";

            $dayCounter++;
        } else {
            echo "<td></td>";
        }
    }
    echo "</tr>";
}

echo "</table>";

function getEventsForDate($date)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Aktivitäten WHERE datum = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}
?>
