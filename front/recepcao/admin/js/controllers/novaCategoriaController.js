app.controller('novaCategoriaController', ['$scope','$location','categoriaAPI', function ($scope,$location,categoriaAPI) {
	$scope.categoria={};
	$scope.salvarCategoria = function(categoria){
		categoriaAPI.postCategoria(categoria)
		.success(function(data){
			if(!data.error){
				$location.path('/categorias');
			}else{
				$scope.message.text = "Erro ao Salvar!";
				$scope.message.status = "alert alert-danger";
				$timeout(function(){ $scope.message={}; },2000);				
			}
		}).error(function(e,d,f){
			console.log(d,e,f);
		});
	};
	
}]);