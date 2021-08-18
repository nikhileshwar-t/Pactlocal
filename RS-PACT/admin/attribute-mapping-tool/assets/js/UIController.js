
'use strict';


const UIController = (() => {
    
    //properties
    let counter = 1;
    let PIMExcelArray = [];
    let ExternalExcelArray = [];
    let TenantAllAttributes=[];
    let isTenantConnected = false;
    let PIMInputFlag = false;
    let existingDataTable = null;
    let existingData = null;

    //cacheDOM
    let container = $('.offering');
    let prevButton = container.find('#prev');
    let nextButton = container.find('#next');
    let createMapping = container.find('#create-mapping');
    let downloadExisting = container.find('#download-existing-mapping');
    let pimExcelFile = container.find('#pim-excel');
    let ExternalExcelFile = container.find('#external-from-excel');
    let modalTitle = $('#modal-title');
    let modalBody = $('#modal-body');
    let tenantConnectedIndicator = container.find('#tenant-connected');
    let globalConfigTrigger = container.find('#generate-global-config');
    let goToFilter = container.find('#go-to-filter');
    let goToFilter2 = container.find('#go-to-filter2');
    let currentTenant = container.find('#current-tenant');
    let pimExcelTemplete = container.find('#pim-excel-templete');
    let externalExcelTemplete = container.find('#external-excel-templete');
    let reloadPage1 = container.find('#reload-page1');
    let reloadPage2 = container.find('#reload-page2');
    let fetch = container.find('#filter');
    let filteredTable = container.find('#filtered-datatable');
    let filterDownloadTrigger = container.find('#filter-download');
    let filterSaveTrigger = container.find('#filter-save');
    let filterConfigTrigger = container.find('#generate-filter-config');

    //Bind Events

    downloadExisting.click(function (e) { 
        $('.tt').removeClass('d-none');
    });
    
    createMapping.click(function (e) {
        nextButton.click();
    });

    prevButton.click(function (e) {
        counter -= 1;
        tabSwitcher(counter , -1);     
    });

    nextButton.click(function (e) {
        counter += 1;
        tabSwitcher(counter , 1);
    });

    reloadPage1.click(function (e) { 
        location.reload();
    });

    reloadPage2.click(function (e) { 
        location.reload();
    });

    pimExcelFile.change(async function (e) {
        let fileName = e.target.files[0].name;
        $('#pim-excel-label').html(fileName);
        await excelFileConverter.converter(e).then(function(done) {
            PIMExcelArray = done;
        });      
    });

    ExternalExcelFile.change(async function (e) { 
        let fileName = e.target.files[0].name;
        $('#external-excel-label').html(fileName);
        await excelFileConverter.converter(e).then(function(done) {
            ExternalExcelArray = done;
          });
    });

    globalConfigTrigger.click(function (e) { 
        tabSwitcher(4);
    });

    goToFilter.click(function (e) { 
        tabSwitcher(5);
    });

    goToFilter2.click(function (e) { 
        tabSwitcher(5);
    });

    fetch.click(function (e) { 
        filterCompare();
    });

    filterConfigTrigger.click(function (e) { 
        tabSwitcher(4);
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
      })
    //DOM manipulations
    
    $('input[type=radio][name=pim-from]').change(function() {
        if (this.value === 'pim-from-menu') {
            $('[href="#pim-from-menu"]').tab('show');
        }
        if (this.value === 'pim-from-excel') {
            $('[href="#pim-from-excel"]').tab('show');
        }
    });

    $(document).ready(async function() {
        tabSwitcher(counter);
        pimExcelTemplete.attr('href', JSON_PATH + "assets/PIMExcelTemplete.xlsx");
        externalExcelTemplete.attr('href', JSON_PATH + "assets/ExternalExcelTemplete.xlsx");
        $('#sample-json').attr('src' , JSON_PATH + "assets/sampleConfigTemplate.png");
        $('#sample-json').attr('class' , 'zoom');
        
        let tenant = await APIController.getActiveUser();
        let tenantName = tenant.data[0].name;
        let user = tenant.data[0].nickname.split('@');
        user = user[0];
        user = user.replaceAll(' ' , '_');
        existingMaps(user);
        currentTenant.html( ' : '+ tenantName);
        let apiBody = await APIController.readFile('assets/json/getAllAttributes.json');
        let response = await APIController.sendRequest(apiBody);
        if (response != null) {
            isTenantConnected = true;
            tenantConnectedIndicator.removeClass('text-danger');         
            tenantConnectedIndicator.addClass('text-success');
            let array = JSON.parse(response).response.entityModels;
            array.forEach(element => {
                TenantAllAttributes.push({"shortName":element.name,"displayName":element.properties.externalName , "dataType" : element.properties.dataType});
            });     
            let entities = await filters.entitiesArray();
            filters.populateEntities(entities);
            let contextsAndAttr = await filters.contextsAndAttrArray();
            filters.populateContextsAndEnhancerAttr(contextsAndAttr);            
        }
    } );

    const tabSwitcher = async(counter , flag) => {

        switch (counter) {

            case 1:
                prevButton.addClass('d-none');
                nextButton.addClass('d-none');
                $('[href="#tab-1"]').tab('show');
                break;

            case 2:
                $('[href="#tab-2"]').tab('show');
                nextButton.removeClass('d-none');
                break;

            case 3:                
                nextButton.addClass('d-none');
                if (flag === 1) {
                    if (ExternalExcelArray.length > 0 ) {
                        if ($('input[name="pim-from"]:checked').val() === 'pim-from-menu' ) {
                            PIMInputFlag = true;
                            if (isTenantConnected === true) {
                                await compareFromTenant();
                                $('[href="#tab-3"]').tab('show');
                            }
                            else{
                                modalTitle.html('No Tenant is configured');
                                modalBody.html('There is no Tenant configured, please configure a tenant in PACT dashboard or refresh in case of network fluctuations');
                                $('#modal').modal('show');
                                prevButton.click();
                            }
                        }

                        if ($('input[name="pim-from"]:checked').val() === 'pim-from-excel') {
                            if (PIMExcelArray.length > 0) {
                                goToFilter.addClass('d-none');
                                $('#go-to-filter2').addClass('d-none');
                                compareFromExcel();
                                $('[href="#tab-3"]').tab('show');
                            }
                            else{
                                modalTitle.html('Import PIM Attributes');
                                modalBody.html('There are no PIM attributes imported, please import an Excel to populate the PIM attributes');
                                $('#modal').modal('show');
                                prevButton.click();
                            }
                        }
                        
                    }
                    else{
                        modalTitle.html('Import External Attributes');
                        modalBody.html('There are no external attributes imported, please import an Excel to populate the external attributes');
                        $('#modal').modal('show');
                        prevButton.click();
                    }
                }
                else{
                    $('[href="#tab-3"]').tab('show');
                }
                break;

            case 4:
                $('[href="#tab-4"]').tab('show');
                break;

            case 5:
                $('[href="#tab-5"]').tab('show');
                break;

            case 6:
                $('[href="#tab-6"]').tab('show');
                break;

            default:
                break;
        }
    }

    let compareFromExcel = async() => {
        let externalArray = await algoController.predictor(PIMExcelArray , ExternalExcelArray);

        dataTablesRenderer.renderTable('global-datatable' , externalArray);
        // algoController.manipulateMappedAttributes([]);
    }

    let existingMaps = async(user) => {
        let names = await phpAPIs.getNames(user);
        let content = ''
        names.forEach(element => {
            content = content + `
            <tr>
                <td>${element.row_name}</td>
                <td><a class="excel" href="#">Download</a></td>
                <td><a class="json" href="#">Download</a></td>
            </tr>
            `
        });
        $("#saved-mappings tbody").prepend(content);
        existingDataTable = $('#saved-mappings').DataTable();
        existingData = names;
    }

    let compareFromTenant = async() => {
        let externalArray = await algoController.predictor(TenantAllAttributes , ExternalExcelArray);
        // dataTablesRenderer.array(externalArray);
        await dataTablesRenderer.renderTable('global-datatable' , externalArray);
    }
    
    let filterCompare = async() => {
        let attrArray = await filters.filteredResponseArray(TenantAllAttributes);
        filteredTable.removeClass('d-none');
        let externalArray = await algoController.predictor(attrArray , ExternalExcelArray);
        // dataTablesRenderer.array(externalArray , externalArray);
        let dataTable = dataTablesRenderer.renderTable('filtered-datatable' , externalArray);
        // dataTable.api().clear();
        filterDownloadTrigger.removeClass('d-none');
        filterSaveTrigger.removeClass('d-none');
        filterConfigTrigger.removeClass('d-none');
        fetch.addClass('d-none');             
    }
    
    let PIMFlag = () => {
        return PIMInputFlag;
    }

    let existingDataTableGetter =() => {
        return existingDataTable;
    }

    let existingDataGetter = () => {
        return existingData;
    }

    return{
        isTenantConnected : PIMFlag,
        dataTableGetter : existingDataTableGetter,
        existingDataGetter : existingDataGetter,
        tabSwitcher : tabSwitcher
    }
})();

