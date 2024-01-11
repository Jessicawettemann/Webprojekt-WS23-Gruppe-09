document.addEventListener("DOMContentLoaded", function () {
    const calendar = document.getElementById("calendar");
    let currentYear = new Date().getFullYear();
    let currentMonth = new Date().getMonth() + 1;

    function loadCalendar(year, month) {
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                calendar.innerHTML = xhr.responseText;
            }
        };

        xhr.open("GET", `calendar.php?year=${year}&month=${month}`, true);
        xhr.send();
    }

    function updateCalendar() {
        loadCalendar(currentYear, currentMonth);
    }

    function prevMonth() {
        if (currentMonth === 1) {
            currentYear--;
            currentMonth = 12;
        } else {
            currentMonth--;
        }

        updateCalendar();
    }

    function nextMonth() {
        if (currentMonth === 12) {
            currentYear++;
            currentMonth = 1;
        } else {
            currentMonth++;
        }

        updateCalendar();
    }

    loadCalendar(currentYear, currentMonth);

    document.getElementById("prevMonth").addEventListener("click", prevMonth);

    document.getElementById("nextMonth").addEventListener("click", nextMonth);
});
