<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Reservation</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 20px;
            text-align: left;
            font-size: 18px;
            min-width: 100px;
            height: 50px;
            background-color: #e0e0e0;
            cursor: pointer;
        }

        th {
            background-color: #a2b9bc;
        }
    </style>
</head>

<body>
    <div id="sidebar"></div>
    <div id="table-container"></div>

    <script>
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

        function createEmptyTable() {
            const rows = 2;
            const cols = 7;
            const table = document.createElement("table");
            let counter = 101;
            let roomType = ['Single Room AC', 'Double Room AC', 'Single Room Non-AC', 'Double Room Non-AC', 'Deluxe Room AC', 'Executive Room AC', 'President Suite AC'];
            let typeIndex = 0;

            for (let i = 0; i < rows; i++) {
                const tr = table.insertRow(-1);
                for (let j = 0; j < cols; j++) {
                    const cell = tr.insertCell(-1);
                    if (counter <= 114) {
                        cell.textContent = counter;
                        cell.innerHTML += "<br>" + roomType[typeIndex];
                        cell.setAttribute('data-room-number', counter);
                        cell.setAttribute('data-room-type', roomType[typeIndex]); // Add room type as data attribute
                        cell.addEventListener('click', function() {
                            window.location.href = 'check.php?room=' + this.getAttribute('data-room-number') + '&type=' + encodeURIComponent(this.getAttribute('data-room-type'));
                        });
                        counter++;
                        if ((counter - 101) % 2 === 0) {
                            typeIndex = (typeIndex + 1) % roomType.length;
                        }
                    }
                }
            }
            document.getElementById("table-container").appendChild(table);
        }

        includeContent('menu.html', 'sidebar');
        createEmptyTable();
    </script>
</body>

</html>