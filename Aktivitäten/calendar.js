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

    loadCalendar(new Date().getFullYear(), new Date().getMonth() + 1);

    document.getElementById("prevMonth").addEventListener("click", function () {
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth() + 1;

        let prevYear, prevMonth;
        if (currentMonth === 1) {
            prevYear = currentYear - 1;
            prevMonth = 12;
        } else {
            prevYear = currentYear;
            prevMonth = currentMonth - 1;
        }

        loadCalendar(prevYear, prevMonth);
    });

    document.getElementById("nextMonth").addEventListener("click", function () {
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth() + 1;

        let nextYear, nextMonth;
        if (currentMonth === 12) {
            nextYear = currentYear + 1;
            nextMonth = 1;
        } else {
            nextYear = currentYear;
            nextMonth = currentMonth + 1;
        }

        loadCalendar(nextYear, nextMonth);
    });
});
