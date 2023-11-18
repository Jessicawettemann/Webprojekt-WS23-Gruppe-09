<?php
include "Header Sicherheit.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminkalender</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Hier können Sie Termine festlegen oder aus einer Datenquelle abrufen
$appointments = array(
    "2023-11-01" => array("Meeting 1", "Appointment"),
    "2023-11-05" => array("Coffee with friend", "Conference call"),
    "2023-11-10" => array("Lunch meeting"),
    // ... weitere Termine
);

echo '<div id="calendar">';

// Wochentage
$daysOfWeek = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

// Aktuelles Datum
$currentDate = new DateTime();

// Monat und Jahr des aktuellen Datums
$currentMonth = $currentDate->format('n');
$currentYear = $currentDate->format('Y');

// Tage im aktuellen Monat
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Erster Tag des Monats
$firstDayOfMonth = new DateTime("$currentYear-$currentMonth-01");
$firstDayOfWeek = $firstDayOfMonth->format('N');

// Kalenderkopf erstellen
echo '<div class="day">Week</div>';
foreach ($daysOfWeek as $day) {
    echo '<div class="day">' . $day . '</div>';
}

// Leere Zellen für den Anfang des Monats hinzufügen
for ($i = 1; $i < $firstDayOfWeek; $i++) {
    echo '<div class="day"></div>';
}

// Tage des Monats hinzufügen
for ($day = 1; $day <= $daysInMonth; $day++) {
    $currentDateStr = "$currentYear-$currentMonth-" . sprintf('%02d', $day);
    $appointmentsForDay = $appointments[$currentDateStr] ?? [];

    echo '
        <div class="day" data-date="' . $currentDateStr . '">
            <div>' . $day . '</div>
            <ul class="events">
                ' . implode('', array_map(function ($appointment) {
                    return '<li>' . $appointment . '</li>';
                }, $appointmentsForDay)) . '
            </ul>
        </div>';
}

echo '</div>';


//hier folgt JavaScript Code:

document.addEventListener("DOMContentLoaded", function () {
    // Ereignislistener für Klick auf einen Tag hinzufügen
    const days = document.querySelectorAll(".day");
    days.forEach(day => {
        day.addEventListener("click", handleDayClick);
    });
});

function handleDayClick(event) {
    const selectedDate = event.currentTarget.getAttribute("data-date");
    alert(`Termine für ${selectedDate}`);
    // Hier können Sie weitere Aktionen für den ausgewählten Tag implementieren
}


?>