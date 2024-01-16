
// Function to fetch and populate dropdown options
function populateDropdown(selectElement, data, idColumn, nameColumn) {
    // selectElement.innerHTML = ''; // Clear existing options
    // Remove all options except the first one ("Select")
    while (selectElement.options.length > 0) {
        selectElement.remove(1);
    }
    // var selectOption = document.createElement('option');
    // selectOption.value = ''; // Value attribute
    // selectOption.text = 'Select'; // Text content
    // selectOption.selected = true;
    // selectElement.appendChild(selectOption);

    data.forEach(function (item) {
        var option = document.createElement('option');
        option.value = item[idColumn];
        option.textContent = item[nameColumn];
        selectElement.appendChild(option);
    });
}

// Function to handle dropdown change and cascading effect
function handleDropdownChange(dropdown, nextDropdown, endpoint, idColumn, nameColumn) {
    dropdown.addEventListener('change', function () {
        var selectedId = dropdown.value;
        console.log(selectedId);
        var url = 'http://localhost/TDW_PROJECT/public/' + endpoint + selectedId;

        fetch(url)
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                populateDropdown(nextDropdown, data, idColumn, nameColumn);
            })
            .catch(function (error) {
                console.log('Error fetching data:', error);
            });
    })
}

// Fetch and populate brand dropdown initially for all groups
fetch('http://localhost/TDW_PROJECT/public/comparator/get_brands')
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
        // Populate brand dropdown for all groups
        document.querySelectorAll('.brand-select').forEach(function (selectElement) {
            populateDropdown(selectElement, data, 'idMarque', 'nameMarque');
        });

        // When any brand selection changes
        document.querySelectorAll('.brand-select').forEach(function (brandSelect) {
            brandSelect.addEventListener('change', function () {
                // Identify the corresponding group
                var groupId = this.id.replace('brand', '');

                // Clear the options in the dependent dropdowns
                document.getElementById('model' + groupId).innerHTML = '';
                document.getElementById('version' + groupId).innerHTML = '';
                document.getElementById('vehicle' + groupId).innerHTML = '';

                // Handle dropdown change for the corresponding group
                handleDropdownChange(document.getElementById('version' + groupId), document.getElementById('vehicle' + groupId), 'comparator/get_version_vehicles?idVersion=', 'idVehicle', 'name');
                handleDropdownChange(document.getElementById('model' + groupId), document.getElementById('version' + groupId), 'comparator/get_model_versions&idModel=', 'idVersion', 'valueVersion');
                handleDropdownChange(this, document.getElementById('model' + groupId), 'comparator/get_brand_models?idMarque=', 'idModele', 'nameModele');
            });
        });
    })
    .catch(function (error) {
        console.log('Error fetching brands:', error);
    });

