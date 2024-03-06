<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Branch</title>
    <style>
        /* .navbar {
            width: 100%;
            background-color: #34495e;
            display: flex;
            flex-wrap: wrap;
        }

        .navbar button {
            margin: 5px 40px;
            border-radius: 5px;
            background-color: #e74c3c;
        } */


        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            width: 100%;
            background-color: #34495e;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 10px 0;
        }

        .navbar button {
            margin: 5px;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #e74c3c;
            color: white;
            cursor: pointer;
            border: none;
        }

        .navbar button:hover {
            background-color: #c0392b;
        }

        #output {
            padding: 20px;
        }

        .commontable {
            margin-top: 20px;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin-top: 10px;
        }
            
        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button-container button:hover {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>

<body>
    <div id="sidebar"></div>
    <div class="content" id="contentmaster">
        <div class="navbar">
            <div class="navbar">
                <button onclick="roomdescriptionmaster()"><b>Room Description Master</b></button>
                <button onclick="billinstruction()"><b>Bill Instruction</b></button>
                <button onclick="creditcardmaster()"><b>Credit Card Master</b></button>
                <button onclick="currencymaster()"><b>Currency Master</b></button>
                <button onclick="companymaster()"><b>Company Master</b></button>
                <button onclick="countrymaster()"><b>Country Master</b></button>
                <button onclick="packagemaster()"><b>Package Master</b></button>
                <button onclick="CGSTandSGST()"><b>CGST and SGST</b></button>
                <!-- <button onclick="roomtypemaster()"><b>Room Type Master</b></button> -->
                <!-- <button onclick="categorymaster()"><b>Category Master</b></button> -->
            </div>
        </div>
        <div id="output"></div>

    </div>

    <script>
        function includeContent(url, targetId) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(targetId).innerHTML =
                        data;
                })
                .catch(error => {
                    console.error('Error loading content:', error);
                });
        }

        includeContent('menu.html', 'sidebar');

        // function roomdescriptionmaster() {
        //     const roomDiscriptionMaster = `
        // <div id="roomDiscriptionMaster">
        //     <h2><b> Room Description List</b></h2>
        //  <div class = commontable>
        //     <table>
        //         <tr>
        //             <th>Code</th>
        //             <th>Description</th>
        //         </tr>                
        //     </table>

        //     <div class="button-container">
        //         <button onclick="insert()">Insert</button>
        //         <button onclick="modify()">Modify</button>
        //         <button onclick="delete()">Delete</button>
        //         <button onclick="view()">View</button>
        //         <button onclick="close()">Close</button>
        //     </div>
        //  </div> 
        //  </div>           
        // `;
        //      document.getElementById('output').innerHTML = roomDiscriptionMaster;
        // }   




        function roomdescriptionmaster() {
            const roomDiscriptionMaster = `
        <div id="roomDiscriptionMaster">
            <h2><b> Room Description List</b></h2>
            <div class="commontable">
                <table id="roomTable">
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <div class="button-container">
                    <button onclick="insert()">Insert</button>
                    <button onclick="modify()">Modify</button>
                    <button onclick="deleteRow()">Delete</button>
                    <button onclick="view()">View</button>
                    <button onclick="close()">Close</button>
                </div>
            </div>
        </div>           
    `;
            document.getElementById('output').innerHTML = roomDiscriptionMaster;
        }

        function insert() {
            const table = document.getElementById('roomTable');

            const newRow = table.insertRow(table.rows.length);

      
            const cell1 = newRow.insertCell(0);
            const cell2 = newRow.insertCell(1);

            cell1.innerHTML = '<input type="text" name="code">';
            cell2.innerHTML = '<input type="text" name="description">';
        }


        function billinstruction() {
            const billInstruction = `
            <div id="billInstruction">
             <h2><b>Bill Instruction List</b></h2>
               <div class = commontable>
                  <table>
                    <tr>
                     <th>Code</th>
                     <th>Description</th>
                    </tr>
                  </table>
                <div class="button-container">
                  <button onclick="insert()">Insert</button>
                  <button onclick="modify()">Modify</button>
                  <button onclick="delete()">Delete</button>
                  <button onclick="view()">View</button>
                  <button onclick="close()">Close</button>
                </div>
               </div> 
            </div>
            `;
            document.getElementById('output').innerHTML = billInstruction;
        }


        function creditcardmaster() {
            const creditCard = `
        <div id="creditCard">
            <h2><b>Credit Card List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Card Limit</th>
                    <th>Commission</th>
                </tr>
                
            </table>
            <div class="button-container">
                <button onclick="insert()">Insert</button>
                <button onclick="modify()">Modify</button>
                <button onclick="delete()">Delete</button>
                <button onclick="view()">View</button>
                <button onclick="close()">Close</button>
            </div>
         </div> 
        </div>           
    `;
            document.getElementById('output').innerHTML = creditCard;
        }


        function currencymaster() {
            const currency = `
        <div id="currency">
            <h2><b>Currency List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Country Name</th>
                    <th>Currency of Country</th>
                </tr>
                
            </table>
            <div class="button-container">
                <button onclick="insert()">Insert</button>
                <button onclick="modify()">Modify</button>
                <button onclick="delete()">Delete</button>
                <button onclick="view()">View</button>
                <button onclick="close()">Close</button>
            </div>
         </div> 
        </div>           
    `;
            document.getElementById('output').innerHTML = currency;
        }

        function companymaster() {
            const company = `
        <div id="company">
            <h2><b>Company List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Company Name</th>
                    <th>Company Code</th>
                    <th>City</th>                    
                </tr>
                
            </table>
            <div class="button-container">
                <button onclick="insert()">Insert</button>
                <button onclick="modify()">Modify</button>
                <button onclick="delete()">Delete</button>
                <button onclick="view()">View</button>
                <button onclick="close()">Close</button>
            </div>
         </div> 
        </div>           
    `;
            document.getElementById('output').innerHTML = company;

        }



        function countrymaster() {
            const country = `
        <div id="country">
            <h2><b>Country List</b></h2>
            <div class = commontable>
            <table>
                <tr>
                    <th>Country Code</th>
                    <th>Name of Country</th>
                </tr>
                
            </table>
            <div class="button-container">
                <button onclick="insert()">Insert</button>
                <button onclick="modify()">Modify</button>
                <button onclick="delete()">Delete</button>
                <button onclick="view()">View</button>
                <button onclick="close()">Close</button>
            </div>
         </div> 
        </div>           
    `;
            document.getElementById('output').innerHTML = country;
        }

        function packagemaster() {
            
        }

        function CGSTandSGST() {
            
        }
        // function roomtypemaster() {}
        // function categorymaster() {}
    </script>

</body>

</html>   