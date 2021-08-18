"use strict";

const excelFileConverter = (() => {

    let jsonObject = {};
    let excelAttributesArray = [];

    //Bind Events
    let converter = async(event) => {
        let promise = new Promise((resolve, reject) => {
            excelAttributesArray = [];
            let fileList = event.target.files;

            for (let index = 0; index < fileList.length; index++) {
                let selectedFile = fileList[index];
                let reader = new FileReader();
                reader.readAsBinaryString(selectedFile);
    
                reader.onload = async function (event) {
                    let data = event.target.result;
                    let workbook = XLSX.read(data, {
                        type: 'binary'
                    });
                    // console.log(workbook.Sheets['ATTRIBUTES'])
                    for (let ele in workbook.SheetNames) {
                        // console.log(workbook.SheetNames[workbook.SheetNames[element]]);
                        let element = workbook.SheetNames[ele];
                        //data model to json
                        if (element === 'ATTRIBUTES') {
                            jsonObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets['ATTRIBUTES']);
                            // console.log(jsonObject)
                            jsonObject.forEach(element => {
                                excelAttributesArray.push({
                                    'shortName': element.NAME != undefined ? element.NAME : "",
                                    'displayName': element['DISPLAY NAME'] != undefined ? element['DISPLAY NAME'] : "",
                                    'dataType': element['DATA TYPE'] != undefined ? element['DATA TYPE'] : ""
                                })
                            });
                        }
                        //templete to json
                        if (element === 'PIMATTRIBUTES') {
                            jsonObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets['PIMATTRIBUTES']);
                            jsonObject.forEach(element => {
                                excelAttributesArray.push({
                                    'shortName': element.NAME != undefined ? element.NAME : "",
                                    'displayName': element['DISPLAY NAME'] != undefined ? element['DISPLAY NAME'] : "",
                                    'dataType': element['DATA TYPE'] != undefined ? element['DATA TYPE'] : ""
                                })
                            });
                        }
                        //external templete to json
                        if (element === 'EXTERNALATTRIBUTES') {
                            let jsonObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets['EXTERNALATTRIBUTES']);
                            jsonObject.forEach(element => {
                                excelAttributesArray.push({
                                    'externalAttribute': element['ATTRIBUTE NAME'] != undefined ? element['ATTRIBUTE NAME'] : ""
                                })
                            });
                        }
                        // console.log(excelAttributesArray)
                    }
                }
            }
            resolve(excelAttributesArray);

            reader.onerror = function (event) {
                console.error("File could not be read! Code " + event.target.error.code);
            };


        });
        return promise;
    }

    return {
        converter: converter
    }
})();
