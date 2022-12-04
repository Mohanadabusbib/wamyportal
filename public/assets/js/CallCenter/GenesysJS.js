//-------------------------------------------------------------------------------------------------------------------------------//
var getParameterByName =function(name) {
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\#&]" + name + "=([^&#]*)"),
          results = regex.exec(location.hash);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
};


var TokenGeneration =function(clientId){
	console.log("TokenGeneration()");
	// REDIRECT URI ALSO IS USED IN DIF. PART
	 var redirectUri = "http://localhost:88/";	
	 //var redirectUri ="http://stg.ta7akum.com/"; 	    
	 var state = localStorage.getItem("state"); // About last page
	 var gToken = localStorage.getItem('gToken');
	 // gToken should be empty when the Token is expired, or not generated!
	 console.log("gToken= ",gToken);
	 if(gToken==="" || gToken===null){
		         console.log("if gToken===NULL");
				 localStorage.setItem("redirectUri",redirectUri);
				 if(window.location.hash) {
							var token = getParameterByName('access_token');
							var URL_state = getParameterByName('state');
							localStorage.setItem('gToken', token);	
							if(URL_state === ""){
								console.log("STATE:: Empty");
								//location.hash='';
							}
							else{
								// Redirect to orginal-URL before Token was generated, before PureCloud redirect to "redirectUri"
								console.log("STATE::" + URL_state);
								localStorage.setItem("state","");
								window.location.href = redirectUri + state;
							}
				 }else{
						var queryStringData = {
								response_type : "token",
								client_id : clientId,
								redirect_uri : redirectUri,
								state : state
						}		
					   window.location.replace("https://login.mypurecloud.ie/oauth/authorize?" + jQuery.param(queryStringData));
				 }
	 }
	 

};
 