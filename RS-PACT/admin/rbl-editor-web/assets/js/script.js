

let BRType = null;

function setBRType(Type) {
    BRType = Type;

    // FOR DISPLAYING THE SELECTED OPTION (JQUERY)

}
$('#BRtype a').click(function () {
    $('#selected').text($(this).text());
});

function APIValidation() {
    let BRRaw = document.getElementsByClassName("ace_scroller")[0].innerText;
    if (BRType == "" || BRType == undefined) {
        swal('', 'Select Type Of Business Rule', 'info')
    }
    if (BRRaw == "" || BRRaw == null || BRRaw == undefined) {
        swal('', 'There is noo Business Rule to Validate please enter the Business Rule before checking', 'info')
    }

    if (BRType != "" && BRType != null && BRType != undefined && BRRaw != "" && BRRaw != null && BRRaw != undefined) {
        let BR = inlineFormatter();
        ValidateBRFunction(BRType, BR);
    }
}

function ValidateBRFunction(BRType, BR, element) {

    //let URL ="http://manage.rdprunna01.riversand-dataplatform.com:8085/rspactools/api/modelgovernservice/validate"

    let URL = "https://rspactools.riversand.com/api/modelgovernservice/validate"
    readTextFile("ValidateBRData.json", function (text) {
        postData = JSON.parse(text);
        postData.entityModel.data.attributes.ruleType.values[0].value = BRType;
        postData.entityModel.data.attributes.definition.values[0].value = BR;
        makeCorsRequest(URL, JSON.stringify(postData), displayResponse, element);
    });
}

function readTextFile(file, callback) {
    let rawFile = new XMLHttpRequest();
    rawFile.overrideMimeType("application/json");
    rawFile.open("GET", file, true);
    rawFile.onreadystatechange = function () {
        if (rawFile.readyState === 4 && rawFile.status == "200") {
            callback(rawFile.responseText);
        }
    }
    rawFile.send(null);
}

function displayResponse(response, element) {

    response = JSON.parse(response);
    let messageElement = element;

    if (!element) {
        messageElement = document.getElementById("status");
    }

    if (!validResponse(response)) {
        messageElement.setAttribute("style", "color: red");

        if (has(response, 'response')) {
            messageElement.innerHTML = JSON.stringify(response.response);
        } else {
            messageElement.innerHTML = JSON.stringify(response);
        }
        return;
    }

    let attributes = response.response.entityModels[0].data.attributes;
    let message = '';
    if (has(attributes, 'ruleType')) {
        message = attributes.ruleType.properties.messages[0]
    }
    else if (has(attributes, 'definition')) {
        message = attributes.definition.properties.messages[0]
    } else {
        messageElement.setAttribute("style", "color: red");
        messageElement.innerHTML = JSON.stringify(response);

        return;
    }

    if (message.messageType == 'success') {
        swal(message.messageCode, "Success", "success");
    }
    else {
        swal(message.messageCode, message.message, "error");

    }
}

function validResponse(response) {
    if (!has(response, 'response')) {
        return false;
    }

    if (!has(response.response, 'entityModels')) {
        return false;
    }

    if (!has(response.response.entityModels[0], 'data')) {
        return false;
    }

    if (!has(response.response.entityModels[0].data, 'attributes')) {
        return false;
    }

    return true;
}

function has(object, key) {
    return object ? hasOwnProperty.call(object, key) : false;
}

function createCORSRequest(method, url, callback) {
    let xhr = new XMLHttpRequest();

    if ("withCredentials" in xhr) {
        // XHR for Chrome/Firefox/Opera/Safari.
        xhr.open(method, url, true);
    }
    else if (typeof XDomainRequest != "undefined") {
        // XDomainRequest for IE.
        xhr = new XDomainRequest();
        xhr.open(method, url);
    } else {
        // CORS not supported.
        xhr = null;
    }
    xhr.setRequestHeader('x-rdp-clientId', 'rdpclient');
    xhr.setRequestHeader('x-rdp-tenantId', 'rspactools');
    xhr.setRequestHeader('x-rdp-userId', 'rspactools.admin@riversand.com');
    xhr.setRequestHeader('auth-client-id', '40PS7RT46qOgEMB075q1atjG64WQ7KbS');
    xhr.setRequestHeader('auth-client-secret', 'KDK9CU1RppnAJgwNyxN2LDzeIQBeupEK9wutNYX0rTR4GDtSM1dY7dlezCoHy5Va');

    return xhr;
}


function makeCorsRequest(url, data, callback, element) {
    let xhr = createCORSRequest('POST', url);
    if (!xhr) {
        alert('CORS not supported');
        return;
    }
    xhr.onreadystatechange = function () {//Call a function when the state changes.
        if (xhr.readyState == 4 && xhr.status == 200) {
            callback(xhr.responseText, element);
        }
    }

    xhr.onerror = function () {
        swal("Woops, there was an error making the request. Might be a browser issue.", '', "warning");
    };

    xhr.send(data);
}

function wordFormat() {
    // this.convertToInline();
    // let BRRaw = document.getElementsByClassName("ace_scroller")[0].innerText;
    let BRRaw = editor.getValue();

    let WordFormatted = BRRaw.replace(/;/g, ";\n")
        //.replace( /]*\s*AND*\s/g,"] AND\n" )
        .replace(/ANDIIF/g, "AND\nIIF")
        .replace(/\n+\n/g, "\n")
        //.replace( /]*\s*OR*\s/gi,"] OR\n" )
        .replace(/ORIIF/g, "OR\nIIF")
        .replace(/,~/g, ",\n\t~")
        .replace(/, ~/g, ",\n\t~")
        .replace(/\[~/g, "[\n\t~")
        .replace(/\[ ~/g, "[\n\t~")
        .replace(/\]~/g, "]\n\t~")
        .replace(/\] ~/g, "]\n\t~")
        .replace(/AND~/g, "AND\n\t~")
        .replace(/OR~/g, "OR\n\t~")
        .replace(/OR\s~/g, "OR\n\t~")
        .replace(/AND\s~/g, "AND\n\t~")
        .replace(/\n\t\n\t~/g, ",\n\t~")
        .replace(/\[\n\t\n\t~/g, "[\n\t~")
        .replace(/\]\n\t\n\t~/g, "]\n\t~")
        .replace(/AND\n\t\n\t~/g, "AND\n\t~")
        .replace(/OR\n\t\n\t~/g, "OR\n\t~")
        .replace(/\s~/g, "~\n\t")//review
        .replace(/~\n\t\n\t/g, "~\n\t")
        .replace(/":;\n"/g, "\":;\"")//use
        .replace(/\],true/g, "]\n,true")
        .replace(/\],false/, "]\n,false")
        .replace(/]\n\n,true/g, "]\n,true")
        .replace(/]\n\n,false/g, "]\n,false")
        .replace(/\n~/g, "\n\t~")
        .replace(/\n\t\n\t~/g, "\n\t~")
        .replace(/~IIF\[/g, "~\nIIF[")
        .replace(/~\n\nIIF\[/g, "~\nIIF[")
        .replace(/~ITERATE\[/g, "~\nITERATE[")
        .replace(/~\n\nITERATE\[/g, "~\nITERATE[")
        .replace(/~~/g, "~\n\t~")
        .replace(/~]/g, "~\n]")
        .replace(/~\n\n]/g, "~\n]")
        .replace(/]+]+/g, "]\n]")
        .replace(/]\n\n]/g, "]\n]")
        .replace(/,\(/g, ",\n\t(")
        .replace(/,\n\n\t\t\(/g, ",\n\t(")
        .replace(/,`\(/g, ",\n\t`(")
        .replace(/,\n\n\t\t`\(/g, ",\n\t`(");

    for (let i = 0; i <= 100; i++) {
        for (let i = 1; i <= kews.length; i++) {
            WordFormatted = WordFormatted.replace("," + kews[i] + "[", ",\n" + kews[i] + "[")
                .replace("~" + kews[i] + "[", "~\n\t" + kews[i] + "[")
                .replace(",\n\n\t\t" + kews[i] + "[", ",\n\t" + kews[i] + "[")
                .replace("~\n\n\t\t" + kews[i] + "[", "~\n\t" + kews[i] + "[")
                .replace("AND " + kews[i] + "[", " AND\n" + kews[i] + "[")
                .replace("AND  " + kews[i] + "[", " AND\n" + kews[i] + "[")
                .replace("  AND\n\n" + kews[i] + "[", " AND\n" + kews[i] + "[")
                .replace("OR " + kews[i] + "[", " OR\n" + kews[i] + "[")
                .replace("OR  " + kews[i] + "[", " OR\n" + kews[i] + "[")
                .replace("  OR\n\n" + kews[i] + "[", " OR\n" + kews[i] + "[")
        }
    }

    // editor.getSession().indentedSoftWrap(true);
    // editor.setBehavioursEnabled(false);
    editor.setValue(WordFormatted, 0);
    editor.clearSelection();
}

function copy() {
    let inline = inlineFormatter();
    let s = document.createElement('textarea');
    s.value = inline;
    //s.setAttribute('style', "display:none")
    document.body.appendChild(s);
    s.focus();
    s.select();
    document.execCommand("copy");
    swal('', 'Inline Business Rule copied to clipboard', 'success')
}

function convertToInline() {
    let inline = inlineFormatter();
    editor.setValue(inline, 0);
    editor.clearSelection();
}

function inlineFormatter() {
    let BRRaw = editor.getValue();
    let BR;
    BR = BRRaw.replace(/\n/g, " ")
        .replace(/ /g, "")
        .replace(/\t/g, " ")
        .replace(/,\n~/g, ",~")
        .replace(/~\n\t/g, "~ ")
        .replace(/AND\n\t~/g, "AND ~")
        .replace(/AND/g, " AND ")
        .replace(/OR\n\t~/g, "OR ~")
        .replace(/OR/g, " OR ")
        .replace(/~\nIIF\[/g, "~IIF[")
        .replace(/~\nITERATE\[/g, "~ITERATE[")
        .replace(/~\n]/g, "~]")
        .replace(/  /g, " ")
        .replace(/]\n]/g, "]]")

    return BR;

}

let lineNumberCount = 0;
function lineNumbering() {
    lineNumberCount += 1;
    if (lineNumberCount % 2 == 1) {
        editor.setShowPrintMargin(false);
        editor.renderer.setShowGutter(false);
        editor.renderer.setHighlightGutterLine(false);
    }
    else {
        editor.setShowPrintMargin(true);
        editor.renderer.setShowGutter(true);
        editor.renderer.setHighlightGutterLine(true);
    }
}

function clearEditor() {

    editor.setValue("", 0);
    editor.clearSelection();

}


let theme;
function setTheme(themefrom) {
    theme = themefrom
}

function editorTheme() {
    let theming = "ace/theme/" + theme;
    editor.setTheme(theming);
}

$('#themetype a').click(function () {
    $('#theme-menu').text($(this).text());
});


function setFontSize(size) {

    editor.setFontSize(size);

    $('#fontsize a').click(function () {
        $('#font').text($(this).text());
    });
}

let BestPracticesValidation = () => {
    let BRRaw = editor.getValue();
    if (BRRaw !== '') {
        let BestPracticesValidationPayload = { "params": { "businessRules": { "editorBR": BRRaw } } };
        let myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
    
        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: JSON.stringify(BestPracticesValidationPayload),
            redirect: 'follow'
        };
    
        let errorValue = ''
        fetch("https://best-practices-validator.herokuapp.com/bestPractices/all", requestOptions)
            .then(response => response.text())
            .then(result => {
                result = JSON.parse(result)
                let BRResponse = result.response.businessRules.editorBR
                if (BRResponse.status === 'success' ) {
                    swal("success" , BRResponse.message , 'success')
                }
                else if (BRResponse.status === 'error') {
                    let index = 1
                    for (const key in BRResponse.errorKeywords) {

                        errorValue += `<b>${index + ". " + key}</b> : <br><ul>`
                        BRResponse.errorKeywords[key].warnings.forEach((element , index) => {
                            
                            let test = `<li>${element}</li>`
                            errorValue += test
                        })
                        errorValue += '</ul>'
                        index++;
                    }
                    
                    // errorValue.replace(',' , '\n')
                    console.log(errorValue)
                    document.getElementById('errors').innerHTML = errorValue;
                    $('#myModal').modal('show')
                }
            })
            .catch(error => console.log('error', error));
    }
    else{
        swal('', 'There is noo Business Rule to Validate Best Practices please enter the Business Rule before checking', 'info')
    }
}

let save = () => {
      localStorage.setItem('existingBR', editor.getValue());
}

let kews = ["IsFalseOrNull", "IsTrueOrNull", "Between", "Contains", "Date", "DateAdd", "DateNow", "DateTimeAdd", "IsDateWeekend", "Day", "Month", "Year", "Hour", "Minute", "Second", "Now", "Avg", "NumericMax", "NumericMin", "Round", "Concat", "FindAndReplaceByRegex", "IndexOf", "IsNullOrEmpty", "Join", "LCase", "Left", "Len", "LPad", "LTrim", "Right", "Replace", "Remove", "RPad", "RTrim", "Substring", "Titlecase", "Trim", "UCase", "Split", "ContextsHaveErrors", "IsContextChanged", "GetContextPath", "GetEntityId", "GetEntityIds", "GetEntityType", "GetEntityVersion", "GetEntityName", "GetEntityProperty", "GetWhereUsedEntityIds", "HasContextLinks", "HaveErrorsInContext", "IsEntityDeleted", "IsEntityInWorkflow", "IsEntityInWorkflowInContext", "SetEntityProperty", "GetCurrentWorkflowAssignedUser", "AttributesHaveErrorsInContext", "GetAttributeValue", "GetAttributeValueFromContext", "GetAttributeValuesWithDefault", "GetAttributeValuesWithDefaultFromContext", "GetAttributeValueWithDefaultFromContext", "GetAttributeValueReferenceId", "GetAttributeValueReferenceIds", "GetAttributeValueProperty", "GetEntityAttributeValueById", "GetEntityAttributeValueByIdInContext", "GetNestedAttributeComputedValue", "GetNestedAttributeValues", "GetNestedAttributeRow", "GetNestedAttributeRows", "GetEntityNestedAttributeRow", "GetEntityNestedAttributeRows", "GetNestedAttributeValueAttributeReferenceID", "GetRelatedEntityIdByAttributeValue", "GetRelatedEntityIdByAttributeValueFromContext", "GetRelatedEntityIdsByAttributeValue", "GetRelatedEntityIdsByAttributeValueFromContext", "HaveAnyAttributesChanged", "HaveAnyAttributesChangedInContext", "HaveAnyRelationshipAttributesChanged", "HaveAttributesChanged", "HaveAttributesChangedInContext", "IsAttributeLocalizable", "ValidateEmptyAttributes", "ValidateEmptyAttributesInContext", "DeleteAttribute", "DeleteAttributeInContext", "AreRelationshipsDeleted", "CheckIfAnyRelationshipAttributeValueIs", "CheckIfAllRelatedEntityAttributeValueIs", "CheckIfAnyRelatedEntityAttributeValueIs", "GetCurrentRelatedEntityIds", "GetRelatedEntityId", "GetRelatedEntityIdForContext", "GetRelatedEntityIds", "GetRelatedEntityIdsForContext", "GetRelatedEntityIdByRelationshipAttributeValue", "GetRelatedEntityIdsByRelationshipAttributeValue", "GetRelatedEntityIdByRelationshipAttributeValueFromContext", "GetRelationshipAttributevalue", "HaveRelationships", "HaveRelationshipsInContext", "HaveRelationshipsChanged", "RelationshipsHaveErrorsInContext", "RelationshipsCountInContext", "ValidateEmptyRelationshipAttributes", "ValidateEmptyRelationshipAttributesInContext", "ValidateEmptyAttributesForRelatedEntities", "ValidateEmptyAttributesForRelatedEntitiesInContext", "WhereUsedRelationship", "AddAttributeError", "AddAttributeInformation", "AddAttributeWarning", "AddContextError", "AddContextInformation", "AddContextWarning", "AddAttributeErrorInContext", "AddAttributeInformationInContext", "AddAttributeWarningInContext", "AddRelationshipAttributeError", "AddRelationshipAttributeInformation", "AddRelationshipAttributeWarning", "AddRelationshipAttributeErrorInContext", "AddRelationshipAttributeInformationInContext", "AddRelationshipAttributeWarningInContext", "AddRelationshipError", "AddRelationshipInformation", "AddRelationshipWarning", "AddRelationshipInformationInContext", "AddRelationshipErrorInContext", "AddRelationshipWarningInContext", "IsCurrentUserInRole", "CurrentUser", "GetUserOwnershipData", "GetUserOwnershipEditData", "GetUserOwnershipDataCollection", "GetUserOwnershipEditDataCollection", "GetClientAttributesFromRequest", "GetDefaultLocaleForTenant", "GetGlobalVariable", "GetRestAPIResponse", "GetUniqueId", "JoinStringCollection", "SetVariable", "SetGlobalVariable", "ValidateByRegex", "GetOriginatingClientId", "GetClientId", "ValidateGTINCheckDigit", "ValidateISBNCheckDigit", "CalculateGTINCheckDigit", "GetValueByJsonPath", "AddToContext", "DeleteContext", "AddNestedAttributeRow", "SetAttributeValue", "SetAttributeValueInContext", "SetAttributeValues", "SetAttributeValuesInContext", "SetNestedChildAttributeByCondition", "DeleteRelationships", "SetRelationshipAttribute", "SetRelationshipAttributeFromRelatedEntity", "CopyAttributeValueToGovern", "ChangeAssignment", "ChangeAssignmentInContext", "InitiateExport", "InitiateExportInContext", "InitiateExportForDeletedEntity", "InitiateExportForDeletedEntityInContext", "InvokeWorkflow", "InvokeWorkflowInContext", "ResumeWorkflow", "ResumeWorkflowInContext ", "ScheduleEntityForExport", "ScheduleEntityForGraphProcessing", "ScheduleWhereUsedEntitiesForGraphProcessing", "SendEntityForGraphProcessing", "SendWhereUsedEntitiesForGraphProcessing", "SendEmail", "CreateSnapshot", "RestoreSnapshot", "CreateEntity", "SetEntityAttributeValue", "SetEntityAttributeValueForContext", "AddEntityNestedAttributeRow", "ResumeRelatedEntityWorkflow", "ScheduleRelatedEntitiesForGraphProcessing", "SendRelatedEntitiesForGraphProcessing", "SetRelatedEntityAttributeValue", "SetRelatedEntityAttributeValueForContext", "AddRelationshipInContextByEntityId", "AddRelationshipInContextByEntityId"];
