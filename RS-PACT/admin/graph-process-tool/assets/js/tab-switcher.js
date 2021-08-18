"use strict";

let tabswitcher =  function () {
    let tabcount = 0;

    //cache DOM
    let container = $(".offering");
    let next = container.find("#next");
    let prev = container.find("#prev");
    let tabs = container.find(".tab");
    let create = container.find("#create");
    let modify = container.find("#modify");
    let step = container.find('.step');
    let alerts = container.find('.entity-selection');
    let wizard = container.find("#above");
    let jsonEditor = container.find("#below");
    let table = container.find('#myTable');
    let deleteGraphTrigger = container.find("#deletetrigger");
    let deleteJson = container.find("#deleteJson");
    let relationsTrigger = container.find("#relations-trigger");
    let noReltaionsNeeded = container.find("#noReltaionsNeeded");

    //bind events
    next.on('click', 1 , _counter);
    prev.on('click', -1 , _counter);
    create.on('click', 1, _counter);
    modify.on('click' , filler.fillGraphs);
    deleteJson.on('click', deleteGraph);
    noReltaionsNeeded.on('click', invokeGraph);

    function init() {
        _defaultRenderer();
      }

    function _defaultRenderer() {
        jsonEditor.hide();   //check
        tabs.eq(0).show();
        _stepindicator(0);
        
        if (tabcount === 0) {
            next.hide();
            prev.hide();
        }
        
    }
    async function deleteGraph() {
        let graph = await populator.fillForDelete();
        editor.invokeEditor(graph);
    }

    function _counter(countvalue) {
        if (_validator(tabcount) || countvalue.data === -1) {
            tabcount +=countvalue.data;
            let changed = 0;

            if (tabcount<0) {
                tabcount = 0;
            }
            else if (tabcount>5) {
                tabcount = 5;
                changed = 1
            }
            _navigator(tabcount , countvalue.data , changed);
            _helper(tabcount , countvalue.data);
            _tabRender(tabcount);
            _buttonController(tabcount , countvalue.data);
            _stepindicator(tabcount);
        }
    }

    async function _navigator(tabcount , flag , changed) {

        if (tabcount === 3 && flag === 1) {
            deleteGraphTrigger.click();
        }
        if (tabcount === 4) {
            if (matchrule.CopyDataFlag() === 0) {
                invokeGraph();
            }
        }
        if(tabcount === 5 && changed != 1){
            let data = attributesGrid.addAttributeData();
            let check = filler.fillRelationTab();
            if (check == -1) {
                invokeGraph();
            }
            else{
                relationsTrigger.click();
            }
        }
        if (tabcount === 5 && changed === 1) {
            invokeGraph();
        }

    }

    async function invokeGraph() {
        let graph = await populator.fill();
        editor.invokeEditor(graph);
    }

    function _tabRender(tabcount) {
        tabs.hide();
        tabs.eq(tabcount).show();
    }

    function _buttonController(tabcount , flag) {
        if (tabcount === 0) {
            next.hide();
            prev.hide();
        }
        if (tabcount>0) {
            next.show();
            prev.show();
        }
        if (tabcount === 3) {
            next.text("Generate Json")
        }
        if (tabcount ===2 && flag === -1) {
            next.text("Next");
        }
        if(tabcount === tabs.length-1){
            next.text("Generate Json");
        }

        if (tabcount === tabs.length-2 && flag === -1) {
            next.text("Next");
        }
    }

    function _stepindicator(stepIndex) {
        step.removeClass('active');
        step.eq(stepIndex).addClass('active');
    }

    function _validator(tabcount) {
        let valid = true;
        let inputCheck = tabs.eq(tabcount).find('input');
        let optionCheck = tabs.eq(tabcount).find('select');
        

        for (let i = 0; i < inputCheck.length; i++) {
            if (inputCheck.eq(i).val() === "") {
                inputCheck.eq(i).addClass('invalid');
                valid = false;
            }            
        }
        
        for (let i = 0; i < optionCheck.length; i++) {
            if (optionCheck.eq(i).val() === "") {
                valid = false;
            }          
        }

        if (tabcount === 3 && matchrule.size() > 0) {
            valid = true;
        }
        else if (tabcount === 3 && matchrule.size() === 0) {
            //alert
        }
        return valid;

    }

    function _helper(tabcount,flag) {
        
        if (tabcount === 2 && flag === 1) {
            filler.fillInfo();
        }
    }

    return {
        init : init
    }

}();

tabswitcher.init();

// @author Gnana Pradeep
// @company Riversand inc.