ace.define("ace/snippets/javascript",["require","exports","module"], function(require, exports, module) {
"use strict";

exports.snippetText = "# Prototype\n\
snippet proto\n\
	${1:class_name}.prototype.${2:method_name} = function(${3:first_argument}) {\n\
		${4:// body...}\n\
	};\n\
snippet iif\n\
	IIF[${0}]\n\
snippet if\n\
	IIF[${0}]\n\
snippet iterate\n\
	ITERATE[${0}]\n\
snippet IsFalseOrNull\n\
	IsFalseOrNull[\"${0:inputParameter}\"]\n\
snippet IsTrueOrNull\n\
	IsTrueOrNull[\"${0:inputParameter}\"]\n\
snippet Between\n\
	Between[\"${1:val}\",\"${2:firstVal}\",\"${3:lastVal}\"]\n\
snippet Contains\n\
	Contains[\"${1:substring}\",\"${2:inputStr1}\",\"${3:inputStr2}\"]\n\
snippet Date\n\
	Date[\"${1:month}\",\"${2:day}\",\"${3:year}\"]\n\
snippet DateAdd\n\
	DateAdd[\"${1:date}\",\"${2:type}\",\"${3:value}\"]\n\
snippet DateNow\n\
	DateNow[${0}]\n\
snippet DateTimeAdd\n\
	DateTimeAdd[\"${1:datetime}\",\"${2:type}\",\"${3:value}\"]\n\
snippet IsDateWeekend\n\
	IsDateWeekend[\"${1:yyyy}-${2:mm}-${3:dd}\"]\n\
snippet Day\n\
	Day[${0}]\n\
snippet Month\n\
	Month[${0}]\n\
snippet Year\n\
	Year[${0}]\n\
snippet Hour\n\
	Hour[${0}]\n\
snippet Minute\n\
	Minute[${0}]\n\
snippet Second\n\
	Second[${0}]\n\
snippet Now\n\
	Now[${0}]\n\
snippet Avg\n\
	Avg[\"${1:val1}\",\"${2:val2}\",\"${3:val3}\"]\n\
snippet NumericMax\n\
	NumericMax[\"${1:val1}\",\"${2:val2}\",\"${3:val3}\"]\n\
snippet NumericMin\n\
	NumericMin[\"${1:val1}\",\"${2:val2}\",\"${3:val3}\"]\n\
snippet Round\n\
	Round[\"${1:val}\",\"${2:digit}\"]\n\
snippet Concat\n\
	Concat[\"${1:inputStr1}\",\"${2:inputStr2}\"]\n\
snippet FindAndReplaceByRegex\n\
	FindAndReplaceByRegex[\"${1:stringToBeModified}\",\"${2:regex}\",\"${3:replacement}\"]\n\
snippet IndexOf\n\
	IndexOf[\"${1:inputStr}\",\"${2:searchStr}\"]\n\
snippet IsNullOrEmpty\n\
	IsNullOrEmpty[\"${1:inputStr}\"]\n\
snippet Join\n\
	Join[\"${1:delimiter}\",\"${2:inputStr1}\",\"${3:inputStr2}\"]\n\
snippet LCase\n\
	LCase[\"${1:inputStr}\"]\n\
snippet Left\n\
	Left[\"${1:inputStr}\",\"${2:noOfChars}\"]\n\
snippet Len\n\
	Len[\"${1:inputStr}\"]\n\
snippet LPad\n\
	LPad[\"${1:inputStr}\",\"${2:toAppend}\",\"${3:NoOfTimes}\"]\n\
snippet LTrim\n\
	LTrim[\"${1:inputStr}\"]\n\
snippet Right\n\
	Right[\"${1:inputStr}\",\"${2:noOfChars}\"]\n\
snippet Replace\n\
	Replace[\"${1:inputStr}\",\"${2:oldStr}\",\"${3:newStr}\"]\n\
snippet Remove\n\
	Remove[\"${1:inputStr}\",\"${2:toRemove}\"]\n\
snippet RPad\n\
	RPad[\"${1:inputStr}\",\"${2:toAppend}\",\"${3:noOfTimes}\"]\n\
snippet RTrim\n\
	RTrim[\"${1:inputStr}\"]\n\
snippet Substring\n\
	Substring[\"${1:inputStr}\",\"${2:startPos}\",\"${3:lenSubStr}\"]\n\
snippet Titlecase\n\
	Titlecase[\"${1:inputStr}\"]\n\
snippet Trim\n\
	Trim[\"${1:inputStr}\"]\n\
snippet UCase\n\
	UCase[\"${1:inputStr}\"]\n\
snippet Split\n\
	Split[\"${1:inputstring}\",\"${2:delimiter}\",\"${3:limit}\"]\n\
snippet ContextsHaveErrors\n\
	ContextsHaveErrors[\"${1:messageCode}\",\"${2:context1}\",\"${3:context2}\"]\n\
snippet IsContextChanged\n\
	IsContextChanged[\"${1:ctxType:ctxPath1}\",\"${2:ctxType:ctxPath2}\"]\n\
snippet GetContextPath\n\
	GetContextPath[\"${1:ctxType}\"]\n\
snippet GetEntityId\n\
	GetEntityId[\"${1:ANDACROSS/ORACROSS}\",\"${2:entitytype}\",\"${3:context}\",\"${4:attributeName:locale:_DEFAULT:operator:Val1a||Val1b}\",\"${5:attributeName:locale:_DEFAULT:operator:Val2}\",\"${6:attributeName:locale:_DEFAULT:operator:Val3}\"]\n\
snippet GetEntityIds\n\
	GetEntityIds[\"${1:ANDACROSS/ORACROSS}\",\"${2:entity type}\",\"${3:context}\",\"${4:attributeName:locale:_DEFAULT:operator:Val1}\"]\n\
snippet GetEntityType\n\
	GetEntityType[${0}]\n\
snippet GetEntityVersion\n\
	GetEntityVersion[${0}]\n\
snippet GetEntityName\n\
	GetEntityName[${0}]\n\
snippet GetEntityProperty\n\
	GetEntityProperty[\"${1:propertyName}\"]\n\
snippet GetWhereUsedEntityIds\n\
	GetWhereUsedEntityIds[\"${1:context}\",\"${2:relName}\",\"${3:target_EntityType}\"]\n\
snippet HasContextLinks\n\
	HasContextLinks[\"${1:context1}\",\"${2:context2}\",\"${3:matchExact}\"]\n\
snippet HaveErrorsInContext\n\
	HaveErrorsInContext[\"${1:messageCode}\",\"${2:type}\",\"${3:context}\"]\n\
snippet IsEntityDeleted\n\
	IsEntityDeleted[${0}]\n\
snippet IsEntityInWorkflow\n\
	IsEntityInWorkflow[\"${1:WorkflowShortName}\",\"2:ActivityShortName\"]\n\
snippet IsEntityInWorkflowInContext\n\
	IsEntityInWorkflowInContext[\"${1:context}\",\"${2:WorkflowShortName}\",\"${3:ActivityShortName}\"]\n\
snippet SetEntityProperty\n\
	SetEntityProperty[\"${1:propertyName}\",\"${2:value1}\",\"${3:value2}\"]\n\
snippet GetCurrentWorkflowAssignedUser\n\
	GetCurrentWorkflowAssignedUser[\"${1:WorkflowShortName}\",\"${2:ActivityShortName}\"]\n\
snippet AttributesHaveErrorsInContext\n\
	AttributesHaveErrorsInContext[\"${1:messageCode}\",\"${2:attr1, attr2, ...}\"]\n\
snippet GetAttributeValue\n\
	GetAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName}\"]\n\
snippet GetAttributeValues\n\
	GetAttributeValues[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName}\"]\n\
snippet GetAttributeValueFromContext\n\
	GetAttributeValueFromContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:attrName}\",\"${4:context}\"]\n\
snippet GetAttributeValuesWithDefault\n\
	GetAttributeValuesWithDefault[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName}\",\"${4:defValue1||defValue2}\"]\n\
snippet GetAttributeValuesWithDefaultFromContext\n\
	GetAttributeValuesWithDefaultFromContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName}\",\"${4:context}\",\"${5:defValue1||defValue2}\"]\n\
snippet GetAttributeValueWithDefaultFromContext\n\
	GetAttributeValueWithDefaultFromContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:attrName}\",\"${4:context}\",\"${5:default}\"]\n\
snippet GetAttributeValueReferenceId\n\
	GetAttributeValueReferenceId[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:RefAttributeName}\"]\n\
snippet GetAttributeValueReferenceIds\n\
	GetAttributeValueReferenceIds[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:RefAttributeName}\"]\n\
snippet GetAttributeValueProperty\n\
	GetAttributeValueProperty[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName}\",\"${4:AttributeProperty}\"]\n\
snippet GetEntityAttributeValueById\n\
	GetEntityAttributeValueById[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:EntityIdentifier}\",\"${4:EntityType}\",\"${5:attrName}\"]\n\
snippet GetEntityAttributeValueByIdInContext\n\
	GetEntityAttributeValueByIdInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:EntityIdentifier}\",\"${4:EntityType}\",\"${5:attrName}\",\"${6:context}\"]\n\
snippet GetNestedAttributeComputedValue\n\
	GetNestedAttributeComputedValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AVGACROSS/SUMACROSS/MINACROSS/MAXACROSS}\",\"${4:parentAttribute}\",\"${5:childAttribute}\"]\n\
snippet GetNestedAttributeValues\n\
	GetNestedAttributeValues[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:parentAttribute}\",\"${4:childAttribute}\",\"${5:true/false}\"]\n\
snippet GetNestedAttributeRow\n\
	GetNestedAttributeRow[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:Context}\",\"${4:NestedAttribute}\",\"${5:ChildAttributeName}\",\"${6:Condition}\",\"${7:Operator}\"]\n\
snippet GetNestedAttributeRows\n\
	GetNestedAttributeRows[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:Context}\",\"${4:NestedAttribute}\",\"${5:Condition}\",\"${6:Operator2}\"]\n\
snippet GetEntityNestedAttributeRow\n\
	GetEntityNestedAttributeRow[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:Context}\",\"${4:EntityId}\",\"${5:EntityType}\",\"${6:NestedAttributeName}\",\"${7:Condition}\",\"${8:Operator}\"]\n\
snippet GetEntityNestedAttributeRows\n\
	GetEntityNestedAttributeRows[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:Context}\",\"${4:EntityId}\",\"${5:EntityType}\",\"${6:NestedAttributeName}\",\"${7:Condition}\",\"${8:Operator}\"]\n\
snippet GetNestedAttributeValueAttributeReferenceID\n\
	GetNestedAttributeValueAttributeReferenceID[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:Context}\",\"${4:NestedAttributeName}\",\"${5:ChildAttributeName}\",\"${6:Condition}\",\"${8:Operator}\"]\n\
snippet GetRelatedEntityIdByAttributeValue\n\
	GetRelatedEntityIdByAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:AttributeName}\",\"${6:AttributeValue}\"]\n\
snippet GetRelatedEntityIdByAttributeValueFromContext\n\
	GetRelatedEntityIdByAttributeValueFromContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${4:relName}\",\"${5:relEntityType}\",\"${6:AttributeName}\",\"${7:AttributeValue}\"]\n\
snippet GetRelatedEntityIdsByAttributeValue\n\
	GetRelatedEntityIdsByAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:AttributeName}\",\"${6:AttributeValue}\"]\n\
snippet GetRelatedEntityIdsByAttributeValueFromContext\n\
	GetRelatedEntityIdsByAttributeValueFromContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${3:relName}\",\"${4:relEntityType}\",\"{5:AttributeName}\",\"${6:AttributeValue}\"]\n\
snippet HaveAnyAttributesChanged\n\
	HaveAnyAttributesChanged[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:attribute1}\",\"${4:attribute2}\"]\n\
snippet HaveAnyAttributesChangedInContext\n\
	HaveAnyAttributesChangedInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:attribute1,attribute2,...}\",\"${4:context1,context2,...}\"]\n\
snippet HaveAnyRelationshipAttributesChanged\n\
	HaveAnyRelationshipAttributesChanged[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:entityType}\",\"${5:attribute1}\",\"${6:attribute2}\"]\n\
snippet HaveAttributesChanged\n\
	HaveAttributesChanged[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:attr1}\",\"${4:attr2}\"]\n\
snippet HaveAttributesChangedInContext\n\
	HaveAttributesChangedInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:attribute1,attribute2,...}\",\"${4:context1,context2,...}\"]\n\
snippet IsAttributeLocalizable\n\
	IsAttributeLocalizable[\"${1:attrName}\"]\n\
snippet ValidateEmptyAttributes\n\
	ValidateEmptyAttributes[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName1}\",\"${4:AttributeName2}\"]\n\
snippet ValidateEmptyAttributesInContext\n\
	ValidateEmptyAttributesInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${4:AttributeName1}\",\"${5:AttributeName2}\"]\n\
snippet DeleteAttribute\n\
	DeleteAttribute[\"${1:locale}\",\"${2:_DEFAULT}\",\"${3:attributeName}\"]\n\
snippet DeleteAttributeInContext\n\
	DeleteAttributeInContext[\"${1:locale}\",\"${2:_DEFAULT}\",\"${3:attributeName}\",\"${4:context}\"]\n\
snippet AreRelationshipsDeleted\n\
	AreRelationshipsDeleted[\"${1:relname}\",\"${2:relatedEntityType}\",\"${3:context}\"]\n\
snippet CheckIfAnyRelationshipAttributeValueIs\n\
	CheckIfAnyRelationshipAttributeValueIs[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:relAttrName}\",\"${6:ValueToCompare}\"]\n\
snippet CheckIfAllRelatedEntityAttributeValueIs\n\
	CheckIfAllRelatedEntityAttributeValueIs[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:relAttrName}\",\"${6:ValueToCompare}\"]\n\
snippet CheckIfAnyRelatedEntityAttributeValueIs\n\
	CheckIfAnyRelatedEntityAttributeValueIs[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:AttributeName}\",\"${6:ValueToCompare}\"]\n\
snippet GetCurrentRelatedEntityIds\n\
	GetCurrentRelatedEntityIds[\"${1:ScopeOption}\",\"${2:context}\",\"${3:relationshipName}\",\"${4:relatedEntityType}\"]\n\
snippet GetRelatedEntityId\n\
	GetRelatedEntityId[\"${1:relName}\",\"${2:relEntityType}\"]\n\
snippet GetRelatedEntityIdForContext\n\
	GetRelatedEntityIdForContext[\"${1:relName}\",\"${2:relEntityType}\",\"${3:context}\"]\n\
snippet GetRelatedEntityIds\n\
	GetRelatedEntityIds[\"${1:relName}\",\"${2:relEntityType}\"]\n\
snippet GetRelatedEntityIdsForContext\n\
	GetRelatedEntityIdsForContext[\"${1:relName}\",\"${2:relEntityType}\",\"${3:context}\"]\n\
snippet GetRelatedEntityIdByRelationshipAttributeValue\n\
	GetRelatedEntityIdByRelationshipAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:AttributeName}\",\"${6:AttributeValue}\"]\n\
snippet GetRelatedEntityIdsByRelationshipAttributeValue\n\
	GetRelatedEntityIdsByRelationshipAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:AttributeName}\",\"${6:AttributeValue}\"]\n\
snippet GetRelatedEntityIdByRelationshipAttributeValueFromContext\n\
	GetRelatedEntityIdByRelationshipAttributeValueFromContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${4:relName}\",\"${5:relEntityType}\",\"${6:AttributeName}\",\"${7:AttributeValue}\"]\n\
snippet GetRelationshipAttributeValue\n\
	GetRelationshipAttributeValue[\"${1:Locale}\",\"${2:source}\",\"${3:relationshiptypename}\",\"${4:relEntityType}\",\"${5:relatedEntityId}\",\"${6:attributeName}\"]\n\
snippet HaveRelationships\n\
	HaveRelationships[\"${1:relName}\"]\n\
snippet HaveRelationshipsInContext\n\
	HaveRelationshipsInContext[\"${1:relName}\",\"${2:context1}\",\"${3:context2}\"]\n\
snippet HaveRelationshipsChanged\n\
	HaveRelationshipsChanged[\"${1:relName}\",\"${2:relEntityType}\"]\n\
snippet RelationshipsHaveErrorsInContext\n\
	RelationshipsHaveErrorsInContext[\"${1:messageCode}\",\"${2:relName}\",\"${3:context1,context2,...}\"]\n\
snippet RelationshipsCountInContext\n\
	RelationshipsCountInContext[\"${1:relName}\",\"${2:context1}\",\"${3:context2}\"]\n\
snippet ValidateEmptyRelationshipAttributes\n\
	ValidateEmptyRelationshipAttributes[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:RelName}\",\"${4:RelAttrName1}\",\"${5:RelAttrName2}\"]\n\
snippet ValidateEmptyRelationshipAttributesInContext\n\
	ValidateEmptyRelationshipAttributesInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${4:RelName}\",\"${5:RelAttrName1}\",\"${6:RelAttrName2}\"]\n\
snippet ValidateEmptyAttributesForRelatedEntities\n\
	ValidateEmptyAttributesForRelatedEntities[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:AttrName1}\",\"${5:AttrName2}\"]\n\
snippet ValidateEmptyAttributesForRelatedEntitiesInContext\n\
	ValidateEmptyAttributesForRelatedEntitiesInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:context}\",\"${5:AttrName1}\",\"${6:AttrName2}\"]\n\
snippet WhereUsedRelationship\n\
	WhereUsedRelationship[\"${1:RelationshipName}\",\"${2:EntityType}\"]\n\
snippet AddAttributeError\n\
	AddAttributeError[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:AttributeName}\"]\n\
snippet AddAttributeInformation\n\
	AddAttributeInformation[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:AttributeName}\"]\n\
snippet AddAttributeWarning\n\
	AddAttributeWarning[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:AttributeName}\"]\n\
snippet AddContextError\n\
	AddContextError[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:context}\"]\n\
snippet AddContextInformation\n\
	AddContextInformation[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:context}\"]\n\
snippet AddContextWarning\n\
	AddContextWarning[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:context}\"]\n\
snippet AddAttributeErrorInContext\n\
	AddAttributeErrorInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:context}\",\"${6:AttributeName}\"]\n\
snippet AddAttributeInformationInContext\n\
	AddAttributeInformationInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:context}\",\"${6:AttributeName}\"]\n\
snippet AddAttributeWarningInContext\n\
	AddAttributeWarningInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:context}\",\"${6:AttributeName}\"]\n\
snippet AddRelationshipAttributeError\n\
	AddRelationshipAttributeError[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:relName}\",\"${6:relatedEntityIdentifier}\",\"${7:relatedEntityType}\",\"${8:AttributeName}\"]\n\
snippet AddRelationshipAttributeInformation\n\
	AddRelationshipAttributeInformation[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:relName}\",\"${6:relatedEntityIdentifier}\",\"${7:relatedEntityType}\",\"${8:AttributeName}\"]\n\
	snippet AddRelationshipAttributeWarning\n\
	AddRelationshipAttributeWarning[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:relName}\",\"${6:relatedEntityIdentifier}\",\"${7:relatedEntityType}\",\"${8:AttributeName}\"]\n\
snippet AddRelationshipAttributeErrorInContext\n\
	AddRelationshipAttributeErrorInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:context}\",\"${6:relName}\",\"${7:relatedEntityId}\",\"${8:relatedEntityType}\",\"${9:AttributeName}\"]\n\
snippet AddRelationshipAttributeInformationInContext\n\
	AddRelationshipAttributeInformationInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:context}\",\"${6:relName}\",\"${7:relatedEntityId}\",\"${8:relatedEntityType}\",\"${9:AttributeName}\"]\n\
snippet AddRelationshipAttributeWarningInContext\n\
	AddRelationshipAttributeWarningInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:MessageCode}\",\"${4:Message||Params}\",\"${5:context}\",\"${6:relName}\",\"${7:relatedEntityId}\",\"${8:relatedEntityType}\",\"${9:AttributeName}\"]\n\
snippet AddRelationshipError\n\
	AddRelationshipError[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:relName}\",\"${4:relatedEntityId}\",\"${5:relatedEntityType}\"]\n\
snippet AddRelationshipInformation\n\
	AddRelationshipInformation[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:relName}\",\"${4:relatedEntityId}\",\"${5:relatedEntityType}\"]\n\
snippet AddRelationshipWarning\n\
	AddRelationshipWarning[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:relName}\",\"${4:relatedEntityId}\",\"${5:relatedEntityType}\"]\n\
snippet AddRelationshipInformationInContext\n\
	AddRelationshipInformationInContext[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:context}\",\"${4:relName}\",\"${5:relatedEntityId}\",\"${6:relatedEntityType}\"]\n\
snippet AddRelationshipWarningInContext\n\
	AddRelationshipWarningInContext[\"${1:MessageCode}\",\"${2:Message||Params}\",\"${3:context}\",\"${4:relName}\",\"${5:relatedEntityId}\",\"${6:relatedEntityType}\"]\n\
snippet IsCurrentUserInRole\n\
	IsCurrentUserInRole[\"${1:Role1}\",\"${2:Role2}\"]\n\
snippet CurrentUser\n\
	CurrentUser[${0}]\n\
snippet	GetUserOwnershipData\n\
	GetUserOwnershipData[\"${1:userId}\"]\n\
snippet	GetUserOwnershipEditData\n\
	GetUserOwnershipEditData[\"${1:userId}\"]\n\
snippet	GetUserOwnershipDataCollection\n\
	GetUserOwnershipDataCollection[\"${1:userId}\"]\n\
snippet	GetUserOwnershipEditDataCollection\n\
	GetUserOwnershipEditDataCollection[\"${1:userId}\"]\n\
snippet	GetClientAttributesFromRequest\n\
	GetClientAttributesFromRequest[\"${1:clientAttributePath}\"]\n\
snippet GetDefaultLocaleForTenant\n\
	GetDefaultLocaleForTenant[${0}]\n\
snippet	GetGlobalVariable\n\
	GetGlobalVariable[\"${1:variableName}\"]\n\
snippet GetRestAPIResponse\n\
	GetRestAPIResponse[\"${1:URL}\",\"${2:RequestBody}\",\"${3:PathofResponse}\",\"${4:HeaderParameters}\"]\n\
snippet GetUniqueId\n\
	GetUniqueId[${0}]\n\
snippet JoinStringCollection\n\
	JoinStringCollection[\"${1:stringCollection}\",\"${2:delimiter}\",\"${3:count}\"]\n\
snippet SetVariable\n\
	SetVariable[\"${1:variableName}\",\"${2:variableValue}\"]\n\
snippet SetGlobalVariable\n\
	SetGlobalVariable[\"${1:variableName}\",\"${2:variableValue1}\",\"${3:variableValue2}\"]\n\
snippet ValidateByRegex\n\
	ValidateByRegex[\"${1:Value}\",\"${2:Expression}\"]\n\
snippet GetOriginatingClientId\n\
	GetOriginatingClientId[${0}]\n\
snippet GetOriginatingClientId\n\
	GetOriginatingClientId[${0}]\n\
snippet GetClientId\n\
	GetClientId[${0}]\n\
snippet ValidateGTINCheckDigit\n\
	ValidateGTINCheckDigit[\"${1:integer}\"]\n\
snippet ValidateISBNCheckDigit\n\
	ValidateISBNCheckDigit[\"${1:integer}\"]\n\
snippet CalculateGTINCheckDigit\n\
	CalculateGTINCheckDigit[\"${1:integer}\"]\n\
snippet GetValueByJsonPath\n\
	GetValueByJsonPath[\"${1:sourcejson}\",\"${2:jsonpath}\"]\n\
snippet AddToContext\n\
	AddToContext[\"${1:context1}\",\"${2:context2}\"]\n\
snippet DeleteContext\n\
	DeleteContext[\"${1:context1}\",\"${2:context2}\"]\n\
snippet AddNestedAttributeRow\n\
	AddNestedAttributeRow[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:parentAtttributeName}\",\"${4:childattribute1:childAttribute1Value}\",\"${5:childAttribute2:childAttribute2Value}\"]\n\
snippet SetAttributeValue\n\
	SetAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName}\",\"${4:AttributeValue}\"]\n\
snippet SetAttributeValueInContext\n\
	SetAttributeValueInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${4:attrName}\",\"${5:attrValue}\"]\n\
snippet SetAttributeValues\n\
	SetAttributeValues[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:AttributeName}\",\"${4:MERGE/REPLACE}\",\"${5:Value1||Value2||Value3}\"]\n\
snippet SetAttributeValuesInContext\n\
	SetAttributeValuesInContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${4:AttributeName}\",\"${5:MERGE/REPLACE}\",\"${6:Value1||Value2||Value3}\"]\n\
snippet SetNestedChildAttributeByCondition\n\
	SetNestedChildAttributeByCondition[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:context}\",\"${4:MERGE/REPLACE}\",\"${5:NestedAttributeName}\",\"${6:ChildAttributeName:Value}\",\"${7:Condition}\",\"${8:Operator}\"]\n\
snippet DeleteRelationships\n\
	DeleteRelationships[\"${1:context}\",\"${2:EntityIdentifier1||EntityIdentifier2}\",\"${3:EntityType}\",\"${4:relName}\",\"${5:relEntityType}\",\"${6:relatedEntityIdentifier1||relatedEntityIdentifier2}\"]\n\
snippet SetRelationshipAttribute\n\
	SetRelationshipAttribute[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:_CURRENT/_ALL/relToId}\",\"${4:relName}\",\"${5:EntityType}\",\"${6:AttributeName}\",\"${7:AttributeValue1}\",\"${8:AttributeValue2}\"]\n\
snippet SetRelationshipAttributeFromRelatedEntity\n\
	SetRelationshipAttributeFromRelatedEntity[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:_CURRENT/_ALL/}\",\"${4:relName}\",\"${5:EntityType}\",\"${6:Target_AttributeName}\",\"${7:AttributeName}\"]\n\
snippet CopyAttributeValueToGovern\n\
	CopyAttributeValueToGovern[\"${1:AttributeName}\"]\n\
snippet ChangeAssignment\n\
	ChangeAssignment[\"${1:WokflowShortName}\",\"${2:ActivityShortName}\",\"${3:NewlyAssignedUserName}\"]\n\
snippet ChangeAssignmentInContext\n\
	ChangeAssignmentInContext[\"${1:context}\",\"${2:WokflowShortName}\",\"${3:ActivityShortName}\",\"${4:NewlyAssignedUserName}\"]\n\
snippet InitiateExport\n\
	InitiateExport[\"${1:export profile name1}\",\"${2:export profile name2}\"]\n\
snippet InitiateExportInContext\n\
	InitiateExportInContext[\"${1:context1||context2}\",\"${2:allContextual}\",\"${3:nonContextual}\",\"${4:NewlyAssignedUserName}\",\"${5:export profile name1}\",\"${6:export profile name2}\"]\n\
snippet InitiateExportForDeletedEntity\n\
	InitiateExportForDeletedEntity[\"${1:export profile name1}\",\"${2:export profile name2}\"]\n\
snippet InitiateExportForDeletedEntityInContext\n\
	InitiateExportForDeletedEntityInContext[\"${1:context1||context2}\",\"${2:allContextual}\",\"${3:nonContextual}\",\"${4:NewlyAssignedUserName}\",\"${5:export profile name1}\",\"${6:export profile name2}\"]\n\
snippet InvokeWorkflow\n\
	InvokeWorkflow[\"${1:WokflowShortName}\"]\n\
snippet InvokeWorkflowInContext\n\
	InvokeWorkflowInContext[\"${1:context}\",\"${2:WokflowName}\"]\n\
snippet ResumeWorkflow\n\
	ResumeWorkflow[\"${1:WorkflowShortName}\",\"${2:ActivityShortName}\",\"${3:Action}\",\"${4:Comments}\"]\n\
snippet ResumeWorkflowInContext\n\
	ResumeWorkflowInContext[\"${1:context}\",\"${2:WorkflowShortName}\",\"${3:ActivityShortName}\",\"${4:Action}\",\"${5:Comments}\"]\n\
snippet ScheduleEntityForExport\n\
	ScheduleEntityForExport[\"${1:tasktype}\",\"${2:exportprofileName1}\",\"${3:exportprofileName2}\"]\n\
snippet ScheduleEntityForGraphProcessing\n\
	ScheduleEntityForGraphProcessing[\"${1:graphconfigName}\",\"${2:tasktype}\"]\n\
snippet ScheduleWhereUsedEntitiesForGraphProcessing\n\
	ScheduleWhereUsedEntitiesForGraphProcessing[\"${1:relName}\",\"${2:target_EntityType}\",\"${3:graphconfigname}\",\"${4:tasktype}\"]\n\
snippet SendEntityForGraphProcessing\n\
	SendEntityForGraphProcessing[\"${1:configname}\",\"${2:workflowshortname}\",\"${3:ActivityShortName}\",\"${4:action}\"]\n\
snippet SendWhereUsedEntitiesForGraphProcessing\n\
	SendWhereUsedEntitiesForGraphProcessing[\"${1:relName}\",\"${2:target_EntityType}\",\"${3:graphconfigname}\"]\n\
snippet SendEmail\n\
	SendEmail[\"${1:toList}\",\"${2:ccList}\",\"${3:subject}\",\"${4:subjectContentTemplateName}\",\"${5:body}\,\"${6:bodyContentTemplateName}\"]\n\
snippet CreateSnapshot\n\
	CreateSnapshot[${0}]\n\
snippet RestoreSnapshot\n\
	RestoreSnapshot[${0}]\n\
snippet CreateEntity\n\
	CreateEntity[\"${1:Id}\",\"${2:type}\",\"${3:A1:locale:_DEFAULT:V1||V2}\",\"${4:A2:locale:_DEFAULT:V2}\"]\n\
snippet SetEntityAttributeValue\n\
	SetEntityAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:entityId}\",\"${4:entitytype}\",\"${5:AttrName}\",\"${6:AttrValue1}\",\"${7:AttrValue2}\"]\n\
snippet SetEntityAttributeValueForContext\n\
	SetEntityAttributeValueForContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:entityId}\",\"${4:entitytype}\",\"${5:context}\",\"${6:AttrName}\",\"${7:AttrValue1}\",\"${8:AttrValue2}\"]\n\
snippet AddEntityNestedAttributeRow\n\
	AddEntityNestedAttributeRow[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:Context}\",\"${4:EntityId}\",\"${5:EntityType}\",\"${6:NestedAttributeName}\",\"${7:ChildAttrName1:value1||value2}\",\"${8:ChildAttrName2:value1}\"]\n\
snippet ResumeRelatedEntityWorkflow\n\
	ResumeRelatedEntityWorkflow[\"${1:relationshipName}\",\"${2:relationshipDirection}\",\"${3:targetEntityType}\",\"${4:WorkflowShortName}\",\"${5:ActivityShortName}\",\"${6:action,}\",\"${7:comments}\"]\n\
snippet ScheduleRelatedEntitiesForGraphProcessing\n\
	ScheduleRelatedEntitiesForGraphProcessing[\"${1:relName}\",\"${2:graphconfigName}\",\"${3:tasktype}\"]\n\
snippet SendRelatedEntitiesForGraphProcessing\n\
	SendRelatedEntitiesForGraphProcessing[\"${1:relName}\",\"${2:graphconfigName}\"]\n\
snippet SetRelatedEntityAttributeValue\n\
	SetRelatedEntityAttributeValue[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:whereused}\",\"${6:AttrName,}\",\"${7:AttrValue1}\",\"${8:AttrValue2}\"]\n\
snippet SetRelatedEntityAttributeValueForContext\n\
	SetRelatedEntityAttributeValueForContext[\"${1:Locale}\",\"${2:_DEFAULT}\",\"${3:relName}\",\"${4:relEntityType}\",\"${5:whereused}\",\"${6:context,}\",\"${7:AttrName,}\",\"${8:AttrValue1}\",\"${9:AttrValue2}\"]\n\
snippet AddRelationshipInContextByEntityId\n\
	AddRelationshipInContextByEntityId[\"${1:context}\",\"${2:targetEntityId}\",\"${3:targetEntityType}\",\"${4:relName}\"]\n\
g";
exports.scope = "javascript";

});                (function() {
                    ace.require(["ace/snippets/javascript"], function(m) {
                        if (typeof module == "object" && typeof exports == "object" && module) {
                            module.exports = m;
                        }
                    });
                })();
            