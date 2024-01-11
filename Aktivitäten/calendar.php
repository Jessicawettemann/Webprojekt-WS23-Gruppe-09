<?php
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$month = isset($_GET['month']) ? $_GET['month'] : date('m');

$firstDay = new DateTime("$year-$month-01");
$firstDayOfWeek = $firstDay->format('N');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year);

echo "<div class='calendar-container'>";
echo "<div class='calendar-header' style='text-align: center;'>";
echo "<a href='?year=" . ($month == 1 ? $year - 1 : $year) . "&month=" . ($month == 1 ? 12 : $month - 1) . "' class='nav-button'>&lt; Vorheriger Monat</a>";
echo "<span>" . date('F Y', strtotime("$year-$month-01")) . "</span>";
echo "<a href='?year=" . ($month == 12 ? $year + 1 : $year) . "&month=" . ($month == 12 ? 1 : $month + 1) . "' class='nav-button'>Nächster Monat &gt;</a>";
echo "</div>";


echo "<table class='calendar'>";
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

            echo "<td class='day'>";
            echo "<strong>$dayCounter</strong><br>";
            foreach ($events as $event) {
                echo "<div class='event'>";
                echo "<div>{$event['thema']}</div>";
                echo "<div>{$event['beschreibung']}</div>";
                echo "<div>Ort: {$event['ort']}</div>";
                echo "</div>";
            }
            echo "</td>";

            $dayCounter++;
        } else {
            echo "<td></td>";
        }
    }
    echo "</tr>";
}

echo "</table>";
echo "</div>";

function getEventsForDate($date)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Aktivitäten WHERE datum = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}
?>
