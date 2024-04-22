<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Occupancy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
        }
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
        }
        .navbar {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .navbar label {
            margin: 0 10px;
        }
        .navbar input[type="date"] {
            width: 150px;
        }
        .navbar button {
            margin-left: 20px;
        }
        .date-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
         .date-table td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        .date-table th {
            border: 1px solid black;
            background-color: #f2f2f2;
        }
        .date-controls {
            display: flex;
            align-items: center;
            margin-left: auto;
        }
        .date-controls button {
            margin-left: 10px;
            padding: 8px 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div id="sidebar"></div>
    <div class="container">
        <h1>Occupancy</h1>
        <div class="navbar">
            <label for="start_date">From</label>
            <input type="date" id="start_date">
            <label for="end_date">To</label>
            <input type="date" id="end_date">
            <button id="reservation">Reservation</button>
            <button id="registration">Registration</button>
            <button id="closeButton">Close</button>
        </div>
        <table class="date-table">
            <thead>
                <tr>
                    <th>Room Type</th>
                </tr>
            </thead>
            <tbody id="date_container">
            </tbody>
        </table>
    </div>
    <script>
        function populateDates() {
            const fromDateInput = document.getElementById('start_date');
            const toDateInput = document.getElementById('end_date');
            const dateContainer = document.getElementById('date_container');

            dateContainer.innerHTML = '';

            const fromDate = new Date(fromDateInput.value);

            const headerRow = document.querySelector('.date-table thead tr');
            headerRow.innerHTML = '<th>Room Type</th><th>Status</th>';

            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            for (let i = 0; i < 7; i++) {
                const futureDate = new Date(fromDate);
                futureDate.setDate(fromDate.getDate() + i);
                const dayName = days[futureDate.getDay()];
                const year = futureDate.getFullYear();
                const month = String(futureDate.getMonth() + 1).padStart(2, '0');
                const day = String(futureDate.getDate()).padStart(2, '0');

                const th = document.createElement('th');
                const formattedDate = isNaN(futureDate.getTime()) ? '' : `${dayName ? dayName + '<br>' : ''}${day}-${month}-${year}`;
                th.innerHTML = formattedDate;
                headerRow.appendChild(th);
            }

            toDateInput.min = fromDateInput.value;
            toDateInput.value = getDate(7);

            populateRoomTypes();
        }

        function populateRoomTypes() {
            const roomTypes = ['Single Room Non-AC', 'Double Room Non-AC', 'Single Room AC', 'Double Room AC', 'Deluxe Room AC', 'Executive Room AC', 'President Suite AC'];
            const tbody = document.getElementById('date_container');
            const occupancyStatus = ['Reserved', 'Occupied', 'Available'];

            for (let i = 0; i < roomTypes.length; i++) {
                const roomType = roomTypes[i];

                for (let j = 0; j < 3; j++) {
                    const row = document.createElement('tr');

                    if (j === 0) {
                        const roomTypeCell = document.createElement('td');
                        roomTypeCell.textContent = roomType;
                        roomTypeCell.rowSpan = 3;
                        row.appendChild(roomTypeCell);
                    }

                    const occupancyCell = document.createElement('td');
                    occupancyCell.textContent = occupancyStatus[j];
                    row.appendChild(occupancyCell);

                    for (let k = 0; k < 7; k++) {
                        const emptyCell = document.createElement('td');
                        row.appendChild(emptyCell);
                    }

                    tbody.appendChild(row);
                }
            }
        }

        function getDate(days) {
            const date = new Date();
            date.setDate(date.getDate() + days);
            return date.toISOString().split('T')[0];
        }

        document.addEventListener('DOMContentLoaded', populateDates);
        document.getElementById('start_date').addEventListener('change', populateDates);
        document.getElementById('end_date').addEventListener('change', function() {
            document.getElementById('start_date').max = this.value;
        });

        function includeContent(url, targetId) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(targetId).innerHTML = data;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                });
        }

        includeContent('menu.html', 'sidebar');
    </script>
</body>
</html>
