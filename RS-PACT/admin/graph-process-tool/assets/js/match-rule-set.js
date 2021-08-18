let matchrule = function () {

    let sourceAttributesList = [];
    let targetAttributesList = [];
    let attributeMapObject = {};
    let MatchRules = [];
    let copyDataFlag = false;

    //cacheDOM
    let container = $(".offering");
    let sequence  = container.find("#sequence");
    let matchType = container.find("#Matchtype");
    let appendAttributeMap = container.find("#attMapAppend");
    let sourceattributes = container.find("#sourceattributes");
    let targetattributes = container.find("#targetattributes");
    let attributemapping = container.find("#attributemapping");
    let smartidattributes = container.find("#smartidattributes"); 
    let smartidcheck = container.find("#smartidcheck");   
    let nomatchresult = container.find("#nomatchresult");
    let singlematchresult  = container.find("#singlematchresult");
    let multimatchresult = container.find("#multimatchresult");
    let addSetButton = container.find("#addmatchrule");
    let matchRuleSetButtonsContainer = container.find("#matchRuleSetButtons");
    let modifySetButton = container.find("#modifymatchrule");
    let next = container.find("#next");
    let matchRuleAlert = container.find(".match-rule-alert");
    let sourceEntity = container.find("#sourceentitytype");
    let targetEntity = container.find("#targetentitytype");

    let matchSetSelectedIndex = -1; 

    //bindEvents
    matchType.on('change', _matchToggle);
    targetattributes.on("change", attributeMap);
    appendAttributeMap.on('change', ":checkbox" , smartId);
    addSetButton.on('click' , addMatchRule);

    matchRuleSetButtonsContainer.on('click', 'div' , displayMatchSet);

    modifySetButton.on('click'  , modifyMatchSet);

    function init() {
        appendAttributeMap.hide();
        modifySetButton.hide();
    }

    function _matchToggle() {
        let match = matchType.val();
        if (match === 'attributeBased') {
            appendAttributeMap.show();
            smartidattributes.hide();
        }
        else{
            appendAttributeMap.hide();
        }
        _attributesList();
    }

    function _attributesList() {
        let attributeObject = JSON.parse(filler.attributesList());

        if (sourceEntity.val() != targetEntity.val()) {
            sourceAttributesList = Object.keys(attributeObject.response.entityModels[0].data.attributes).sort();
            targetAttributesList = Object.keys(attributeObject.response.entityModels[1].data.attributes).sort();
        }
        else{
            sourceAttributesList = Object.keys(attributeObject.response.entityModels[0].data.attributes).sort();
            targetAttributesList = Object.keys(attributeObject.response.entityModels[0].data.attributes).sort();
        }

        sourceattributes.empty();
        targetattributes.empty();
        sourceattributes.append($('<option />' , {
            text : 'Select Source Attributes',
            value : ''
        }))
        targetattributes.append($('<option />' , {
            text : 'Select Target Attributes',
            value : ''
        }))
        sourceAttributesList.forEach(element => {
            sourceattributes.append($('<option />' , {
                text : element,
                value : element
            }))
        });

        targetAttributesList.forEach(element => {
            targetattributes.append($('<option />' , {
                text : element,
                value : element
            }))
        });
    }

    function attributeMap() {
        attributeMapObject[sourceattributes.val()] = targetattributes.val();
        attributemapping.val(JSON.stringify(attributeMapObject));
        sourceattributes.val('');
        targetattributes.val('');
        targetIds = Object.values(attributeMapObject).sort();
        smartidattributes.val(targetIds);
    }

    function smartId() {
        if ($('#smartidcheck:checked').length === 1) {
            smartidattributes.show();
        }
        else{
            smartidattributes.hide();
        }
    }

    function addMatchRule() {
        let matchRuleAppender = {}
        let matchResult = {
            noMatchResult : [
                {
                  "actions": [
                  ]
                }
              ],
            singleMatchResult : [
                {
                  "actions": [
                  ]
                }
              ],
            multiMatchResult : [
                {
                  "actions": [
                  ]
                }
              ]
        }

        if (nomatchresult.val() != '' && singlematchresult.val() != '' && multimatchresult.val() != '') {
            noMatchResult = nomatchresult.val().split(',');
            singleMatchResult = singlematchresult.val().split(',');
            multiMatchResult = multimatchresult.val().split(',');
    
            noMatchResult.forEach(element => {
                let obj = {};
                if (element != '') {
                    obj["actionName"] = element;
                    matchResult.noMatchResult[0].actions.push(obj); 
                }
            });
    
            singleMatchResult.forEach(element => {
                let obj = {};
                if (element != '') {
                    obj["actionName"] = element;
                    matchResult.singleMatchResult[0].actions.push(obj);
                }
            });
    
            multiMatchResult.forEach(element => {
                let obj = {};
                if (element != '') {
                    obj["actionName"] = element;
                    matchResult.multiMatchResult[0].actions.push(obj);
                }
            });
    
            copyDataFlag += noMatchResult.includes('CopyData') || singleMatchResult.includes('CopyData') || multiMatchResult.includes('CopyData');
            if (copyDataFlag > 0) {
                next.text("Next");
            }
            matchRuleAppender["seq"] = sequence.val();
            matchRuleAppender["matchType"] = matchType.val();
    
            if (matchType.val() === 'attributeBased') {
                let map = []
                map.push(attributeMapObject)
                matchRuleAppender["attributeMaps"] = map;
            }
            matchRuleAppender["noMatchResult"] = matchResult.noMatchResult;
            matchRuleAppender["singleMatchResult"] = matchResult.singleMatchResult;
            matchRuleAppender["multiMatchResult"] = matchResult.multiMatchResult;
    
            if ($('#smartidcheck:checked').length === 1) {
                let attributeNames = smartidattributes.val().split(',');
                matchRuleAppender["smartIdAttributes"] = [{attributeNames , "concatDelimiter" : "_"}];
            }
            
    
            if (matchSetSelectedIndex != -1) {
                return matchRuleAppender;
            }
            else{
                _checkAndAppend(matchRuleAppender);
            }
        }
        else{
            matchRuleAlert.show();
            window.setTimeout(function() {
                matchRuleAlert.fadeOut();
        }, 2000);
        }
          
    }

    function _checkAndAppend(matchRule) {
        if (matchRule.seq !='' && matchRule.seq > 0  && 
            matchRule.matchType !='' && 
            matchRule.noMatchResult[0].actions.length > 0 && matchRule.singleMatchResult[0].actions.length > 0 && 
            matchRule.multiMatchResult[0].actions.length > 0) 
        {
            if (matchRule.matchType === 'attributeBased' && Object.keys(matchRule.attributeMaps[0]).length === 0) {
                return;
            }
            MatchRules.push(matchRule);
            renderButton();
            _clearTab();
        }

    }

    function modifyMatchSet() {
        if (matchSetSelectedIndex != -1) {
            MatchRules[matchSetSelectedIndex] = addMatchRule();
            modifySetButton.hide();
            addSetButton.show();
            matchSetSelectedIndex = -1;
        }
    }

    function displayMatchSet() {

        addSetButton.hide();
        modifySetButton.show();
        matchSetSelectedIndex = $( "#matchRuleSetButtons div" ).index( this );

        let set = MatchRules[matchSetSelectedIndex];
        let nomatch = '';
        let singlematch = '';
        let multimatch = '';

        sequence.val(set.seq);
        matchType.val(set.matchType);
        if (set.matchType === 'attributeBased') {
            _matchToggle();
            attributeMapObject = set.attributeMaps[0];
            attributemapping.val(JSON.stringify(attributeMapObject));
            if (Object.keys(set).includes('smartIdAttributes')){
                smartidattributes.val(set.smartIdAttributes[0].attributeNames);
            }
        }

       
        set.noMatchResult[0].actions.forEach(element => {
            if (element.actionName===set.noMatchResult[0].actions[set.noMatchResult[0].actions.length-1].actionName) {
                nomatch = nomatch+element.actionName;
            }
            else{
                nomatch = nomatch+element.actionName+',';
            }
        });//nomatch
        
        set.singleMatchResult[0].actions.forEach(element => {
            if (element.actionName===set.singleMatchResult[0].actions[set.singleMatchResult[0].actions.length-1].actionName) {
                singlematch = singlematch+element.actionName;
            }
            else{
                singlematch = singlematch+element.actionName+',';
            }
        });//singlematch
        
        set.multiMatchResult[0].actions.forEach(element => {
            if (element.actionName===set.multiMatchResult[0].actions[set.multiMatchResult[0].actions.length-1].actionName) {
                multimatch = multimatch+element.actionName;
            }
            else{
                multimatch = multimatch+element.actionName+',';
            }
        });//multimatch
        
        nomatchresult.val(nomatch);
        singlematchresult.val(singlematch);
        multimatchresult.val(multimatch);
    }
    
    function renderButton() {
        matchRuleSetButtonsContainer.empty();
        MatchRules.forEach(element => {
            matchRuleSetButtonsContainer.append(('<div class ="btn btn-primary">'+element.seq+'</div>' +
            '<span> &nbsp; </span>'))
        })
    }

    function _clearTab() {

        attributeMapObject = {}
        noMatchResult = [];
        singleMatchResult = [];
        multiMatchResult = [];
        $("#matchrule").find(':input').each(function() {
        
            switch(this.type) {
                case 'password':
                case 'text':
                case 'textarea':
                case 'file':
                case 'select-one':
                case 'select-multiple':
                case 'date':
                case 'number':
                case 'tel':
                case 'email':
                    jQuery(this).val('');
                    break;
                case 'checkbox':
                case 'radio':
                    this.checked = false;
                    break;
            }
        });
        sequence.val(MatchRules.length+1);
        appendAttributeMap.hide();
    }

    function matchToolSize() {
        return MatchRules.length;
    }

    function sendMatchRuleSet() {
        return MatchRules;
    }

    function sendCopyDataFlag() {
        return copyDataFlag;
    }

    return {
        init : init,
        size : matchToolSize,
        matchRuleSet : sendMatchRuleSet,
        CopyDataFlag : sendCopyDataFlag
    }

}();

matchrule.init();

// @author Gnana Pradeep
// @company Riversand inc.