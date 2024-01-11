<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monatskalender</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #calendar {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        #calendarTable {
            width: 100%;
            border-collapse: collapse;
        }

        #calendarTable th, #calendarTable td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        #calendarTable th {
            background-color: #f2f2f2;
        }

        .current-day {
            background-color: #ffffcc;
        }

        .event-cell {
            background-color: #ffcccc;
        }
    </style>
</head>
<body>

<div id="calendar">
    <div class="header">
        <button onclick="prevMonth()">&lt;</button>
        <h1 id="currentMonth"></h1>
        <button onclick="nextMonth()">&gt;</button>
    </div>

    <table id="calendarTable">
        <?php
        // Initialisiere den Kalender
        $currentDate = new DateTime();
        $currentYear = $currentDate->format('Y');
        $currentMonth = $currentDate->format('n');

        // Aktualisiere den Kalender
        updateCalendar($currentYear, $currentMonth);
        ?>
    </table>
</div>

<script>
    function prevMonth() {
        window.location.href = "?month=<?php echo $currentMonth - 1; ?>&year=<?php echo $currentYear; ?>";
    }

    function nextMonth() {
        window.location.href = "?month=<?php echo $currentMonth + 1; ?>&year=<?php echo $currentYear; ?>";
    }
</script>

<?php
// Funktion zum Aktualisieren des Kalenders
function updateCalendar($year, $month) {
    echo "<script>document.getElementById('currentMonth').innerText = '" . getMonthName($month) . " $year';</script>";

    $firstDay = new DateTime("$year-$month-01");
    $firstDayOfWeek = $firstDay->format('N');
    $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    echo "<tr>";
    echo "<th>So</th><th>Mo</th><th>Di</th><th>Mi</th><th>Do</th><th>Fr</th><th>Sa</th>";
    echo "</tr>";

    $dayCounter = 1;
    for ($i = 0; $i < 6; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= 7; $j++) {
            if ($i === 0 && $j < $firstDayOfWeek) {
                echo "<td></td>";
            } elseif ($dayCounter <= $daysInMonth) {
                $currentDate = "$year-$month-" . str_pad($dayCounter, 2, '0', STR_PAD_LEFT);
                echo "<td data-date='$currentDate'>";
                echo $dayCounter;
                echo "</td>";
                $dayCounter++;
            }
        }
        echo "</tr>";
    }

    // Beispiel: Füge Ereignisse zu den entsprechenden Tagen hinzu
    addEventsToCalendar($year, $month);
}

// Funktion zum Hinzufügen von Beispiel-Ereignissen
function addEventsToCalendar($year, $month) {
    // Hier könntest du die Ereignisse aus deiner Datenbank abrufen und hinzufügen
    // Beispiel: Ereignisse für den 15. und 25. Tag des Monats
    $events = [
        ["date" => "$year-$month-15", "event" => "Event 1"],
        ["date" => "$year-$month-25", "event" => "Event 2"],
    ];

    echo "<script>";
    foreach ($events as $event) {
        echo "let cell = document.querySelector('[data-date=\"{$event['date']}\"]');
              if (cell) {
                  cell.classList.add('event-cell');
                  cell.innerHTML += '<br>{$event['event']}';
              }";
    }
    echo "</script>";
}

// Hilfsfunktionen
function getMonthName($month) {
    $monthNames = [
        "Januar", "Februar", "März", "April", "Mai", "Juni",
        "Juli", "August", "September", "Oktober", "November", "Dezember"
    ];
    return $monthNames[$month - 1];
}
?>
</body>
</html>
