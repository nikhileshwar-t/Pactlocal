"use strict";

const APIController = (() => {

    let tenantDetails = null;

    let getActiveTenant = async () => {
        $.ajax({
            url: HTTP_SERVER + "api/users.php?method=getUserActiveTenant",
            type: 'POST',
            dataType: 'text',
            async: false,
            contentType: 'application/x-www-form-urlencoded',
            success: function (response) {
                response = response.replace('Array', ''); //remove this
                response = JSON.parse(response);
                if (response.status == "success") {
                    tenantDetails = response;
                }
            }
        });
        validateTenant();
        return tenantDetails;
    };

    const validateTenant = () => {
        $('#tenant-connected').removeClass('text-danger');
        $('#tenant-connected').addClass('text-success');
        $('#current-tenant').html(tenantDetails.data[0].tenant_id);
    }

    const invokeAPI = async (body, apiurl) => {

        let api = null;
        if (apiurl === undefined) {
            api = '/api/entityModelService/get';
        }
        else {
            api = apiurl;
        }
        try {
            let URL = tenantDetails.data[0].web_url + api;
            let myheaders = new Headers();
            myheaders.append('x-rdp-clientId', 'rdpclient');
            myheaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
            myheaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
            myheaders.append('auth-client-id', tenantDetails.data[0].client_id);
            myheaders.append('auth-client-secret', tenantDetails.data[0].client_secret);

            let requestOptions = {
                method: 'POST',
                headers: myheaders,
                body: body,
                redirect: 'follow'
            };

            let response = await fetch(URL, requestOptions)
                .then(response => response.text())
            return response;
        }
        catch (error) {
            return error;
        }
    }

    let brValidator = async (br) => {
        
        let myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        myHeaders.append('Keep-Alive' , "timeout=20 , max=1000")

        let requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: br,
            redirect: 'follow'
        };

        let response = fetch("https://best-practices-validator.herokuapp.com/validate", requestOptions)
        // console.warn('local host is used')
        // let response = fetch("http://localhost:7071/validate", requestOptions)
            .then(response => response.text())
            .catch(error => console.log('error', error));
        return response;
    }

    const fileReader = async (path) => {
        let raw = await fetch(JSON_PATH + path)
            .then(response => response.text());
        return raw;
    }

    const tenantNameGetter = async () => {
        return tenantDetails.data[0].tenant_id;
    }

    return {
        sendRequest: invokeAPI,
        readFile: fileReader,
        getActiveUser: getActiveTenant,
        validateTenant: validateTenant,
        tenantName: tenantNameGetter,
        validate: brValidator
    }
})();

// @author Gnana Pradeep
// @company Riversand inc.