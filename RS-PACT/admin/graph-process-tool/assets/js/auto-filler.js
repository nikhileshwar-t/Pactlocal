"use strict";

let filler = function () {
    let graphResponse = '';
    let entitiesResponse = '';
    let relationshipResponse = '';
    let commonRelations = [];

    //cacheDOM
    let container = $(".offering");
    let sourceEntity = container.find("#sourceentitytype");
    let targetEntity = container.find("#targetentitytype");
    let relationship= container.find("#relationshiptype");
    let id = container.find("#id");
    let name = container.find("#name");
    let graphProcessPath = container.find("#graphprocess");
    let relationsTab = container.find("#relations");

    //bind Events
    sourceEntity.on('change' , _sourceFilled);
    targetEntity.on('change' , _targetFilled);

    function init() {
        _getgraphs();
        _getEntities();
    }

    async function _getgraphs() {
        let body = await apiCaller.fileReader(JSON_PATH + "assets/json/graphsQuery.json");
        graphResponse  = await apiCaller.invokeAPI(body);
    }

    function fillGraphs() {
		let graphList = [];
        let graphResponseParsed = JSON.parse(graphResponse);
        graphResponseParsed.response.entityModels.forEach(element => {
            graphList.push(element);
        });
        graphList.sort();

        $('#myTable').dataTable({
            "bAutoWidth": false,
            "aaData": graphList,
            searching: false,
            lengthChange: false,
            processing: true,
            "columns": [{ "data": "id" }, 
            {"data": "name"}, 
            {"mRender": function (  data, type, full, row ) {
                let test = JSON.stringify(row);
                return `<a href="#" class="permissions_edit" onclick="filler.graphToEditor(${row.row})">Json</a> `;}
            }  
        ]
    });
    }

    async function graphToEditor(index) {
        let graphResponseParsed = JSON.parse(graphResponse);
        let graphs = graphResponseParsed.response.entityModels;
        let body = JSON.parse(await apiCaller.fileReader(JSON_PATH + "assets/json/resultTemplete.json"));
        body.entityModels[0] = graphs[index];
        editor.invokeEditor(body);
    }

    async function _getEntities() {
        let body = await apiCaller.fileReader(JSON_PATH + "assets/json/getEntitiesQuery.json");
        entitiesResponse = await apiCaller.invokeAPI(body);
        _fillEntities();
    }

    function _fillEntities() {
        let entityNames = [];
        let entitiesResponseParsed = JSON.parse(entitiesResponse);
        entitiesResponseParsed.response.entityModels.forEach(element => {
            entityNames.push(element.name);
        });
        entityNames.sort();

        entityNames.forEach(element => {
            sourceEntity.append($('<option/>', { 
                value: element,
                text : element 
            }));

            targetEntity.append($('<option/>', { 
                value: element,
                text : element 
            }));
        
        });
    }

    async function _getRelations() {
        let body = JSON.parse(await apiCaller.fileReader(JSON_PATH + "assets/json/getRelationshipQuery.json"));
        $(".entity-selection").hide();
        relationship.empty();

        if (sourceEntity.val()!= '' && targetEntity.val()!='') {
            body.params.query.ids.push(sourceEntity.val()+'_entityManageModel', targetEntity.val()+'_entityManageModel');
            relationshipResponse = await apiCaller.invokeAPI(JSON.stringify(body, null, 2));
            _fillRelations();
        }      
    }

    function _fillRelations() {
        let Relationships = [];
        let relationshipResponseParsed = JSON.parse(relationshipResponse);

        relationshipResponseParsed.response.entityModels.forEach(element => {
            if (element.id === sourceEntity.val()+"_entityManageModel" || element.id === targetEntity.val()+"_entityManageModel") {
                if (element.data.relationships) {
                    let key = Object.keys(element.data.relationships);
                    key.forEach(elements => {
                        let checkRelation = element.data.relationships[elements][0].properties.relatedEntityInfo[0].relEntityType;
                        if (checkRelation === sourceEntity.val() || checkRelation === targetEntity.val() ) {
                            Relationships.push(elements);
                        }
                    });
                }
            }
        });

        Relationships.sort();
        let relationshipsFilter = new Set(Relationships)
        if (Relationships.length>0) {
            relationshipsFilter.forEach(element => {
                $(relationship).append($('<option/>', { 
                    value: element,
                    text : element
                }));
            });
        } else {
            $(relationship).append($('<option/>', { 
                value: "",
                text : "No Relationships found"
            }));

            $(".entity-selection").show();

            window.setTimeout(function() {
                    $('.entity-selection').fadeOut();
            }, 2000);
        }
    }

    function _sourceFilled() {
        targetEntity.prop("disabled" , false);
        if (targetEntity.val() != '') {
            _getRelations();
        }
    }

    function _targetFilled() {
        if (sourceEntity.val()!='') {
            _getRelations();
        }
    }
    
    function fillInfo() {
        id.val(sourceEntity.val()+"_"+relationship.val()+"_"+targetEntity.val()+"_graphProcessModel");
        name.val(sourceEntity.val()+"_"+relationship.val()+"_"+targetEntity.val());
        graphProcessPath.val(sourceEntity.val()+"_"+relationship.val()+"_"+targetEntity.val());
    }

    function fillRelationCheckBox() {
        let sourceRel = [];
        let targetRel = [];

        let relationshipResponseParsed = JSON.parse(relationshipResponse);
        let model = relationshipResponseParsed.response.entityModels;

        if (sourceEntity.val() != targetEntity.val()) {
            if (model[0].data.relationships) {
                sourceRel = Object.keys(model[0].data.relationships);
            }    
            
            if (model[1].data.relationships) {
                targetRel = Object.keys(model[1].data.relationships);
            }
        }
        else{
            if (model[0].data.relationships) {
                sourceRel = Object.keys(model[0].data.relationships);
                targetRel = Object.keys(model[0].data.relationships);
            }
        }

        if (sourceRel.length>0 && targetRel.length>0) {
                relationsTab.empty();
            
            commonRelations = targetRel.filter(x => sourceRel.includes(x));
            commonRelations.forEach(element => {
                if (element!=relationship.val()) {
                    let checkboxElement = `<div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="`+element+`">
                                                <label for="`+element+`" class="form-check-label" style="" id="`+element+`-label">
                                                <b>`+element+`</b>
                                                </label>
                                            </div>`
                    relationsTab.append($(checkboxElement));
                }
    
            });

            if (commonRelations.length == 0) {
                return -1;
            }
            else
            {
                return 0;
            }
        }
        else{
            return -1;
        }

     }

     function relationsData() {
        let relationshipResponseParsed = JSON.parse(relationshipResponse);
        let model = relationshipResponseParsed.response.entityModels;
        let relationsCheck = {}
        if (commonRelations.length > 0) {
			commonRelations.forEach(element => {
				if (element != relationship.val() ) {
					if (document.getElementById(element).checked) {
						let test = model[0].data.relationships[element];
						test[0].id = element;
						delete test[0].properties.relationshipOwnership;
						test[0].properties["strategy"] = "copy";
						if (test[0].hasOwnProperty("attributes")); {

							for (var element1 in test[0].attributes) {
								let obj = test[0].attributes[element1];
								delete obj["properties"];
								obj["properties"] = {
									"strategy": "copy"
								}
							}
						}
						relationsCheck[element] = test;
					}
				}
			});
			if (Object.keys(relationsCheck).length > 0) {
                // postData.entityModels[0]["relationships"] = relationsCheck;
                return relationsCheck
                
			}
		}
    }

    function attributesList() {
        return relationshipResponse;
    }

    return {
        init :init,
        fillGraphs : fillGraphs,
        fillInfo : fillInfo,
        attributesList : attributesList,
        fillRelationTab : fillRelationCheckBox,
        graphToEditor : graphToEditor,
        fillRelationsData : relationsData
    }
}();

  filler.init();

// @author Gnana Pradeep
// @company Riversand inc.