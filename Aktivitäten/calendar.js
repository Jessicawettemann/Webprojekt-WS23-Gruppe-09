document.addEventListener("DOMContentLoaded", function () {
    const calendar = document.getElementById("calendar");

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

    function updateCalendar(direction) {
        const currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonth = currentDate.getMonth() + 1;

        if (direction === "prev") {
            if (currentMonth === 1) {
                currentYear--;
                currentMonth = 12;
            } else {
                currentMonth--;
            }
        } else if (direction === "next") {
            if (currentMonth === 12) {
                currentYear++;
                currentMonth = 1;
            } else {
                currentMonth++;
            }
        }

        loadCalendar(currentYear, currentMonth);
    }

    loadCalendar(new Date().getFullYear(), new Date().getMonth() + 1);

    document.getElementById("prevMonth").addEventListener("click", function () {
        updateCalendar("prev");
    });

    document.getElementById("nextMonth").addEventListener("click", function () {
        updateCalendar("next");
    });
});
