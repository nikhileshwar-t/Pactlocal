
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
let Headersfirst = [];
let headersone = [];
let Attributessecond = [];
let headerstwo = [];
let Headerssecond = [];
let categoryinone = [];
let categoryintwo = [];
let categoryone = [];
let categorytwo = [];
let AddedAttributes = [];
let DeletedAttributes = [];
let result = [];
let finalresult = [];
let commoncategories = [];
let commonlovs = []
let page =[]



// function to read first lov file

function firstInputfile() {
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
                    Attributesfirst = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                    headersone = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet], { range: "A1:Z1", header: 1 });
                    Headersfirst.push(headersone);
                    // console.log(Headersfirst)
                    categoryinone = { "categorytype": sheet }
                    Attributesfirst.push(categoryinone);
                    firstattributelist.push(Attributesfirst)
                    // console.log(firstattributelist)
                })
            }
        }

    }
}

//function to read second lov file
function secondInputfile() {
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
                workbook.SheetNames.forEach((sheet, index) => {
                    Attributessecond = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                    headerstwo = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet], { range: "A1:Z1" });
                    Headerssecond.push(headerstwo);
                    categoryintwo = { "categorytype": sheet }
                    Attributessecond.push(categoryintwo)
                    secondattributelist.push(Attributessecond)
                     console.log(secondattributelist)
                })


            }

        }
    }

}



function output() {

    let a = [];
    let b = [];
    let second = [];
    let first = [];
    
    
    commoncategories = categoryone.filter(x => categorytwo.includes(x));
    // console.log(commoncategories);

    for (let i = 0; i < commoncategories.length; i++) {
        for (var j = 0; j < firstattributelist.length; j++) {
            n = firstattributelist[j]
            console.log(n)
            for (z = 0; z < n.length; z++) {
                if (n[z].categorytype == commoncategories[i]) {
                    first = n
                   }
            }

        }
        for (var j = 0; j < secondattributelist.length; j++) {
            n = secondattributelist[j]
            for (z = 0; z < n.length; z++) {
                if (n[z].categorytype == commoncategories[i]) {
                    second = n
                }
            }

        }
        a = Object.keys(first[0]);
        b = Object.keys(second[0]);
        console.log(a)
        console.log(b)
        commonlovs = a.filter(x => b.includes(x))
        console.log(commonlovs)
        let firstrow = []
        let secondrow = []
        for (let j = 0; j < commonlovs.length; j++) {

            let test = first.map((item, i) =>  item[commonlovs[j]]);
            firstrow = test


            let test2 = second.map((item, k) =>  item[commonlovs[j]]);
            secondrow = test2

            AddedAttributes = secondrow.filter(d => !firstrow.includes(d))
            DeletedAttributes = firstrow.filter(d => !secondrow.includes(d))
            console.log(AddedAttributes)
            console.log(DeletedAttributes)

 
            let res = {}
            let ans = []
            for (let i = 0; i < AddedAttributes.length; i++) {
             
                res = { "Additional attributes": AddedAttributes[i] }
                res[commonlovs[j]] = res["Additional attributes"];
                delete res["Additional attributes"];
                // result.push(res)
                ans.push(res)
                // console.log(result)

            }
            
            if(DeletedAttributes.length>0){
             
            res = { "Additional attributes": "Deleted Lovs" }

            res[commonlovs[j]] = res["Additional attributes"];
            delete res["Additional attributes"];
            ans.push(res)
            }
            else{
                res = { "Additional attributes": "" }

                res[commonlovs[j]] = res["Additional attributes"];
                delete res["Additional attributes"];
                ans.push(res)

            }
           
            

            for (let i = 0; i < DeletedAttributes.length; i++) {
              
                res = { "Additional attributes": DeletedAttributes[i] }
                res[commonlovs[j]] = res["Additional attributes"];
                delete res["Additional attributes"];
                ans.push(res)


            }
            result.push(ans)
        } 
        console.log(result)
        let count ;
        var indexOfLongestArray = result.reduce((acc, arr, idx) => {
            console.log(acc, idx, JSON.stringify([arr, result[acc]]))
            return arr.length > result[acc].length ? idx : acc
          }, 0)
          
          // print result:
          console.log( "longest array is at index: ", indexOfLongestArray )
          
           count = (result[indexOfLongestArray].length)
          let duparray = []
          for(let j=0;j<result.length;j++){
              let dup = [];
             
              let sheet  = [];
              sheet = result[j]
              console.log(sheet)
              let objectlength  = sheet.length
              console.log(objectlength)
              let key  = Object.keys(sheet[0])
              console.log(key)
          for(let  i = 0;i < count;i++){
            if(i<objectlength){
               dup.push(sheet[i])   
              
           }
          else
          {
           let adding  = { "Additional attributes": ""}
           adding[key] = adding["Additional attributes"];
            delete adding["Additional attributes"];
            
             dup.push(adding) 
        
         
          }
        //   console.log(dup)
        //   duparray.push(dup)
        //   console.log(duparray)
        }
        
        duparray.push(dup)
        
        console.log("================new group================")
       
        console.log(duparray)
        console.log(duparray.length)
  }
  
    let target = { };
    let returnedTarget ;
    for(let i=0;i<count;i++){
        returnedTarget= {}
    for(let j=0;j<duparray.length;j++){
        let arr = duparray[j];
        
     
      returnedTarget = Object.assign(target, arr[i]);
    
      }
     console.log(returnedTarget)
     page.push({...returnedTarget});
     console.log(page)

    }
    
    
     
   

        console.log("================================")
        finalresult.push(page)
        page = []
        result.length = 0
        a.length = 0
        b.length = 0

    }
}

const outputArray = [
    {

        "Segment": "country",
        "country": "nikhil",
        "toto": "Midmarket",

    },
    {

        "Segment": "Government",
        "country": "",
        "toto": "Midmarket",

    },
    {
        "Segment": "Government",

    },
  
]

function downloadAsExcel() {
    console.log(finalresult)
    let wb = XLSX.utils.book_new();

    for (i in commoncategories) {
        const worksheet = XLSX.utils.json_to_sheet(finalresult[i]);
        XLSX.utils.book_append_sheet(wb, worksheet, commoncategories[i]);
    }
    XLSX.writeFile(wb, 'RS' + '_export_' + new Date().getTime() + '.xlsx');
}


// function downloadAsExcel() {
//     let wb = XLSX.utils.book_new();
//     const worksheet = XLSX.utils.json_to_sheet(outputArray);
//     XLSX.utils.book_append_sheet(wb, worksheet, 'data');
//     XLSX.writeFile(wb, 'RS' + '_export_' + new Date().getTime() + '.xlsx');
// }


document.getElementById('download').addEventListener('click', downloadAsExcel);
