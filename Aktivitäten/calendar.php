<?php
// Überprüfung, ob year und month im URL-Parameter vorhanden sind (dann wird Wert zugewiesen) sonst aktuelles Datum 
// Sinn: soll auf aktuelles Jahr und Monat generiert werden
$year = isset($_GET['year']) ? $_GET['year'] : date('Y'); 
$month = isset($_GET['month']) ? $_GET['month'] : date('m');


$firstDay = new DateTime("$year-$month-01"); //Tag 1 in Monat Jahr als neues DateTime Objekt
$firstDayOfWeek = $firstDay->format('N'); // format('N') bestimmt Wochentag des ersten Tages --> Methode von ChatGPT
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, (int)$month, (int)$year); // Funktion cal_days_in_month(): Bestimmt Anzahl der Tage im Monat --> Funktion von ChatGPT

//Container-Div für Kalender
echo "<div class='calendar-container'>";
//Headers mit Navigationsbuttons und Monatsanzeige
echo "<div class='calendar-header' style='text-align: center;'>";
//dynamischer Link mit Klasse nav-botton: Monat=Januar: Jahr wird um 1 verringert, sonst wird Monat um 1 verringert
echo "<a href='?year=" . ($month == 1 ? $year - 1 : $year) . "&month=" . ($month == 1 ? 12 : $month - 1) . "' class='nav-button'>Vorheriger Monat</a>";
echo "<span class='month-year'>" . date('F Y', strtotime("$year-$month-01")) . "</span>"; //strtotime: Zeitstempel für ersten Tag des aktuellen Monats
echo "<a href='?year=" . ($month == 12 ? $year + 1 : $year) . "&month=" . ($month == 12 ? 1 : $month + 1) . "' class='nav-button'>Nächster Monat</a>";
echo "</div>";

//Überschriften für Wochentage
echo "<table class='calendar'>";
echo "<tr><th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th></tr>";


$dayCounter = 1; //aktueller Tag

//Kalenderwochen (max. 6)
for ($i = 0; $i < 6; $i++) {
    echo "<tr>";
    //Wochentage (7)
    for ($j = 1; $j <= 7; $j++) {
        if ($i === 0 && $j < $firstDayOfWeek) { //erste Kalenderwoche umd Tag vor Monatsbeginn
            echo "<td></td>"; // Leere Zelle für Tage vor dem Monatsbeginn
        } elseif ($dayCounter <= $daysInMonth) {
            $currentDate = "$year-$month-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT); //str_pad: Tag immer zweistellig --> Funktion von ChatGPT

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


echo "</table>";
echo "</div>";

// Funktion zum Abrufen von Ereignissen aus der Datenbank für ein bestimmtes Datum
function getEventsForDate($date)
{
    global $pdo; //Zugriff auf Datenbankverbindung

    $statement = $pdo->prepare("SELECT * FROM Aktivitäten WHERE datum = ?");
    $statement->execute([$date]); //Datum als Parameter
    return $statement->fetchAll(); //assoziatives Array wird zurückgegeben
}
?>
