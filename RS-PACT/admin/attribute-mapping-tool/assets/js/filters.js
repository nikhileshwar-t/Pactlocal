"use strict";

const filters = (() => {
    //cacheDOM
    let container = $('.offering');
    let domainSelector = container.find('#domain-selector');
    let entitySelector = container.find('#entity-selector');
    let attributeSelector = container.find('#enhancer-attributes-selector');
    let taxonomySelector = container.find('#taxonomy-input');
    let contextSelector = container.find('#context-selector');
    let entitySelectorBlock = container.find('#entity-selector-block');
    let attributesSelectorBlock = container.find('#enhancer-attributes-selector-block');
    let taxonomyBlock = container.find('#taxonomy-block');
    let contextSelectorBlock = container.find('#context-selector-block');
    let filterDownloadTrigger = container.find('#filter-download');
    let filterSaveTrigger = container.find('#filter-save');
    let fetch = container.find('#filter');
    let filterConfigTrigger = container.find('#generate-filter-config');
    
    //Bind Events

    let domainChanged = async() => {
        let entities = await getEntities();
        populateEntities(entities);
        let contextsAndEnhancerAttributes = await getContextsAndEnhancerAttr();
        populateContextsAndEnhancerAttr(contextsAndEnhancerAttributes);
        filterDownloadTrigger.addClass('d-none');
        filterSaveTrigger.addClass('d-none');
        filterConfigTrigger.addClass('d-none');
        fetch.removeClass('d-none');
        entitiesList.clear();
        attributesList.clear();
        contextsList.clear();
    }

    let entityChanged = async() => {
        if (entitiesList.value.length > 0) {
            attributesSelectorBlock.removeClass('d-none');
        }
        else{
            attributesSelectorBlock.addClass('d-none');
        }
        filterDownloadTrigger.addClass('d-none');
        filterSaveTrigger.addClass('d-none');
        filterConfigTrigger.addClass('d-none');
        fetch.removeClass('d-none');    
    }

    let attributesChanged = async() => {
        if (attributesList.value.length>0) {
            taxonomyBlock.removeClass('d-none');
        }
        else{
            taxonomyBlock.addClass('d-none');
        }
    }

    let domainsList = new ej.dropdowns.MultiSelect({
        placeholder: "Select Domains",
        change : domainChanged,
        showSelectAll: true,
        selectAllText: "Select All",
        mode: 'CheckBox'
    });
    domainsList.appendTo('#domain-selector');

    let entitiesList = new ej.dropdowns.MultiSelect({
        placeholder: "Select Entities",
        change : entityChanged,
        showSelectAll: true,
        selectAllText: "Select All",
        mode: 'CheckBox',
    });
    entitiesList.appendTo('#entity-selector');

    let attributesList = new ej.dropdowns.MultiSelect({
        placeholder: "Select Attributes",
        change : attributesChanged,
        maximumSelectionLength : 1, 
        mode: 'CheckBox',
    });
    attributesList.appendTo('#enhancer-attributes-selector');

    let contextsList = new ej.dropdowns.MultiSelect({
        placeholder: "Select Contexts",
        // change : contextsChanged,
        showSelectAll: true,
        selectAllText: "Select All",        
        mode: 'CheckBox',
    });
    contextsList.appendTo('#context-selector');

    //Methods
    
    let getEntities = async() => {
        
        let domain = domainsList.value;
        let entityNames = [];

        if (domain.length > 0) {
            let apiBody = await APIController.readFile('assets/json/getEntities.json');
            let body = JSON.parse(apiBody);
            body.params.query.domains = domain;
            let response = JSON.parse(await APIController.sendRequest(JSON.stringify(body)));
            
            entitySelector.empty();
            if ('entityModels' in response.response) {
                response.response.entityModels.forEach(element => {
                    entityNames.push(element.name);
                });
            }            
        }
        return entityNames;
    }

    let populateEntities = (entities) => {
        if (entities.length > 0) {
            entities.forEach(element => {
                entitySelector.append(new Option(element , element))
            });
            entitySelectorBlock.removeClass('d-none');
        }
        else{
            entitySelectorBlock.addClass('d-none');
        }
        entitiesList.refresh();
    }

    let getContextsAndEnhancerAttr = async() => {

        let domain = domainSelector.val();
        let enhancerAttributesArray = []
        let contextArray = [];
        let contextNamesArray = [];

        if (domain.length > 0) {
            let apiBody = await APIController.readFile('assets/json/getContexts.json');
            let body = JSON.parse(apiBody);
            body.params.query.names = domain;
            let response = JSON.parse(await APIController.sendRequest(JSON.stringify(body)));

            attributeSelector.empty();
            contextSelector.empty();
            if ('entityModels' in response.response) {
                response.response.entityModels.forEach(element => {
                    if ('enhancerAttributes' in element.properties) {
                        element.properties.enhancerAttributes.forEach(ele => {
                            enhancerAttributesArray.push(ele.enhancerAttributeName);
                        });
                    }
        
                    if ('coalesceInfo' in element.properties) {
                        element.properties.coalesceInfo.forEach(ele => {
                            contextArray.push(ele.contextKey);
                        });
                    }
                });
            }

            if (contextArray.length>0) {
                let apiBody = JSON.parse(await APIController.readFile('assets/json/getContextNames.json'));
                apiBody.params.query.filters.typesCriterion = contextArray;
                let body = JSON.parse(await APIController.sendRequest(JSON.stringify(apiBody),'/api/entityservice/get'));
                if ('entities' in body.response) {
                    let entity = body.response.entities;
                    for (let i = 0; i < entity.length; i++) {
                        contextNamesArray.push( entity[i].type + ' : '+ entity[i].name )
                    }
                }
            }
        }
        return [enhancerAttributesArray , contextNamesArray]
    }

    let populateContextsAndEnhancerAttr = (contextsAndAttr) => {
        
        if (contextsAndAttr[0].length > 0) {
            contextsAndAttr[0].forEach(element => {
                attributeSelector.append(new Option(element , element));
            });            
        }
        else{
            attributesSelectorBlock.addClass('d-none');
        }
        attributesList.refresh();
        
        if (contextsAndAttr[1].length > 0) {
            contextsAndAttr[1].forEach(element => {
                contextSelector.append(new Option(element,element));
            });
            contextSelectorBlock.removeClass('d-none');
        }
        else{
            contextSelectorBlock.addClass('d-none');
        }
        contextsList.refresh();
    }

    let filteredResponse = async(TenantAllAttributes) => {
        // api/entityappmodelservice/getcomposite
        let domain = domainsList.value;
        let entities = entitiesList.value;
        let attributes = attributesList.value;
        let taxonomy = taxonomySelector.val();
        let context = contextsList.value;
        let attributeArray = [];
        
        if (domain != null && domain.length > 0 && entities != null) {
            let apiBody = await APIController.readFile('assets/json/filteredResponse.json');
            let body = JSON.parse(apiBody);
            if(context!=null && context.length>0){
                body.params.contexts.push(context);
            }else{
                delete body.params.contexts;
            }
            if(attributes != null && attributes.length>0 && taxonomy != '' && taxonomy != undefined && taxonomy != null){
                let attribute = attributes[0];
                body.params.options.coalesceOptions.enhancerAttributes.push({ attribute : taxonomy,"contexts":[
                    {
                        "self": "self"
                    }
                ]});
            }else{
                delete body.params.options;
            }

            for (let i = 0; i < entities.length; i++) {
                let passId  = entities[i];
                body.params.query.id = passId;
                let response = JSON.parse(await APIController.sendRequest(JSON.stringify(body),"/api/entityappmodelservice/getcomposite"));
                if ('entityModels' in response.response) {
                    let attrs = response.response.entityModels[0].data.attributes;
                    for (let key in attrs) {
                       if(!attributeArray.includes(key)) { //attrarray.hortname
                           let index = TenantAllAttributes.map(function(e) { return e.shortName; }).indexOf(key);     
                           if(index != -1) 
                           {
                               attributeArray.push({"shortName" : key , "displayName":TenantAllAttributes[index].displayName , 'dataType' : attrs[key].properties.dataType});
                           }      
                       }
                    }
                }
            }            
        }
        filteredTableName();
        return attributeArray;
    }

    let filteredTableName = () => {
        let domain = domainsList.value;
        let entities = entitiesList.value;
        let attributes = attributesList.value;
        let taxonomy = taxonomySelector.val();
        let context = contextsList.value;
        
        let tableName = '';
        if (domain != null) {
            domain = domain.sort();
            domain.forEach(element => {
                tableName = tableName + '_' + element;
            });
        }
        if (entities!=null) {
            entities = entities.sort();
            entities.forEach(element => {
                tableName = tableName+'_'+element;
            });
        }
        if (attributes!=null) {
            tableName = tableName + '_' +attributes;
        }
        // if (context != null) {
        //     context = context.sort();
        //     context.forEach(element => {
        //         tableName = tableName + '_' + element;
        //     });
        // }

        return tableName;
    }

    return{
        filteredResponseArray : filteredResponse,
        entitiesArray : getEntities,
        contextsAndAttrArray : getContextsAndEnhancerAttr,
        populateEntities : populateEntities,
        populateContextsAndEnhancerAttr : populateContextsAndEnhancerAttr,
        filteredTableName : filteredTableName
    }
})();