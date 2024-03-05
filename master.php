<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Branch</title>
    <style>

   /* .roomdesc{
    border: 1px solid;
    width: 50%;
    margin: 0px auto;
    height: 500px;
   }
   .roomlist{
    border: 1px solid;
    height: 370px;
    width: 90%;
    margin: 0px auto;
   } */
   .navbar{
    /* border: 1px solid; */
    width: 100%;
    background-color: #34495e;
    display: flex;
    flex-wrap: wrap;
    /* grid-template-columns: 1fr 1fr 1fr 1fr 1fr; */

   }
   .navbar button{
    margin: 5px 40px;
    border-radius: 5px;
    background-color:  #e74c3c ;
    /* margin: 5px 30px 5px 30px; */

   }
    </style>
</head>

<body>
    <div id="sidebar"></div>
    <div class="content" id="contentmaster">
        <div class="navbar">
            <div class="navbar">
                <button onclick="roomdescriptionmaster()"><b>Room Description Master</b></button>
                <button onclick="roomtypemaster()"><b>Room Type Master</b></button>
                <button onclick="billinstruction()"><b>Bill Instruction</b></button>
                <button onclick="creditcardmaster()"><b>Credit Card Master</b></button>
                <button onclick="currencymaster()"><b>Currency Master</b></button>
                <button onclick="categorymaster()"><b>Category Master</b></button>
                <button onclick="companymaster()"><b>Company Master</b></button>
                <button onclick="packagemaster()"><b>Package Master</b></button>
                <button onclick="countrymaster()"><b>Country Master</b></button>
                <button onclick="CGSTandSGST()"><b>CGST and SGST</b></button>
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

        function roomdescriptionmaster() {
            const roomDiscriptionMaster = `
                <div id="roomDiscriptionMaster" class="roomdesc">
                    <h2><b> Room Discription List</b></h2>
                  <div class="roomlist">
                    <label for="code">Code:</label>
                    <input type="text" id="code"> <br> 
                    <label for="description">Description</label>
                    <input type="text" id="description"> <br>
                    <button onclick="insertRoomType()">Insert</button>
                    <button onclick="modifyRoomType()">Modify</button>
                    <button onclick="deleteRoomType()">Delete</button>
                    <button onclick="viewRoomTypes()">View</button>
                    <button onclick="closeFunctionality()">Close</button>
                  </div>
                </div>
            `;
            document.getElementById('output').innerHTML = roomDiscriptionMaster;
        }

        const roomTypes = [];

        function insertRoomType() {
            const roomTypeInput = document.getElementById('roomType');
            const newRoomType = roomTypeInput.value.trim();

            if (newRoomType) {
                roomTypes.push(newRoomType);
                roomTypeInput.value = '';
                displayOutput('Room type inserted: ' + newRoomType);
            } else {
                displayOutput('Please enter a room type.');
            }
        }

        function modifyRoomType() {
            const roomTypeInput = document.getElementById('roomType');
            const existingRoomType = roomTypeInput.value.trim();

            if (existingRoomType) {
                const index = roomTypes.indexOf(existingRoomType);
                if (index !== -1) {

                    roomTypes[index] = existingRoomType;
                    displayOutput('Room type modified: ' + existingRoomType);
                } else {
                    displayOutput('Room type not found.');
                }
            } else {
                displayOutput('Please enter a room type.');
            }
        }

        function deleteRoomType() {
            const roomTypeInput = document.getElementById('roomType');
            const existingRoomType = roomTypeInput.value.trim();

            if (existingRoomType) {
                const index = roomTypes.indexOf(existingRoomType);
                if (index !== -1) {
                    roomTypes.splice(index, 1);
                    displayOutput('Room type deleted: ' + existingRoomType);
                } else {
                    displayOutput('Room type not found.');
                }
            } else {
                displayOutput('Please enter a room type.');
            }
        }

        function viewRoomTypes() {
            displayOutput('Room Types: ' + roomTypes.join(', '));
        }

        function closeFunctionality() {
            displayOutput('Closing Room Type Master functionality.');

        }

        function displayOutput(message) {
            const outputDiv = document.getElementById('output');
            outputDiv.innerHTML = message;
        }

        function roomtypemaster() {
            const roomTypeMaster = `
                <div id="roomTypeMastertion">
                    <h2><b> Room Type List</b></h2>
                  <div class="roomlist">
                    <label for="roomcode">Room Code:</label>
                    <input type="text" id="roomcode"> <br> 
                    <label for="description">Description:</label>
                    <input type="text" id="descritption"> <br>
                    <h3><b>Rate Information</b></h3>
                    <label for="single">Single Room:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="double">Double Room:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="dulexe">Dulexe Room:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="executive">Executive Suite:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="presidentail"> Presidentail Suite:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <h3><b>Summary </b></h3>
                    <label for="single">Single Room:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="double">Double Room:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="dulexe">Dulexe Room:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="executive">Executive Suite:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>
                    <label for="presidentail"> Presidentail Suite:</label>
                    <input type="text" id=""> 
                    <input type="text" id=""> <br>                   
                  </div>
                </div>
            `;
            document.getElementById('output').innerHTML = roomTypeMaster;
        }

        function billinstruction() {
            const billInstruction = `
                <div id="billInstruction">
                    <h2><b>Bill Instruction List</b></h2>
                  <div class="roomlist">
                    <label for="code">Code:</label>
                    <input type="text" id="code"> <br> 
                    <label for="description">Description:</label>
                    <input type="text" id="descritption"> <br>
                    <button onclick="insertRoomType()">Insert</button>
                    <button onclick="modifyRoomType()">Modify</button>
                    <button onclick="deleteRoomType()">Delete</button>
                    <button onclick="viewRoomTypes()">View</button>
                    <button onclick="closeFunctionality()">Close</button>
                  </div>
                </div>
            `;
            document.getElementById('output').innerHTML = billInstruction;
        }


        function creditcardmaster() {
            // Define the function for Credit Card Master here
        }

        function currencymaster() {
            // Define the function for Currency Master here
        }

        function categorymaster() {
            // Define the function for Category Master here
        }

        function companymaster() {
            // Define the function for Company Master here
        }

        function packagemaster() {
            // Define the function for Package Master here
        }

        function countrymaster() {
            // Define the function for Country Master here
        }

        function CGSTandSGST() {
            // Define the function for CGST and SGST here
        }
    </script>
</body>

</html>