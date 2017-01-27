// c/o Thinktecture IDSrv3
function OAuthClient(url){
    this.url = url;
}

OAuthClient.prototype.createImplicitFlowRequest = function (clientid, callback, scope, responseType) {
    responseType = responseType || "token";

    var state = (Date.now() + Math.random()) * Math.random();
    state = state.toString().replace(".", "");
    var nonce = (Date.now() + Math.random()) * Math.random();
    nonce = nonce.toString().replace(".", "");
   //https://localhost/redeparaidserver3/ids/connect/authorize?client_id=redeparaImprensa.web&scope=openid%20email%20api1&response_type=id_token%20token&redirect_uri=https://myapp/callback&state=abc&nonce=xyz
    var url =
        this.url + "?" + 
        "client_id=" + encodeURIComponent(clientid) + "&" +
        "scope=" + encodeURIComponent(scope) + "&" +
        "response_type=" + encodeURIComponent(responseType) + "&" +
        "redirect_uri=" + encodeURIComponent(callback) + "&" + 
        "state=" + encodeURIComponent(state) + "&" + 
        "nonce=" + encodeURIComponent(nonce);

    return {
        url:url, 
        state: state,
        nonce: nonce
    };
};

OAuthClient.prototype.parseResult = function (queryString) {
    var params = {},
        //queryString = location.hash.substring(1),
        regex = /([^&=]+)=([^&]*)/g,
        m;

    while (m = regex.exec(queryString)) {
        params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }

    for (var prop in params) {
        return params;
    }
};