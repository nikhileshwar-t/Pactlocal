"use strict";

const dataTablesRenderer = (() => {

    //properties
    let dataTable = null;

    //cache DOM
    let container = $('.offering');
    let filteredTable = container.find('#filtered-datatable');

    //DOM Manipulations
    let renderTable = async (tableId , ExternalAttArray) => {

        let map = ExternalAttArray;
        let map1 = [];
        let map2 = [];
        let dataArray = [];

        if (tableId === 'filtered-datatable' && dataTable != null) {
            dataTable.api().clear();
            dataTable.api().destroy();
        }
        map.forEach(element => {
            if (element.externalAttribute != null) {
                map1.push(element);
            }
            else {
                map2.push(element);
            }
        });

        map = [];
        map.push(...map1, ...map2);
        let rowID = 0;
        map.forEach(element => {
            let external = element.externalAttribute;
            let option = '';
            let value = '';
            element.score.forEach(ele => {            
                option = option + "<option " + ">" + ele.externalAttribute + "</option>";
                if (external != null && external === ele.externalAttribute) {
                    value = external;
                }
            });

            let extAtt = '<input type="search"  class="form-control" list="' + element.pimAttribute.shortName +'"value="' + value + '">' + "<datalist id='"+ element.pimAttribute.shortName +"'>"
                            + option + "</datalist>"
            rowID += 1;
            dataArray.push([
                rowID,
                element.pimAttribute.shortName,
                element.pimAttribute.displayName,
                element.pimAttribute.dataType,
                extAtt,
                "<div class='delete-row-global'><i class='fa fa-trash text-danger text-center'></i></div>"
            ])
        });

        dataTable = $('#' + tableId).dataTable({
            data : dataArray,
            columns : [
                {
                    title : 'Slno.',
                    visible : false
                },
                {
                    title : 'PIM Attribute'
                },
                {
                    title : 'Display Name',
                    visible : false
                },
                {
                    title : 'Datatype'
                },
                {
                    title : 'External Attribute'
                },
                {
                    title : 'Delete'
                }
            ]
        });
        
        if (tableId === 'filtered-datatable') {
            filteredTable.removeClass('d-none');
        }
        return dataTable;
    }

    let dataTableGetter = () => {
        return dataTable;
    }
 
    $('#global-datatable').on( 'click', 'div.delete-row-global', function () {
        dataTable.api().row( $(this).parents('tr') ).remove().draw();
    } );

    $('#filtered-datatable').on( 'click', 'div.delete-row-global', function () {
        dataTable.api().row( $(this).parents('tr') ).remove().draw();
    } );


    return {
        renderTable : renderTable,
        // array : exe,
        tableData : dataTableGetter        
    }

})();