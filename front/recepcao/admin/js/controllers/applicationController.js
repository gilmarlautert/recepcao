app.controller('applicationController', ['$scope','$window','$location','loginAPI',function ($scope,$window,$location,loginAPI) {
	$scope.newPass={};

	var _getUser=function(){
		return $window.sessionStorage.user;
	};

  	$scope.isLogado = function (){
		return $window.sessionStorage.token;
	};
	
	$scope.logoff = function(){
		delete $window.sessionStorage.token;
		$location.path('/login');
	};

	$scope.openAlterarSenha = function(newPasswd){
		console.log();
		$scope.newPass = newPasswd;
	};

	$scope.alterarSenha = function(newPasswd){
		newPasswd.email = _getUser();
		loginAPI.setpasswd(newPasswd)
		.success(function(data){
			if(data.error){
				console.log(data);
			}
			alert(data.message);
		});		
	};
}]);