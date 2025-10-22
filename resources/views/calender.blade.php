<style>
    .calendar {
        width: 100%;
        height: 100%;
        color: black;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 9px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }

    .calendar-header button {
        background-color: transparent;
        border: none;
        /* font-size: 0.8em; */
        cursor: pointer;
    }

    #month-year {
        /* font-size: 1.2em; */
        font-weight: bold;
    }

    .calendar-weekdays,
    .calendar-dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }

    .calendar-weekdays div,
    .calendar-dates div {
        text-align: center;
        padding: 10px;
    }

    .calendar-weekdays {
        background-color: #eaeef3;
    }

    .calendar-weekdays div {
        font-weight: bold;
    }

    .calendar-dates div {
        cursor: pointer;
    }

    .calendar-dates div:hover {
        background-color: #f1f1f1;
    }
</style>
<div class="calendar">
    <div class="calendar-header">
        <button id="prev-month">‹</button>
        <div id="month-year"></div>
        <button id="next-month">›</button>
    </div>
    <div class="calendar-body">
        <div class="calendar-weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div class="calendar-dates">
        </div>
    </div>
</div>
<script>
    const calendarDates = document.querySelector('.calendar-dates');
    const monthYear = document.getElementById('month-year');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');

    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();

    const months = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];

    function renderCalendar(month, year) {
        const firstDay = new Date(year, month, 1).getDay();
        const lastDate = new Date(year, month + 1, 0).getDate();

        calendarDates.innerHTML = '';

        for (let i = 0; i < firstDay; i++) {
            const dateDiv = document.createElement('div');
            calendarDates.appendChild(dateDiv);
        }

        for (let i = 1; i <= lastDate; i++) {
            const dateDiv = document.createElement('div');
            dateDiv.textContent = i;
            if (i === currentDate.getDate() && year === currentDate.getFullYear() && month === currentDate.getMonth()) {
                dateDiv.style.color = 'red';
            }
            calendarDates.appendChild(dateDiv);
        }

        monthYear.textContent = `${months[month]} ${year}`;
    }

    renderCalendar(currentMonth, currentYear);

    prevMonthBtn.addEventListener('click', () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentMonth, currentYear);
    });

    nextMonthBtn.addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentMonth, currentYear);
    });
</script>