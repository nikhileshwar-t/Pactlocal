let populator = function () {

    //cacheDOM
    let container = $(".offering");
    let id = container.find("#id");
    let name = container.find("#name");
    let graphprocess = container.find("#graphprocess");
    let matchruleoperator = container.find("#matchruleoperator");

    function init() {
    }
    
    async function populateJson() {
        let body = JSON.parse(await apiCaller.fileReader(JSON_PATH + "assets/json/resultTemplete.json"));
        body.entityModels[0].id = id.val();
        body.entityModels[0].name = name.val();
        body.entityModels[0].properties.graphProcessPath = graphprocess.val();
        
        body.entityModels[0].properties.matchRulesOperator = matchruleoperator.val();		
        body.entityModels[0].properties.matchRules = matchrule.matchRuleSet();
        if (Object.keys(attributesGrid.addAttributeData()).length > 0) {

            body.entityModels[0].data["attributes"]=attributesGrid.addAttributeData();
        }
        if(filler.fillRelationsData() != null && filler.fillRelationsData() != undefined && Object.keys(filler.fillRelationsData()).length > 0){
            body.entityModels[0].data["relationships"] = filler.fillRelationsData();
        }
        return body;
    }

    async function fillForDelete() {
        let body = JSON.parse(await apiCaller.fileReader(JSON_PATH + "assets/json/resultTempleteForDelete.json"));
        body.entityModels[0].id = id.val();
        body.entityModels[0].name = name.val();
        body.entityModels[0].properties.graphProcessPath = graphprocess.val();
        body.entityModels[0].properties.actionName = $("input[name='actionName']:checked").val();
        return body;
    }

    return {
        init : init,
        fill : populateJson,
        fillForDelete : fillForDelete
    }
}();

populator.init();

// @author Gnana Pradeep
// @company Riversand inc.