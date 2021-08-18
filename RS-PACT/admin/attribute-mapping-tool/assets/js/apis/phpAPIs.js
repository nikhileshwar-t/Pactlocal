"use strict";

let phpAPIs = (() => {

    let addRow = async(tableName , jsondata) => {
        let apiResponse = null;
		await $.ajax({
			url: HTTP_SERVER + "api/attribute-mapping-tool-api.php?method=add",
			type: 'POST',
            dataType: 'text',
            data : {
                table_name : tableName,
                json_data : jsondata
            },
			async: false,
			contentType: 'application/x-www-form-urlencoded',
			success: function (response) {
                response = JSON.parse(response);
				if (response.status == "success") {
					apiResponse = response;
				}
			}
        });
    }

    let findRow = async(tableName , rowName) => {
        let apiResponse = null;
		await $.ajax({
			url: HTTP_SERVER + "api/attribute-mapping-tool-api.php?method=get",
			type: 'POST',
            dataType: 'text',
            data : {
                table_name : tableName,
                row_name : rowName
            },
			async: false,
			contentType: 'application/x-www-form-urlencoded',
			success: function (response) {
                response = JSON.parse(response);
				if (response.status == "success") {
					apiResponse = response;
				}
			}
        });
        return apiResponse;
    }

    let deleteRow = async(tableName , rowName) => {
        let apiResponse = null;
		await $.ajax({
			url: HTTP_SERVER + "api/attribute-mapping-tool-api.php?method=delete",
			type: 'POST',
            dataType: 'text',
            data : {
                table_name : tableName,
                row_name : rowName
            },
			async: false,
			contentType: 'application/x-www-form-urlencoded',
			success: function (response) {
                response = JSON.parse(response);
				if (response.status == "success") {
					apiResponse = response;
                }
			}
        });
    }

    let getTable = async(tableName) => {
        let apiResponse = null;
		await $.ajax({
			url: HTTP_SERVER + "api/attribute-mapping-tool-api.php?method=get_all",
			type: 'POST',
            dataType: 'text',
            data : {
                table_name : tableName
            },
			async: false,
			contentType: 'application/x-www-form-urlencoded',
			success: function (response) {
                response = JSON.parse(response);
				if (response.status == "success") {
					apiResponse = response;
                }
			}
        });
        return apiResponse.data;
    }

    return {
        addRow : addRow,
        findRow : findRow,
        deleteRow : deleteRow,
        getNames : getTable
    }

})();