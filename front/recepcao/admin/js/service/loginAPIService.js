app.factory("loginAPI",['$http','config',function($http,config){
	var _login = function(loginData){
		return $http.post(config.baseURI +'/login',loginData);
	};
	var _setpasswd = function(loginData){		
		return $http.post(config.baseURI +'/alterPasswd',loginData);
	}
	return {
		login : _login,
		setpasswd : _setpasswd
	};
}]);