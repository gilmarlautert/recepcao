app.controller("loginController",['$scope','$window','$location','loginAPI',function($scope,$window,$location,loginAPI){
	$scope.tryLogin = function(loginData){
		loginAPI.login(loginData)
		.success(function (data, status, headers, config) {
			if(data.error){
				$scope.message = data.message;
			}else{
				$window.sessionStorage.token = data.message;
				$window.sessionStorage.user = loginData.email;
				$scope.message = data.message;
				$location.path('/contatos');
			}
	    })
	    .error(function (data, status, headers, config) {
	        // Erase the token if the user fails to log in
	        delete $window.sessionStorage.token;

	        // Handle login errors here
	        $scope.message = data.message;
	        
	    });
	};

	
}]);