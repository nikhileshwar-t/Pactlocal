let editor = function () {
    
    //cacheDOM
    let container1 = document.getElementById('jsoneditor1');
    let container2 = document.getElementById('jsoneditor2');
    let wizard = $("#above");
    let jsonEditor = $("#below");
    let back = jsonEditor.find(".back");

    //bindEvents
    back.on('click', backToWizard);

    function fillEditor(jsondata) {
        wizard.hide();
        jsonEditor.show();
        downloadableJson = jsondata;
        let options1 = {
            mode: 'code',
            onChangeText: function (jsonString) {
                editor2.updateText(jsonString)
            }
          }
          
        let options2 = {
            mode: 'tree',
            onChangeText: function (jsonString) {
                editor1.updateText(jsonString);
            }
        }

        let editor1 = new JSONEditor(container1, options1, jsondata);
        let editor2 = new JSONEditor(container2, options2, jsondata); 

        let data = "text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(jsondata , null ,2));
        let link = '<a href="data:' + data + '" role="button" class="btn btn-success download" download="'+jsondata.entityModels[0].id+'.json">Download JSON</a>';
        $(link).appendTo('.button-row');
    }

    function backToWizard() {
        // jsonEditor.hide();
        // wizard.show();
        document.location.reload();
    }

    return {
        invokeEditor : fillEditor
    }
}();

// @author Gnana Pradeep
// @company Riversand inc.