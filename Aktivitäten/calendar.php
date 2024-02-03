<?php
// Überprüfen, ob ein Jahr und ein Monat über die GET-Parameter übergeben wurden, sonst das aktuelle Datum verwenden
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');
$month = isset($_GET['month']) ? $_GET['month'] : date('m');

// Erstellen eines DateTime-Objekts für den ersten Tag des ausgewählten Monats und Jahres
$firstDay = new DateTime("$year-$month-01");
$firstDayOfWeek = $firstDay->format('N'); // Bestimmen des Wochentags des ersten Tags
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year); // Bestimmen der Anzahl der Tage im Monat

// Ausgabe des Container-Divs für den Kalender
echo "<div class='calendar-container'>";
// Ausgabe des Headers mit Navigationsbuttons und Monatsanzeige
echo "<div class='calendar-header' style='text-align: center;'>";
echo "<a href='?year=" . ($month == 1 ? $year - 1 : $year) . "&month=" . ($month == 1 ? 12 : $month - 1) . "' class='nav-button'>Vorheriger Monat</a>";
echo "<span class='month-year'>" . date('F Y', strtotime("$year-$month-01")) . "</span>";
echo "<a href='?year=" . ($month == 12 ? $year + 1 : $year) . "&month=" . ($month == 12 ? 1 : $month + 1) . "' class='nav-button'>Nächster Monat</a>";
echo "</div>";

// Ausgabe des Tabellen-Divs für den Kalender mit Überschriften für Wochentage
echo "<table class='calendar'>";
echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";

$dayCounter = 1;

// Iteration über die Kalenderwochen
for ($i = 0; $i < 6; $i++) {
    echo "<tr>";
    // Iteration über die Wochentage
    for ($j = 1; $j <= 7; $j++) {
        if ($i === 0 && $j < $firstDayOfWeek) {
            echo "<td></td>"; // Leere Zelle für Tage vor dem Monatsbeginn
        } elseif ($dayCounter <= $daysInMonth) {
            $currentDate = "$year-$month-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT);

            // Datenbankabfrage für Ereignisse an diesem Tag
            $events = getEventsForDate($currentDate);

            echo "<td class='day'>";
            echo "<strong>$dayCounter</strong><br>";
            // Ausgabe der Ereignisse für diesen Tag
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
            echo "<td></td>"; // Leere Zelle für Tage nach dem Monatsende
        }
    }
    echo "</tr>";
}

// Schließen der Tabellen-Divs und des Container-Divs
echo "</table>";
echo "</div>";

// Funktion zum Abrufen von Ereignissen aus der Datenbank für ein bestimmtes Datum
function getEventsForDate($date)
{
    global $pdo;

    $statement = $pdo->prepare("SELECT * FROM Aktivitäten WHERE datum = ?");
    $statement->execute([$date]);
    return $statement->fetchAll();
}
?>
