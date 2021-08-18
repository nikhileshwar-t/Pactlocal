
function validate1(val) {
    v1 = document.getElementById("rsexcel");
    v2 = document.getElementById("externalexcel");

    flag1 = true;
    flag2 = true;

    if (val >= 1 || val == 0) {
        if (v1.value == "") {
            v1.style.borderColor = "red";
            flag1 = false;
        }
        else {
            v1.style.borderColor = "white";
            flag1 = true;
        }
    }

    if (val >= 2 || val == 0) {
        if (v2.value == "") {
            v2.style.borderColor = "red";
            flag2 = false;
        }
        else {
            v2.style.borderColor = "white";
            flag2 = true;
        }
    }

    flag = flag1 && flag2;

    return flag;
}

function validate2(val) {
    v1 = document.getElementById("mapping");


    flag1 = true;


    if (val >= 1 || val == 0) {
        if (v1.value == "") {
            v1.style.borderColor = "red";
            flag1 = false;
        }
        else {
            v1.style.borderColor = "white";
            flag1 = true;
        }
    }



    flag = flag1;

    return flag;
}

function validate1(val) {
    v1 = document.getElementById("rsexcel");
    v2 = document.getElementById("externalexcel");

    flag1 = true;
    flag2 = true;

    if (val >= 1 || val == 0) {
        if (v1.value == "") {
            v1.style.borderColor = "red";
            flag1 = false;
        }
        else {
            v1.style.borderColor = "white";
            flag1 = true;
        }
    }

    if (val >= 2 || val == 0) {
        if (v2.value == "") {
            v2.style.borderColor = "red";
            flag2 = false;
        }
        else {
            v2.style.borderColor = "white";
            flag2 = true;
        }
    }

    flag = flag1 && flag2;

    return flag;
}

function validate2(val) {
    v1 = document.getElementById("mapping");


    flag1 = true;


    if (val >= 1 || val == 0) {
        if (v1.value == "") {
            v1.style.borderColor = "red";
            flag1 = false;
        }
        else {
            v1.style.borderColor = "white";
            flag1 = true;
        }
    }



    flag = flag1;

    return flag;
}

$(document).ready(function () {

    var current_fs, next_fs, previous_fs;

    $(".next").click(function () {

        str1 = "next1";
        str2 = "next2";

        if (!str1.localeCompare($(this).attr('id')) && validate1(0) == true) {
            val1 = true;
        }
        else {
            val1 = false;
        }

        if (!str2.localeCompare($(this).attr('id')) && validate2(0) == true) {
            val2 = true;
            output();
        }
        else {
            val2 = false;
        }

        if ((!str1.localeCompare($(this).attr('id')) && val1 == true) || (!str2.localeCompare($(this).attr('id')) && val2 == true)) {
            current_fs = $(this).parent().parent().parent();
            next_fs = $(this).parent().parent().parent().next();

            $(current_fs).removeClass("show");
            $(next_fs).addClass("show");

            $("#progressbar li").eq($(".card").index(next_fs)).addClass("active");

            current_fs.animate({}, {
                step: function () {

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });

                    next_fs.css({
                        'display': 'block'
                    });
                }
            });
        }
    });

    $(".prev").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        $(current_fs).removeClass("show");
        $(previous_fs).addClass("show");

        $("#progressbar li").eq($(".card").index(next_fs)).removeClass("active");

        current_fs.animate({}, {
            step: function () {

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });

                previous_fs.css({
                    'display': 'block'
                });
            }
        });
    });

});


let entities = [];
let headersRow = [];
let result = [];
let mapping = [];
let finalHeaderRow = [];
let finalEntities = [];
let excelRows = [];
let dataRow = [];

//Entity data

function processFiles() {
    let filelist = document.getElementById('rsexcel').files;

    for (let i = 0; i < filelist.length; i++) {

        let fileName = filelist[i];


        if (fileName) {
            let fileReader = new FileReader();
            fileReader.readAsBinaryString(fileName);
            fileReader.onload = (event) => {
                let data = event.target.result;
                let workbook = XLSX.read(data, { type: "binary" });
                entities = XLSX.utils.sheet_to_json(workbook.Sheets['Entities'], { range: 1 });
                console.log(entities);
                finalEntities.push(...entities)
            }

        }
    }

}

console.log(finalEntities);

//Exceltemplate
let workbook = [];

// we populate in this excel

function headerFiles() {
    let filelist = document.getElementById('externalexcel').files;

    for (let i = 0; i < filelist.length; i++) {

        let fileName = filelist[i];


        if (fileName) {
            let fileReader = new FileReader();
            fileReader.readAsBinaryString(fileName);
            fileReader.onload = (event) => {
                let data = event.target.result;
                let workbook = XLSX.read(data, { type: "binary" });
                dataRow = XLSX.utils.sheet_to_json(workbook.Sheets['Sheet1'], { header: 1 });
                console.log(dataRow);
                excelRows.push(...dataRow)


                let obj = {}
                for (let i in excelRows) {


                    excelRows[i].forEach(element => {
                        obj[element] = ''
                    });

                    for (x in obj) {
                        headersRow.push(x);

                    }

                }






                headersRow.forEach(element => {
                    finalHeaderRow[element] = ''
                });



            }

        }
    }

}
console.log(finalHeaderRow);
console.log(excelRows);



let outputArray = [];
let populateExcel = async () => {


    let entitiesDummy = finalHeaderRow;
    console.log(entitiesDummy);
    let entities = Object.values(entitiesDummy);
    console.log(entities);
    let resultObjectValues = Object.values(resultObject);
    console.log(resultObjectValues);
    let resultObjectKeys = Object.keys(resultObject);
    console.log(resultObjectKeys);
    outputArray.push(entitiesDummy);

    resultObjectValues[0].forEach((val, index) => {
        let arr = []
        arr.length = entities.length;
        entities.forEach((ele, i) => {
            resultObjectKeys.forEach(element => {
                if (element === ele) {
                    arr.splice(entities.indexOf(ele), 0, resultObject[ele][index])
                    // arr[getKeyByValue(entitiesDummy[0], ele)] = resultObject[ele][index]
                }
                else {
                    // arr[getKeyByValue(entitiesDummy[0], ele)] = ''
                }
            });
        });

        outputArray.push(arr);
    });

    //-------------this is your output---------------------
    console.log(outputArray);

}

function getKeyByValue(object, value) {
    for (var prop in object) {
        if (object.hasOwnProperty(prop)) {
            if (object[prop] === value)
                return prop;
        }
    }
}



function mappingFiles() {
    let filelist = document.getElementById('mapping').files;

    for (let i = 0; i < filelist.length; i++) {

        let fileName = filelist[i];


        if (fileName) {
            let fileReader = new FileReader();
            fileReader.readAsBinaryString(fileName);
            fileReader.onload = (event) => {
                let data = event.target.result;
                let workbook = XLSX.read(data, { type: "binary" });
                let excelRows = XLSX.utils.sheet_to_json(workbook.Sheets['Mappings']);
                mapping = JSON.parse(JSON.stringify(excelRows).replace(/\s(?=\w+":)/g, ""));
                result.push(...mapping)
                console.log(result);
            }

        }
    }

}


let resultObject = {}

function output() {
    let resultArray = [];
    finalHeaderRow = Object.keys(finalHeaderRow);
    console.log(finalHeaderRow)
    for (let i in finalHeaderRow) {
        for (let j in result) {
            if (finalHeaderRow[i] === result[j].externalAttribute) {
                resultArray = [];
                let x = result[j].DisplayName;
                let y = finalHeaderRow[i];
                for (let k in finalEntities) {
                    resultArray.push(finalEntities[k][x]);
                }

                resultObject[y] = resultArray;

            }

        }
    }
    // console.log(resultObject);

    populateExcel();
}
function downloadAsExcel() {
    let wb = XLSX.utils.book_new();
    const worksheet = XLSX.utils.json_to_sheet(outputArray, { skipHeader: 1 });
    XLSX.utils.book_append_sheet(wb, worksheet, 'data');
    XLSX.writeFile(wb, 'RS' + '_export_' + new Date().getTime() + '.xlsx');
}

document.getElementById('download').addEventListener('click' , downloadAsExcel);


