<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <?php
        include "view/nav.php";
    ?>

    <h1>Api Data</h1>

    <h1>Super Data Management</h1>

    <!-- Form to select action and trigger corresponding function -->
    <form id="superForm">
        <label for="actionSelect">Select Action:</label>
        <select id="actionSelect" name="action">
            <option value="get">Get Super Data</option>
            <option value="add">Add Super Data</option>
            <option value="edit">Edit Super Data</option>
            <option value="delete">Delete Super Data</option>
        </select>

        <label for="superName">Super Name:</label>
        <input type="text" id="superName" name="superName" placeholder="Enter Super Name">

        <label for="imageName">Image Name:</label>
        <input type="text" id="imageName" name="imageName" placeholder="Enter Image Name">

        <label for="superId">Super ID (for Edit/Delete):</label>
        <input type="text" id="superId" name="superId" placeholder="Enter Super ID">

        <button type="button" onclick="handleFormSubmit()">Submit</button>
    </form>

    <!-- Display area for Super Data -->
    <div id="Info"></div>

    <script>
                // Function to handle form submission
                function handleFormSubmit() {
            // Get the selected action, Super ID, Super Name, and Image Name from the form
            var selectedAction = document.getElementById("actionSelect").value;
            var superId = document.getElementById("superId").value;
            var superName = document.getElementById("superName").value;
            var imageName = document.getElementById("imageName").value;

            // Call the handleSuperData function with the selected action, Super ID, Super Name, and Image Name
            handleSuperData(selectedAction, superId, superName, imageName);
        }

        // Function to handle form submission
        function handleSuperData(action, superId, superName, imageName) {
            switch (action) {
                case "add":
                    addSuperData(superName, imageName);
                    break;

                case "edit":
                    editSuperData(superId, superName, imageName);
                    break;

                case "delete":
                    deleteSuperData(superId);
                    break;

                default:
                getSuperData();
                    break;
            }
        }

        // Function to call axios and get all of the data then display it
        function getSuperData() {
            axios.get('model/supersapi.php')
                .then(function (response) {
                    const supers = response.data;
                    console.log(supers);
                    let html = '<ul>';
                    supers.forEach(superData => {
                        html += `<li>${superData.Super_ID}: ${superData.Super_Name}</li>`;
                        html += `<img src="view/img/${superData.Super_Image}.png" alt="${superData.Super_Name}SuperImage" style="width:400px;height:600px;">`;
                    });
                    html += '</ul>';
                    document.getElementById('Info').innerHTML = html;
                })
                .catch(function (error) {
                    console.log("NOPE" + error);
                });
        }

        // Function to call axios and then add a superhero
        function addSuperData(superName, imageName) {
            axios.get('model/supersapi.php?action=add&superName=' + superName + '&imageName=' + imageName)
                .then(function (response) {
                    const supers = response.data;
                    console.log(supers);
                    let html = '<ul>';
                        html += supers;
                    html += '</ul>';
                    document.getElementById('Info').innerHTML = html;
                })
                .catch(function (error) {
                    console.log("NOPE" + error);
                });
        }

        // Function to call axios and then edit and existing superhero
        function editSuperData(superId, superName, imageName) {
            axios.get('model/supersapi.php?action=edit&superId=' + superId + '&superName=' + superName + '&imageName=' + imageName)
                .then(function (response) {
                    const supers = response.data;
                    console.log(supers);
                    let html = '<ul>';
                        html += 'updated super';
                    html += '</ul>';
                    document.getElementById('Info').innerHTML = html;
                })
                .catch(function (error) {
                    console.log("NOPE" + error);
                });
        }

        // Function to delete a superHero based on a given ID
        function deleteSuperData(superId) {
            axios.get('model/supersapi.php?action=delete&superId=' + superId)
                .then(function (response) {
                    const supers = response.data;
                    console.log(supers);
                    let html = '<ul>';
                        html += 'Deleted super';
                    html += '</ul>';
                    document.getElementById('Info').innerHTML = html;
                })
                .catch(function (error) {
                    console.log("NOPE" + error);
                });
        }
    </script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>