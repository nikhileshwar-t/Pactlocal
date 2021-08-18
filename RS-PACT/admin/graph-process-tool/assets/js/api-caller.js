"use strict";

let apiCaller = function () {
	let tenantDetails = [];

	async function init() {
		tenantDetails =  _getActiveTenantAPI();
	}

	function _getActiveTenantAPI() {
		let tenantDetails = [];
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
	}

	async function invokeAPI(body) {

		let URL = tenantDetails.data[0].web_url + "/api/entityModelService/get";

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
	}

	async function fileReader(path) {
		let raw = await fetch(path)
		.then(response => response.text());
		return raw;
	}

	return {
		init : init,
		fileReader : fileReader,
		invokeAPI : invokeAPI
	}
}();

apiCaller.init();

// @author Gnana Pradeep
// @company Riversand inc.