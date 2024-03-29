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

        .date-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .date-box {
            flex: 0 0 100px;
            border: 1px solid black;
            padding: 10px;
            margin: 5px;
            text-align: center;
            white-space: nowrap; 
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
        </div>

        <div class="date-container" id="date_container">
            <!-- Dates will be dynamically populated here -->
        </div>
    </div>

    <script>
        function populateDates() {
            const fromDateInput = document.getElementById('start_date');
            const toDateInput = document.getElementById('end_date');
            const dateContainer = document.getElementById('date_container');

            dateContainer.innerHTML = '';

            const fromDate = new Date(fromDateInput.value);

            if (isNaN(fromDate.getTime())) {
                console.error('Invalid "From" date selected');
                return;
            }

            for (let i = 0; i < 7; i++) {
                const futureDate = new Date(fromDate);
                futureDate.setDate(fromDate.getDate() + i);
                const dayName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'][futureDate.getDay()];
                const year = futureDate.getFullYear();
                const month = String(futureDate.getMonth() + 1).padStart(2, '0');
                const day = String(futureDate.getDate()).padStart(2, '0');
                const dateBox = document.createElement('div');
                dateBox.classList.add('date-box');
                dateBox.innerHTML = `${dayName} ${day}-${month}-${year}`; // Displaying day and date in one line
                dateContainer.appendChild(dateBox);
            }

            toDateInput.min = fromDateInput.value;
            toDateInput.value = getDate(7); // Automatically setting the "To" date
        }

        document.addEventListener('DOMContentLoaded', function () {
            populateDates();
        });

        document.getElementById('start_date').addEventListener('change', function () {
            populateDates();
        });

        document.getElementById('end_date').addEventListener('change', function () {
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
