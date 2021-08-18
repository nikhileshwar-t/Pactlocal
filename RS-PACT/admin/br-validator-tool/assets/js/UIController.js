"use strict";

const UIController = (() => {

    //properties
    let tenantData = null;
    let dataModelData = null;
    let tenantBRs = [];
    let selectedFile = null;
    let fileName = null;
    let finalResponse = null;
    //cacheDOM
    let container = $('.main');
    let renderTenant = container.find('#renderTenant')
    let renderModel = container.find('#renderModel');
    let nextTrigger = container.find('#next');
    let prevTrigger = container.find('#prev');
    let toggler = container.find('#toggler');
    let firstPage = container.find('#first')
    let secondPage = container.find('#second');

    let toggleValue = $('input[name="toggler"]:checked').val();

    //DOM events
    $('input[type=radio][name="toggler"]').change(function () {
        toggleValue = $('input[name="toggler"]:checked').val();
        if (toggleValue === 'tenant') {
            renderModel.addClass('d-none');
            renderTenant.removeClass('d-none');
        }

        if (toggleValue === 'governmodel') {
            renderTenant.addClass('d-none');
            renderModel.removeClass('d-none');
        }

    });

    document.getElementById('input').addEventListener("change", (event) => {
       
        selectedFile = event.target.files[0];
        fileName = event.target.files[0].name;
    });

    document.addEventListener("DOMContentLoaded", async function () {

        try {
            let tenant = await APIController.getActiveUser();
            let data = await APIController.readFile('/assets/resources/getBRs.json');
            let tenantDataResponse = JSON.parse(await APIController.sendRequest(data));

            let BR_Array = tenantDataResponse.response.entityModels;

            for (let i = 0; i < BR_Array.length; i++) {

                let obj = {
                    ACTION: '',
                    NAME: '',
                    TYPE: '',
                    'EXECUTION MODE': '',
                    'IS ENABLED?': '',
                    DEFINITION: '',
                    'DISPLAY NAME': '',
                    'HELP TEXT': ''
                }

                if (BR_Array[i].data.attributes) {
                    obj.ACTION = BR_Array[i].data.attributes.isDeleted.values[0].value ? 'DELETE' : '' ;
                    obj.NAME = BR_Array[i].id.split('_')[0];
                    obj.TYPE = BR_Array[i].data.attributes.ruleType ? BR_Array[i].data.attributes.ruleType.values[0].value : '';
                    obj["EXECUTION MODE"] = BR_Array[i].data.attributes.executionMode ? BR_Array[i].data.attributes.executionMode.values[0].value : '';
                    obj["IS ENABLED?"] = BR_Array[i].data.attributes.enabled ? BR_Array[i].data.attributes.enabled.values[0].value : '';
                    obj.DEFINITION = BR_Array[i].data.attributes.definition ? BR_Array[i].data.attributes.definition.values[0].value : '';
                    obj["DISPLAY NAME"] = BR_Array[i].data.attributes.name ? BR_Array[i].data.attributes.name.values[0].value : '';
                    obj["HELP TEXT"] = BR_Array[i].data.attributes.description ? BR_Array[i].data.attributes.description.values[0].value : '';
                }
                tenantBRs.push(obj);
            }

        }
        catch (error) {
            console.warn(error);
        }
        
    });

    nextTrigger.click(async function (e) {
        toggler.hide();
        firstPage.hide();
        secondPage.show();
        if (toggleValue === 'tenant') {
            fileName = await APIController.tenantName()
            finalResponse = await ValidationController.validate(tenantBRs);
        }

        if (toggleValue === 'governmodel') {
            readExcel();
        }
    });

    prevTrigger.click(function (e) {
        toggler.show();
        firstPage.show();
        secondPage.hide();
    });

    const readExcel = async () => {
        if (selectedFile != null) {
            let fileReader = new FileReader();
            fileReader.readAsBinaryString(selectedFile);
          
            fileReader.onload = async (event) => {
                let data = event.target.result;
                let workbook = await XLSX.read(data, { type: "binary" });
                let rowObject = await XLSX.utils.sheet_to_row_object_array(workbook.Sheets['BUSINESS RULES']);
                if (rowObject.length > 0 && rowObject !== undefined) {
                    finalResponse = await ValidationController.validate(rowObject);
                } else {
                    $("#prev").click();
                    document.getElementById('alert').classList.remove('d-none');
                }
            }
        }
    }

    const generateReport = () => {
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.json_to_sheet(finalResponse);
        XLSX.utils.book_append_sheet(wb, ws, 'BUSINESS RULES');
        fileName = fileName.split('.')[0];
        XLSX.writeFile(wb, fileName + '.xlsx');
    }

    document.getElementById('download').addEventListener('click' ,generateReport);

})();

// @author Nikhileshwar.T
// @company Riversand inc.