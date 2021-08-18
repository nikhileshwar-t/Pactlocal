"use strict";

const configGenerator = (() => {
    //properties

    //cacheDOM
    let container = $('#main');
    let configTemplate = container.find('#config-template');
    let modalTitle = $('#modal-title');
    let modalBody = $('#modal-body');

    const editorContainer = document.getElementById("config-template")
    const options = {
        mode: 'code'
    }
    const editor = new JSONEditor(editorContainer, options)

    // set json
    const initialJson = {
    }
    editor.set(initialJson)


       
    //methods
    let generateConfig = (dataTable) => {
            // get json
        let json = editor.get();
        let isJson = true;
        let configJson = []

        if (isJson ) {
            dataTable.forEach(element => {
                let tempJson = json;
                tempJson = JSON.stringify(tempJson);
                tempJson = tempJson.replace('@@pim_attribute@@' , element['PIM Attribute']);
                tempJson = tempJson.replace('@@external_attribute@@' , element['External Attribute']);
                tempJson = tempJson.replace('@@datatype@@' , element['Datatype']);
                tempJson = JSON.parse(tempJson);
                configJson.push(tempJson);
            });

            function createGuid(){  
                function S4() {  
                   return (((1+Math.random())*0x10000)|0).toString(16).substring(1);  
                }  
                return (S4() + S4() + "-" + S4() + "-4" + S4().substr(0,3) + "-" + S4() + "-" + S4() + S4() + S4()).toLowerCase();  
             }   
               
             let guid = createGuid();  

            let dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(configJson, null, 2));
            let dlAnchorElem = document.getElementById('download-config');
            dlAnchorElem.setAttribute("href", dataStr);
            dlAnchorElem.setAttribute("download", guid  + ".json");
            
            dlAnchorElem.click();
        }
    }

    let jsonTempleteGetter = () => {

        let data = editor.get();
        return data;
    }

    return{
        generateConfig : generateConfig,
        editorJson : jsonTempleteGetter
    }
})();