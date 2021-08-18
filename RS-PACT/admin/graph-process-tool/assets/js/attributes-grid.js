'use strict';

let attributesGrid = function () {
    let rowData = [];
    let attributesOut = {};
    let attributeList = [];

    //cacheDOM
    let container = $(".offering");
    let importer = container.find("#importAttributes");
    let addRowToGrid = container.find("#addRow");
    let importAttributes = container.find("#excel");
    let changeSelection =  container.find('#bulk-edit');
    let changeMode = container.find("#bulk-edit-mode");

    //bindEvents
    importer.on('click', importExcel);
    addRowToGrid.on('click', addRow);
    changeSelection.on('change' , bulkEdit);
    changeMode.on('change' , bulkModeEdit);

    function init() {
    }

    let colDef = [{
            headerName: 'Attributes',
            field: 'attributes',
            editable: true
        },
        {
            headerName: 'Strategy Selection',
            field: 'selection',
            cellEditor: 'agRichSelectCellEditor',
            cellEditorParams: {
                values: ['copy', 'copyWhenNotLocal', 'copyWhenEmpty', 'aggregate', 'min', 'max']
            },
            editable: true
        },
        {
            headerName: 'Strategy Mode',
            field: 'mode',
            cellEditor: 'agRichSelectCellEditor',
            cellEditorParams: {
                values: ['', 'merge', 'replace']
            },
            editable: true
        },
        {
            headerName : 'DeleteRow',
            field : 'delete',
            editable: false,
            cellRenderer : function(params) {
                let newLink = 
                `<p class="text-center" onclick="attributesGrid.deleteRow();"><i class="fa fa-trash" style="font-size:25px;color:#F80000;"></i></p>`;
                return newLink;
            }
        }
    ]

    let gridOption = {
        columnDefs: colDef,
        rowData: rowData,
        components: {},
        defaultColDef: {
            editable: true,
            sortable: true,
            flex: 1,
            minWidth: 100,
            filter: true,
            resizable: true
        }
    }

    function addRow() {
        let rowTemplete = {
            attributes: '',
            selection: '',
            mode: ''
        };
        rowData.push(rowTemplete);
        gridOption.api.setRowData(rowData);
    }

    $(document).ready(function () {
        let gridDiv = document.querySelector('#myGrid');
        new agGrid.Grid(gridDiv, gridOption);
        gridOption.singleClickEdit = true;
    });

    function importExcel() {

        let text = importAttributes.val();
        let text2 = text.split("\n");
        attributeList = [];
        text2.forEach(element => {
            let temp = element.split(/\W/)
    
            attributeList.push(temp);
        });
       
        if (rowData != null) {
            attributeList.forEach(element => {
                refreshAttributes(element);
            });
        }
        attributeList.forEach(element => {
            let addingRow = pushData(element);
            if (addingRow != null) {
                rowData.push(addingRow);
            }
        });
    
        gridOption.api.setRowData(rowData);
    }

    function refreshAttributes(element) {
        rowData = [];
        gridOption.api.setRowData(rowData);
    }

    function deleteRow() {
        const selectedRow = gridOption.api.getFocusedCell();
        rowData.splice(selectedRow.rowIndex, 1);
        gridOption.api.setRowData(rowData);
    }
    
    function pushData(element) {
        let data = {
            attributes: '',
            selection: '',
            mode: ''
        };
        if (element[0] != "") {
            data.attributes = element[0];
            data.selection = 'copy';
            data.mode = '';
    
            if (data.attributes != null && data.attributes != "" && data.attributes != "Attributes") {
                return data;
            } else {
                return null;
            }
    
        }
    }
    
    function bulkEdit() {
        let val =  changeSelection.val();
        rowData.forEach(element => {
            element.selection = val;
        });
        gridOption.api.setRowData(rowData);
    }

    function bulkModeEdit() {
        let val =  changeMode.val();
        rowData.forEach(element => {
            if (val === 'none') {
                element.mode = '';
            }
            else{
                element.mode = val;
            }
        });
        gridOption.api.setRowData(rowData);
    }

    function json() {
        attributesOut = {};
        rowData.forEach(element => {
            if (element.attributes.trim() != '' && element.attributes != undefined && element.selection != undefined && element.selection != '') {
                let properties = {};
                properties["strategy"] = element.selection;
                if (element.selection === 'copy' && element.mode != '' && element.mode != undefined ) {
                    properties["strategyMode"] = element.mode;
                }
                let at = {};
                at["properties"] = properties
                attributesOut[element.attributes] = at;
            }
            
        });
        return attributesOut;
    }

    return {
        init : init,
        addAttributeData : json,
        deleteRow : deleteRow
    }
}();

attributesGrid.init();

// @author Gnana Pradeep
// @company Riversand inc.