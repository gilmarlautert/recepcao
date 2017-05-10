app.controller('novoAlbumController', ['$scope','$location','albumAPI',function ($scope,$location,albumAPI) {
	
	$scope.album = {};
	$scope.salvarAlbum = function(album){
		albumAPI.postAlbum(album)
		.success(function(data){
			if(!data.error){
				$location.path('/albuns');
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