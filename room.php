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
            const rows = 7;
            const cols = 8;
            const table = document.createElement("table");
            let counter = 101;

            for (let i = 0; i < rows; i++) {
                const tr = table.insertRow(-1);
                for (let j = 0; j < cols; j++) {
                    const cell = tr.insertCell(-1);
                    cell.textContent = counter++;
                }
            }
            document.getElementById("table-container").appendChild(table);
        }

        includeContent('menu.html', 'sidebar');
        createEmptyTable();
    </script>
</body>

</html>
