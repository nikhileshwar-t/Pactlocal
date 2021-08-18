"use strict";
const ValidationController = (() => {

    let finalResponse = [];
    const controller = async (rowObject) => {
        document.getElementById('generated').classList.add('d-none');
        document.getElementById('generating').classList.remove('d-none');
        let batches = Math.ceil(rowObject.length /70)
        for (let i = 0; i < batches; i++) {
            let batch = await APIController.validate(JSON.stringify(rowObject.splice(0 , 69)));
            batch = JSON.parse(batch);
            finalResponse.push(...batch)     
        }
    
        document.getElementById('generated').classList.remove('d-none');
        document.getElementById('generating').classList.add('d-none');
        return finalResponse;
    }

    return{
        validate : controller
    }

})();

// @author Gnana Pradeep
// @company Riversand inc.