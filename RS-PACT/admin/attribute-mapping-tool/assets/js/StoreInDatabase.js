"use strict";

const StoreInDatabase = (() => {

    //properties
    let mappedAttributes = [];

    //cacheDOM
    let container = $('.offering');
    let globalDownloadTrigger = container.find('#global-download');
    let globalSaveTrigger = container.find('#global-save');
    let filterDownloadTrigger = container.find('#filter-download');
    let filterSaveTrigger = container.find('#filter-save');
    let externalExcel = container.find('#external-from-excel');
    let PIMexcel = container.find('#pim-excel');
    let generateConfigTrigger = container.find('#generate-config');

    
    //BindEvents
    globalSaveTrigger.click(async function (e) {
        let json_data = mappedData();
        let externalExcelName = getExcelName(externalExcel);
        let rowName = '';

        let tenant = await APIController.getActiveUser();
        let tableName = tenant.data[0].nickname.split('@');
        tableName = tableName[0];
        tableName = tableName.replaceAll(' ' , '_');
        if (UIController.isTenantConnected()) {
            rowName = tenant.data[0].name + '_' + externalExcelName;
        }
        else{
            rowName = getExcelName(PIMexcel) + '_' + externalExcelName;
        }
        
        rowName = 'global_' + rowName;
        let json = {
            json_data : json_data,
            row_name : rowName
        }

        let find = await phpAPIs.findRow(tableName , rowName);

        if (find.data != null) {
            phpAPIs.deleteRow(tableName , rowName);
            phpAPIs.addRow( tableName , JSON.stringify(json));
        }
        else{
            phpAPIs.addRow( tableName , JSON.stringify(json));
        }        
    });

    globalDownloadTrigger.click(async function (e) { 
        let json_data = mappedData();
        let externalExcelName = getExcelName(externalExcel);
        let tableName = ''

        let tenant = await APIController.getActiveUser();
        if (UIController.isTenantConnected === false) {
            let user = tenant.data[0].nickname.split('@');
            user = user[0];
            user = user.replaceAll(' ' , '_');
            tableName = user +'_' + getExcelName(PIMexcel) + '_' + externalExcelName;
        }
        else{
            let user = tenant.data[0].nickname.split('@');
            user = user[0];
            user = user.replaceAll(' ' , '_');
            tableName = user +'_' +tenant.data[0].name + '_' + externalExcelName;
        }
        
        let wb = await XLSX.utils.book_new();
        let ws = await XLSX.utils.json_to_sheet(json_data ,{header:["PIM Attribute","Datatype","External Attribute" , 'Display Name'], skipHeader:false});
        XLSX.utils.book_append_sheet(wb, ws, 'Mappings');
        XLSX.writeFile(wb, tableName+'.xlsx');
    });

    filterSaveTrigger.click(async function (e) {
        let json_data = mappedData();
        let externalExcelName = getExcelName(externalExcel);
        let rowName = '';
        let filter = filters.filteredTableName();

        let tenant = await APIController.getActiveUser();
        let tableName = tenant.data[0].nickname.split('@');
        tableName = tableName[0];
        tableName = tableName.replaceAll(' ' , '_');
        if (UIController.isTenantConnected()) {
            rowName = tenant.data[0].name + '_' + externalExcelName + filter;
        }
        else{
            rowName = getExcelName(PIMexcel) + '_' + externalExcelName + filter;
        }
        
        rowName = 'filter_' + rowName;
        let json = {
            json_data : json_data,
            row_name : rowName
        }

        let find = await phpAPIs.findRow(tableName , rowName);

        if (find.data != null) {
            phpAPIs.deleteRow(tableName , rowName);
            phpAPIs.addRow( tableName , JSON.stringify(json));
        }
        else{
            phpAPIs.addRow( tableName , JSON.stringify(json));
        }  
    });

    filterDownloadTrigger.click(async function (e) { 
        let json_data = mappedData();
        let externalExcelName = getExcelName(externalExcel);
        let tableName = '';
        let filter = filters.filteredTableName();

        let tenant = await APIController.getActiveUser();
        let user = tenant.data[0].nickname.split('@');
        user = user[0];
        user = user.replaceAll(' ' , '_');
        if (UIController.isTenantConnected === false) {
            tableName = user +'_' + getExcelName(PIMexcel) + '_' + externalExcelName + filter;
        }
        else{
            tableName = user +'_' +tenant.data[0].name + '_' + externalExcelName + filter;
        }
        let wb = await XLSX.utils.book_new();
        let ws = await XLSX.utils.json_to_sheet(json_data ,{header:["PIM Attribute","Datatype","External Attribute" , "Display Name"], skipHeader:false});
        XLSX.utils.book_append_sheet(wb, ws, 'Mappings');
        XLSX.writeFile(wb, tableName+'.xlsx');
    });

    generateConfigTrigger.click(function (e) { 
        configGenerator.generateConfig(mappedData());
    });
    //methods

    let getExcelName = (fileName) => {
        let name = fileName.val();
        let index = 0;
        for (let i = 0; i < name.length; i++) {
            if (name[i] === '\\') {
                index = i;
            } 
        }
        name = name.slice(index+1);
        name = name.slice(0 , name.indexOf('.'));
        name = name.replaceAll(' ' , '');
        return name;
    }

    let mappedData = () => {
        mappedAttributes = [];
        let dataHandle = dataTablesRenderer.tableData();
        let data = dataHandle.fnGetData();
        data.forEach(element => {
            mappedAttributes.push({
                'PIM Attribute' : element[1],
                'Datatype' : element[3],
                'External Attribute' : '',
                'Display Name' : element[2]
            })
        });

        $.each(dataHandle.fnGetNodes(), function (index, value) {
            if ($(value).find('input').val() != null && $(value).find('input').val() != undefined) {
                mappedAttributes[index]['External Attribute'] = $(value).find('input').val();
            }
        });   

        return mappedAttributes;
    }

    $('#saved-mappings').on( 'click', 'a.json', function () {
        let rowName = UIController.dataTableGetter().row($(this).closest('tr')).data()[0];
        let data = UIController.existingDataGetter();

        data.forEach(element => {
            if (rowName === element.row_name) {
                $('#generate-config').addClass('d-none');
                $('#go-to-filter2').addClass('d-none');
                $('#generate-config2').removeClass('d-none');
                UIController.tabSwitcher(4);
                existingJsonGenerator(element.json_data);
            }
        });
    } );

    let existingJsonGenerator = (dataTable) => {


        $('#generate-config2').click(function (e) {
            let configJson = [];
            let json = configGenerator.editorJson(); 
            dataTable.forEach(element => {
                let tempJson = json;
                tempJson = JSON.stringify(tempJson);
                tempJson = tempJson.replace('@@pim_attribute@@' , element['PIM Attribute']);
                tempJson = tempJson.replace('@@external_attribute@@' , element['External Attribute']);
                tempJson = tempJson.replace('@@datatype@@' , element['Datatype']);
                tempJson = JSON.parse(tempJson);
                configJson.push(tempJson);
            });

            let dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(configJson, null, 2));
            let dlAnchorElem = document.getElementById('download-config2');
            dlAnchorElem.setAttribute("href", dataStr);
            dlAnchorElem.setAttribute("download", "configFile.json");
            dlAnchorElem.click();
        });
    }

    $('#saved-mappings').on( 'click', 'a.excel', function () {
        let rowName = UIController.dataTableGetter().row($(this).closest('tr')).data()[0];
        let data = UIController.existingDataGetter();
        data.forEach(element => {
            if (rowName === element.row_name) {
                let wb = XLSX.utils.book_new();
                let ws = XLSX.utils.json_to_sheet(element.json_data ,{header:["PIM Attribute","Datatype" , "Display Name" , "External Attribute"], skipHeader:false});
                XLSX.utils.book_append_sheet(wb, ws, 'Mappings');
                XLSX.writeFile(wb, rowName+'.xlsx');
            }
        });
    } );

    

})();