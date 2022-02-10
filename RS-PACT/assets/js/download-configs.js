
const getActiveTenant = async () => {
  let myHeaders = new Headers();
  myHeaders.append("Cookie", "PHPSESSID=euv02ku81rsefpb397qhql4262");

  let requestOptions = {
      method: 'GET',
      headers: myHeaders,
      redirect: 'follow'
  };
 
  return fetch(HTTP_SERVER + "api/users.php?method=getUserActiveTenant", requestOptions)
      .then(response => response.text())
      //   .then(result => tenantDetails = JSON.parse(result.split('Array')[1]))
      .then(result => {
         
          return JSON.parse(result)
      })
      .catch(error => console.log('error', error));
};





let uiConfig = [];
let Profiledata = [];
let Graphsdata = [];
let tenentconfig = [];
let configContexts = [];
let domainconfig = [];
let appconfig = [];
let entitytypeconfig = [];
let contextualconfig = [];
let relationshipconfig = [];
let sourceconfig = [];
let localeconfig = [];
let roleconfig = [];
let rockconfig =[];
let configobjects= [];
let integrationobjects= [];
let profileobjects= [];
let serviceobjects = [];
let matchobjects= [];
let matchconfigdata=[];
let savedsearchobjects = [];
let sheduletaskobjects = [];
let notificationobjects=[];
let savedscopeobjects=[];
let rendetionobjects=[];

let userconfig =[];




getUiconfigs()


async function getUiconfigs() {
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
  // const url = "https://vidaxl.riversand.com/api/configurationservice/get";

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);
  let raw = JSON.stringify({ "params": { "query": { "contexts": [{}], "filters": { "typesCriterion": ["uiconfig"], "allContextual": true } }, "allContextual": true, "fields": { "properties": ["_ALL"], "attributes": ["_ALL"], "relationships": ["_ALL"] } } });

  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
 

  uiConfig = (JSON.stringify(data.response.configObjects, null, 4));



  let allconfigobjects = data.response.configObjects;


  for (var i = 0; i < allconfigobjects.length; i++) {

      let x = allconfigobjects[i].id;
      const substring = "sys_";
      if (x.includes(substring)) {

      }
      else {
          
          configobjects.push(allconfigobjects[i]);
      }
  }

  // for (var i = 0; i < configobjects.length; i++) {
  //     if (configobjects[i].data.contexts[0].jsonData.config.hasOwnProperty("contextSchema")) {
  //         configContexts.push(configobjects[i]);
  //         configobjects.splice(i, 1)
  //     }

  // }
  for (let i = 0; i < configobjects.length; i++) {

      let context = configobjects[i].data.contexts[0].context;
        
        if (context.hasOwnProperty("user")&&context.user!== "_DEFAULT") {
       
            

            let keys = Object.keys(context)
            
            for(var j=0 ; j<=keys.length ; j++ ) {
                if(context[keys[j]] === "_DEFAULT"){
                  delete context[keys[j]]
                }
              }
              
              userconfig.push(configobjects[i]);
             
               

                
        }
        else if(context.hasOwnProperty("role")&&context.role!== "_DEFAULT")
        {
            let keys = Object.keys(context)
            
            for(var j=0 ; j<=keys.length ; j++ ) {
                if(context[keys[j]] === "_DEFAULT"){
                  delete context[keys[j]]
                }
              }
          
          roleconfig.push(configobjects[i]);
         
        
        }
        else if(context.hasOwnProperty("relationship")&&context.relationship!== "_DEFAULT")
        {
            let keys = Object.keys(context)
            
            for(var j=0 ; j<=keys.length ; j++ ) {
                if(context[keys[j]] === "_DEFAULT"){
                  delete context[keys[j]]
                }
              }
          relationshipconfig.push(configobjects[i]);
         
        
        
        
        }
        else if(context.hasOwnProperty("entityType")&&context.entityType!== "_DEFAULT")
        {
            let keys = Object.keys(context)
            
            for(var j=0 ; j<=keys.length ; j++ ) {
                if(context[keys[j]] === "_DEFAULT"){
                  delete context[keys[j]]
                }
              }
          entitytypeconfig.push(configobjects[i]);
          
         
        
       
        }
        else if(context.hasOwnProperty("app")&&context.app!== "_DEFAULT")
        {
            let keys = Object.keys(context)
            
            for(var j=0 ; j<=keys.length ; j++ ) {
                if(context[keys[j]] === "_DEFAULT"){
                  delete context[keys[j]]
                }
              }
          appconfig.push(configobjects[i]);
         
          
        
        
        }
        else if(context.hasOwnProperty("domain")&&context.domain!== "_DEFAULT")
        {  

            let keys = Object.keys(context)
            
            for(var j=0 ; j<=keys.length ; j++ ) {
                if(context[keys[j]] === "_DEFAULT"){
                  delete context[keys[j]]
                }
              }
         
          domainconfig.push(configobjects[i]);
         
         
        
       
        }
        else if(context.hasOwnProperty("component")&& context.component!== "_DEFAULT"&&context.hasOwnProperty("tenant"))
        {
            let keys = Object.keys(context)
            
            for(var j=0 ; j<=keys.length ; j++ ) {
                if( keys[j] !== 'tenant' && context[keys[j]] === "_DEFAULT"){
                  delete context[keys[j]]
                }
              }
          tenentconfig.push(configobjects[i]);
         
         
        
         
        }
        else
        {
            // console.log(configobjects[i]);
        }
  




  }

}







function result() {

  
  let zip = new JSZip();

  
  var context = zip.folder("00-config-context");
  for (var i = 0; i < configContexts.length; i++) {
         
   let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        configContexts[i]
      ]
    }
    
                
      context.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
  

  var tenant = zip.folder("03-tenant");
  for (var i = 0; i < tenentconfig.length; i++) {
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        tenentconfig[i]
      ]
    }
   

                
       tenant.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
     
     
  
  }
  var domain = zip.folder("04-domain");
  for (var i = 0; i < domainconfig.length; i++) {
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        domainconfig[i]
      ]
    }
  
                
    domain.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
     
  
  }
  var app = zip.folder("05-app");
  for (var i = 0; i < appconfig.length; i++) {
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        appconfig[i]
      ]
    }
   
                
    app.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
     
     
  
  }
  var entitytype = zip.folder("06-entitytype");
  for (var i = 0; i < entitytypeconfig.length; i++) {
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        entitytypeconfig[i]
      ]
    }
   
                
    entitytype.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
     
     
  
  }
  
   
 
  var relationship = zip.folder("08-relationship");
  for (var i = 0; i < relationshipconfig.length; i++) {
     
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        relationshipconfig[i]
      ]
    }
   
                
    relationship.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
     
    
  
  }
 
  var role = zip.folder("11-role");
  for (var i = 0; i < roleconfig.length; i++) {
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        roleconfig[i]
      ]
    }
   
                
    role.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
     
     
     
  
  }
  var user = zip.folder("12-user");
  for (var i = 0; i < userconfig.length; i++) {
     
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        userconfig[i]
      ]
    }
   
                
    user.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
  
  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "110-uiconfig.zip");
          });
  }



}
getProfiles()

async function getProfiles() {

 
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);
  // let raw1 = JSON.stringify({ "params": { "query": { "contexts": [{}], "filters": { "typesCriterion": ["integrationProfile"], "allContextual": true } }, "allContextual": true, "fields": { "properties": ["_ALL"], "attributes": ["_ALL"], "relationships": ["_ALL"] } } });
  var raw1= JSON.stringify({"params":{"query":{"contexts":[{}],"filters":{"typesCriterion":["integrationprofile"],"allContextual":true}},"allContextual":true,"fields":{"properties":["_ALL"],"attributes":["_ALL"],"relationships":["_ALL"]}}});
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw1,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  
  let allconfigobjects = data.response.configObjects
 
 
 
  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
      //    console.log(allconfigobjects[i])
         profileobjects.push(allconfigobjects[i]);
      }
  }
    



}
function Profiles() {
  
  let zip = new JSZip();

  
  var profiles = zip.folder("120-rsconnectprofiles");
  for (var i = 0; i < profileobjects.length; i++) {
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        profileobjects[i]
      ]
    }
   
    
                
    profiles.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
      
   
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "120-rsconnectprofiles.zip");
          });
  }

}


getMatchconfigs()


async function getMatchconfigs() {

 
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);
  let raw2 = JSON.stringify({ "params": { "query": { "contexts": [{}], "filters": { "typesCriterion": ["matchconfig"], "allContextual": true } }, "allContextual": true, "fields": { "properties": ["_ALL"], "attributes": ["_ALL"], "relationships": ["_ALL"] } } });

  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw2,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  
  let allconfigobjects = data.response.configObjects
 
 
  
  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
       
         matchobjects.push(allconfigobjects[i]);
      }
  }
    
}



function matchConfigs() {
  
  let zip = new JSZip();

  
  var matchconfigs = zip.folder("160-matchconfig");
  for (var i = 0; i < matchobjects.length; i++) {
      
    let x = {
      "metaInfo": {
        "dataIndex": "config",
        "collectionName": "configObjects",
        "responseObjectName": "response"
      },
      "configObjects": [
        matchobjects[i]
      ]
    }
   
    
                
    matchconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "160-matchconfig.zip");
          });
  }

}


getGraphs()
async function getGraphs() {

 
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/entitymodelservice/get";

 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);
  // let raw2 = JSON.stringify({ "params": { "query": { "contexts": [{}], "filters": { "typesCriterion": ["integrationProfile"], "allContextual": true } }, "allContextual": true, "fields": { "properties": ["_ALL"], "attributes": ["_ALL"], "relationships": ["_ALL"] } } });
  let raw2 = JSON.stringify({ "params": { "query": { "filters": { "typesCriterion": ["graphprocessmodel"] } }, "fields": { "attributes": ["_ALL"], "relationships": ["_ALL"] } } });
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw2,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  Graphsdata = data.response.entityModels

 
 
    
}



function graphsdata() {
  
  let zip = new JSZip();

  
  var graphs = zip.folder("150-graphprocessmodel");
  for (var i = 0; i < Graphsdata.length; i++) {
      
    let x = {
      "metaInfo": {
        "dataIndex": "entityModel",
        "collectionName": "entityModels",
        "responseObjectName": "response"
      },
      "configObjects": [
          Graphsdata[i]
      ]
    }
   
    
                
    graphs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "150-graphprocessmodel.zip");
          });
  }

}




//SERVICE CONFIGS

getServiceconfigs() 
async function getServiceconfigs() {

   
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);
  // let raw1 = JSON.stringify({ "params": { "query": { "contexts": [{}], "filters": { "typesCriterion": ["integrationProfile"], "allContextual": true } }, "allContextual": true, "fields": { "properties": ["_ALL"], "attributes": ["_ALL"], "relationships": ["_ALL"] } } });
  var raw4= JSON.stringify({"params":{"query":{"contexts":[{}],"filters":{"typesCriterion":["rsserviceconfig"],"allContextual":true}},"allContextual":true,"fields":{"properties":["_ALL"],"attributes":["_ALL"],"relationships":["_ALL"]}}});
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw4,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  // console.log(data)
  let allconfigobjects = data.response.configObjects
//  console.log(allconfigobjects)
 

  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
     
        serviceobjects.push(allconfigobjects[i]);
      }
  }
}
   

function serviceconfigs() {
  
  let zip = new JSZip();

  
  var serviceconfigs = zip.folder("220-serviceconfig");
 
    for (var i = 0; i < serviceobjects.length; i++) {
      let x = {
        "metaInfo": {
          "dataIndex": "config",
          "collectionName": "configObjects",
          "responseObjectName": "response"
        },
        "configObjects": [
          serviceobjects[i]
        ]
      }
     
      
   
   
    
                
    serviceconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "service-configs.zip");
          });
  }

}

//INTEGRATIONCONFIG

getIntegrationconfigs() 
async function getIntegrationconfigs() {

   
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);


  var raw5 = JSON.stringify({
    "params": {
      "query": {
        "filters": {
          "typesCriterion": [
            "integrationconfig"
          ],
          "nonContextual": false
        }
      },
      "fields": {
        "attributes": [
          "_ALL"
        ]
      },
      "options": {
        "totalRecords": 1000
      }
    }
  });
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw5,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  console.log(data)
  let allconfigobjects = data.response.configObjects
 console.log(allconfigobjects)
 

  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
     
        integrationobjects.push(allconfigobjects[i]);
      }
  }
}
   

function integrationconfigs() {
  
  let zip = new JSZip();

  
  var integrationconfigs = zip.folder("integration-configs");
 
    for (var i = 0; i < integrationobjects.length; i++) {
      let x = {
        "metaInfo": {
          "dataIndex": "config",
          "collectionName": "configObjects",
          "responseObjectName": "response"
        },
        "configObjects": [
          integrationobjects[i]
        ]
      }
     
      
   
   
    
                
      integrationconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "integration-configs.zip");
          });
  }

}

//SAVEDSEARCH

getSavedsearchconfigs() 
async function getSavedsearchconfigs() {

   
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);


  var raw6 = JSON.stringify({
    "params": {
      "query": {
        "contexts": [
          {}
        ],
        "filters": {
          "typesCriterion": [
            "savedSearch"
          ],
          "allContextual": true
        }
      },
      "fields": {
        "attributes": [
          "_ALL"
        ]
      },
      "options": {
        "totalRecords": 100
      }
    }
  });
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw6,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  console.log(data)
  let allconfigobjects = data.response.configObjects
 console.log(allconfigobjects)
 

  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
     
        savedsearchobjects.push(allconfigobjects[i]);
      }
  }
}
   

function savedsearchconfigs() {
  
  let zip = new JSZip();

  
  var savedsearchconfigs = zip.folder("230-savedSearchConfig");
 
    for (var i = 0; i < savedsearchobjects.length; i++) {
      let x = {
        "metaInfo": {
          "dataIndex": "config",
          "collectionName": "configObjects",
          "responseObjectName": "response"
        },
        "configObjects": [
          savedsearchobjects[i]
        ]
      }
     
      
   
   
    
                
      savedsearchconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "savedsearch-configs.zip");
          });
  }

}

//SHEDULETASKSCONFIGS

getSheduletaskconfigs() 
async function getSheduletaskconfigs() {

   
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/schedulerservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);


  var raw7 = JSON.stringify({
    "params": {
      "query": {
        "contexts": [
          {}
        ],
        "filters": {
          "typesCriterion": [
            "scheduleObject"
          ],
          "allContextual": true
        }
      },
      "fields": {
        "attributes": [
          "_ALL"
        ]
      },
      "options": {
        "totalRecords": 100
      }
    }
  });
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw7,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  console.log(data)
  let allconfigobjects = data.response.scheduleObjects
 console.log(allconfigobjects)
 

  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
     
        sheduletaskobjects.push(allconfigobjects[i]);
      }
  }
}
   

function sheduletaskconfigs() {
  
  let zip = new JSZip();

  
  var sheduletaskconfigs = zip.folder("130-scheduledtasks");
 
    for (var i = 0; i < sheduletaskobjects.length; i++) {
      let x = {
        "metaInfo": {
          "dataIndex": "config",
          "collectionName": "configObjects",
          "responseObjectName": "response"
        },
        "configObjects": [
          sheduletaskobjects[i]
        ]
      }
     
      
   
   
    
                
      sheduletaskconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "sheduletask-configs.zip");
          });
  }

}
//Notification config
getNotificationconfigs() 
async function getNotificationconfigs() {

   
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);


  var raw8= JSON.stringify({
    "params": {
      "query": {
        "filters": {
          "typesCriterion": [
            "notificationconfig"
          ],
          "nonContextual": "false"
        }
      },
      "fields": {
        "attributes": [
          "_ALL"
        ]
      },
      "options": {
        "totalRecords": "100"
      }
    }
  });
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw8,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  console.log(data)
  let allconfigobjects = data.response.configObjects
 console.log(allconfigobjects)
 

  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
     
        notificationobjects.push(allconfigobjects[i]);
      }
  }
}
   

function notificationConfigs() {
  
  let zip = new JSZip();

  
  var notificationconfigs = zip.folder("notificationobjects");
 
    for (var i = 0; i < savedsearchobjects.length; i++) {
      let x = {
        "metaInfo": {
          "dataIndex": "config",
          "collectionName": "configObjects",
          "responseObjectName": "response"
        },
        "configObjects": [
          notificationobjects[i]
        ]
      }
     
      
   
   
    
                
      notificationconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "notification-configs.zip");
          });
  }

}
//Saved scope
getSavedscopeconfigs() 
async function getSavedscopeconfigs() {

   
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);


  var raw10 = JSON.stringify({
    "params": {
      "query": {
        "contexts": [
          {}
        ],
        "filters": {
          "typesCriterion": [
            "savedScope"
          ],
          "allContextual": true
        }
      },
      "fields": {
        "attributes": [
          "_ALL"
        ]
      },
      "options": {
        "totalRecords": 100
      }
    }
  });
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw10,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  console.log(data)
  let allconfigobjects = data.response.configObjects
 console.log(allconfigobjects)
 

  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
     
        savedscopeobjects.push(allconfigobjects[i]);
      }
  }
}
   

function savedscopeconfigs() {
  
  let zip = new JSZip();

  
  var savedscopeconfigs = zip.folder("savedScopeConfig");
 
    for (var i = 0; i < savedscopeobjects.length; i++) {
      let x = {
        "metaInfo": {
          "dataIndex": "config",
          "collectionName": "configObjects",
          "responseObjectName": "response"
        },
        "configObjects": [
          savedscopeobjects[i]
        ]
      }
     
      
   
   
    
                
      savedscopeconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "savedscope-configs.zip");
          });
  }

}

//rendetionconfigs
getRendetionconfigs() 
async function getRendetionconfigs() {

   
  let tenantDetails = await getActiveTenant()

  let URL = tenantDetails.data[0].web_url + "/api/configurationservice/get";
 
 

  let myHeaders = new Headers();
  myHeaders.append('x-rdp-clientId', 'rdpclient');
  myHeaders.append('x-rdp-tenantId', tenantDetails.data[0].tenant_id);
  myHeaders.append('x-rdp-userId', tenantDetails.data[0].api_user_id);
  myHeaders.append('auth-client-id', tenantDetails.data[0].client_id);
  myHeaders.append('auth-client-secret', tenantDetails.data[0].client_secret);

  let raw12 = JSON.stringify({ "params": { "query": { "contexts": [{}], "filters": { "typesCriterion": ["renditionConfig"], "allContextual": true } }, "allContextual": true, "fields": { "properties": ["_ALL"], "attributes": ["_ALL"], "relationships": ["_ALL"] } } });
  let requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw12,
      redirect: 'follow'
  };
  let response = await fetch(URL, requestOptions);


  let data = await response.json();
  
  console.log(data)
  let allconfigobjects = data.response.configObjects
 console.log(allconfigobjects)
 

  for (let i = 0; i < allconfigobjects.length; i++){
     
      let x = allconfigobjects[i].id;
      const substring = "sys";
      if(x.includes(substring))
      {
         
      }
      else{
     
        rendetionobjects.push(allconfigobjects[i]);
      }
  }
}
   

function rendetionconfigs() {
  
  let zip = new JSZip();

  
  var renditionconfigs = zip.folder("RenditionConfigs");
 
    for (var i = 0; i < rendetionobjects.length; i++) {
      let x = {
        "metaInfo": {
          "dataIndex": "config",
          "collectionName": "configObjects",
          "responseObjectName": "response"
        },
        "configObjects": [
          rendetionobjects[i]
        ]
      }
     
      
   
   
    
                
      renditionconfigs.file( x.configObjects[0].id+".json",JSON.stringify( x, null, 4))
  
  }
 


  {
      zip.generateAsync({ type: "blob" })
          .then(function (content) {
              // see FileSaver.js
              saveAs(content, "rendition-configs.zip");
          });
  }

}
// @author nikhileshwar.t
// @company Riversand inc.