var oauth = new OAuthClient("https://192.168.0.16/redeparaidserver3/ids/connect/authorize");
var api = {
    authorize: function(options) {
        var deferred = $.Deferred();

        var req= oauth.createImplicitFlowRequest(options.client_id, options.redirect_uri, options.scope, options.response_type);
        // Now we need to open a window.
        var authWindow = window.open(req.url, '_blank', 'location=no,toolbar=no');
  debugger;
        authWindow.addEventListener('loadstart', function (e) {
          
          var url= e.url;
          if (url.indexOf(options.redirect_uri + '#') !== 0) return;
          var url = e.originalEvent.url;
          var code = /\?code=(.+)$/.exec(url);
          var error = /\?error=(.+)$/.exec(url);
          if( code == error ) {
            deferred.reject({
              error: error[1]
            });
          } else {
            var uriFragment= url.substring( url.indexOf('#') + 1);
            var result=  oauth.parseResult(uriFragment);
            // Mitigate against CSRF attacks by checking we actually sent this request
            // We could also assert the nonce hasn't been re-used.
            if( result.state == req.state ) {
                deferred.resolve(result);
                authWindow.close();
            }
            else {
              deferred.reject( {
                error: "The state received from the server did not match the one we sent."
              });
             
            } 
          }
        
        }); 
       
        return authWindow;
    }
};