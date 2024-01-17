// Function to fetch and populate dropdown options
function populateDropdown(selectElement, data, idColumn, nameColumn) {
    selectElement.empty();
    if (data.length > 0) {
        $.each(data, function (index, item) {
            selectElement.append('<option value="' + item[idColumn] + '">' + item[nameColumn] + '</option>');
        });
    } else {
        console.log("this select has no data");
    }
}

// Function to handle dropdown change and cascading effect
function handleDropdownChange(dropdown, nextDropdown, endpoint, idColumn, nameColumn) {
    dropdown.on('change', function () {
        var selectedId = $(this).val();
        var url = 'http://localhost/TDW_PROJECT/public/' + endpoint + selectedId;
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                populateDropdown(nextDropdown, data, idColumn, nameColumn);
            },
            error: function (error) {
                console.log('Error fetching data:', error);
            }
        });
    });
}

$(document).ready(function () {
    // When the brand selection changes for any group
    $('.brand-select').on('change', function () {
        // Identify the corresponding group
        var groupId = $(this).attr('id').replace('brand', '');
        // Handle dropdown change for the corresponding group
        handleDropdownChange($(this), $('#model' + groupId), 'comparator/get_brand_models&idMarque=', 'idModele', 'nameModele');
        handleDropdownChange($('#model' + groupId), $('#version' + groupId), 'comparator/get_model_versions&idModele=', 'idVersion', 'valueVersion');
        handleDropdownChange($('#version' + groupId), $('#vehicle' + groupId), 'comparator/get_version_vehicles&idVersion=', 'idVehicle', 'name');
    });
});


