
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



});



let firstattributelist = [];
let secondattributelist = [];
let Attributesfirst = [];
let Attributessecond = [];
let categoryinone = [];
let categoryintwo = [];
let categoryone = [];
let categorytwo = [];
let AddedAttributes = [];
let DeletedAttributes = [];
let result = [];
let finalresult = [];
let commoncategories = [];

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
                categoryone = workbook.SheetNames
                // console.log(categoryone);
                workbook.SheetNames.forEach((sheet, index) => {
                    Attributesfirst = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet], { range: 3 });

                    categoryinone = { "categorytype": sheet }
                    Attributesfirst.push(categoryinone);
                    firstattributelist.push(Attributesfirst)
                    // console.log(firstattributelist)
                })
            }
        }

    }
}
function headerFiles() {
    let filelist2 = document.getElementById('externalexcel').files;
    for (let i = 0; i < filelist2.length; i++) {
        let fileName = filelist2[i];
        if (fileName) {
            let fileReader = new FileReader();
            fileReader.readAsBinaryString(fileName);
            fileReader.onload = (event) => {
                let data = event.target.result;
                let workbook = XLSX.read(data, { type: "binary" });
                categorytwo = workbook.SheetNames
                // console.log(categorytwo);
                workbook.SheetNames.forEach((sheet, index) => {
                    Attributessecond = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet], { range: 3 });
                    categoryintwo = { "categorytype": sheet }
                    Attributessecond.push(categoryintwo)
                    secondattributelist.push(Attributessecond)
                    //  finalEntities = [...finalEntities,...Attributes];
                    // console.log(secondattributelist)
                })


            }

        }
    }

}

function output() {
    let a = [];
    let b = [];
    let count = 0;

    commoncategories = categoryone.filter(x => categorytwo.includes(x));
    for (let i = 0; i < commoncategories.length; i++) {

        for (var j = 0; j < firstattributelist.length; j++) {
            n = firstattributelist[j]
            for (z = 0; z < n.length; z++) {
                if (n[z].categorytype == commoncategories[i]) {
                    for (j = 0; j < n.length; j++) {
                        a.push(n[j].AttributeName)
                    }
                }
            }

        }
        for (var j = 0; j < secondattributelist.length; j++) {
            n = secondattributelist[j]
            for (z = 0; z < n.length; z++) {
                if (n[z].categorytype == commoncategories[i]) {
                    for (j = 0; j < n.length; j++) {
                        b.push(n[j].AttributeName)
                    }
                }
            }

        }
        AddedAttributes = b.filter(d => !a.includes(d))
        DeletedAttributes = a.filter(d => !b.includes(d))
        console.log(AddedAttributes, DeletedAttributes);

        if (AddedAttributes.length > DeletedAttributes.length) {
            count = AddedAttributes.length
        }
        else {
            count = DeletedAttributes.length
        }
        //  result.length = 0
        for (let i = 0; i <= count; i++) {
            let res = {}

            if (AddedAttributes[i] && DeletedAttributes[i]) {
                res = { "Additional attributes": AddedAttributes[i], "Deleted attributes": DeletedAttributes[i] }
            }
            else if(AddedAttributes[i]){
                res = {"Additional attributes":AddedAttributes[i],"Deleted attributes":""}
            }
            else if(DeletedAttributes[i]){
                res = {"Additional attributes":"","Deleted attributes":DeletedAttributes[i]}
            }


            result.push(res)
            // console.log(result)

        }

        finalresult.push(result)
    result = []


        a.length = 0
        b.length = 0

    }
}


function downloadAsExcel() {
    console.log(finalresult)
    let wb = XLSX.utils.book_new();

    for (i in commoncategories) {
        const worksheet = XLSX.utils.json_to_sheet(finalresult[i]);
        XLSX.utils.book_append_sheet(wb, worksheet, commoncategories[i]);
    }
    XLSX.writeFile(wb, 'RS' + '_export_' + new Date().getTime() + '.xlsx');
}

document.getElementById('download').addEventListener('click', downloadAsExcel);




