"use strict";

const APIController = (() => {

    let tenantDetails = null;
    let getActiveTenant = async() => {
		$.ajax({
			url: HTTP_SERVER + "api/users.php?method=getUserActiveTenant",
			type: 'POST',
			dataType: 'text',
			async: false,
			contentType: 'application/x-www-form-urlencoded',
			success: function (response) {
				response = JSON.parse(response);
				if (response.status == "success") {
					tenantDetails = response;
				}
			}
        });
        return tenantDetails;
    };

    const invokeAPI = async (body , apiurl) => {
        
        let api = null;
        if (apiurl === undefined) {
            api = '/api/entityModelService/get';
        }
        else{
            api = apiurl;
        }
        try {
            let URL = tenantDetails.data[0].web_url + api;
            let myheaders = new Headers();
            myheaders.append('x-rdp-clientId' ,  'rdpclient');
            myheaders.append('x-rdp-tenantId' , tenantDetails.data[0].tenant_id);
            myheaders.append('x-rdp-userId' , tenantDetails.data[0].api_user_id);
            myheaders.append('auth-client-id' , tenantDetails.data[0].client_id);
            myheaders.append('auth-client-secret' , tenantDetails.data[0].client_secret);
        
            let requestOptions = {
                method: 'POST',
                headers: myheaders,
                body: body,
                redirect: 'follow'
            };
    
            let response = await fetch(URL, requestOptions)
                .then(response => response.text())
            return response;
        } catch (error) {
            return null;
        }
    }

    const fileReader = async (path) => {
        let raw = await fetch(JSON_PATH + path)
        .then(response => response.text());
		return raw;
    }

    return {
        sendRequest : invokeAPI ,
        readFile : fileReader,
        getActiveUser : getActiveTenant
    }


})();

// @author Gnana Pradeep
// @company Riversand inc.