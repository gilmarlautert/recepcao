app.controller('novoBannerController', ['$scope','$location','$timeout','bannerAPI','fotos','banner' ,function ($scope,$location,$timeout,bannerAPI,fotos,banner) {
	$scope.fotos = fotos.data;
	$scope.banner = banner.data;
	$scope.fotoSelecionada={isSelecionada:false};


	$scope.salvarBanner= function(banner){
		if(!$scope.banner.id){
			bannerAPI.postBanner(banner)
			.success(function(data){
				if(!data.error){
					$location.path('/banners');
				}else{
					$scope.message.text = "Erro ao Salvar!";
					$scope.message.status = "alert alert-danger";
					$timeout(function(){ $scope.message={}; },2000);			
				}
			})
			.error(function(data){
				$scope.message.text = "Erro ao Salvar!";
				$scope.message.status = "alert alert-danger";
				$timeout(function(){ $scope.message={}; },2000);
			});
		}else{
			bannerAPI.putBanner(banner)
			.success(function(data){
				if(!data.error){
					$location.path('/banners');
				}else{
					$scope.message.text = "Erro ao Salvar!";
					$scope.message.status = "alert alert-danger";
					$timeout(function(){ $scope.message={}; },2000);			
				}
			})
			.error(function(data){
				$scope.message.text = "Erro ao Salvar!";
				$scope.message.status = "alert alert-danger";
				$timeout(function(){ $scope.message={}; },2000);
			});
		}
		
	};


	$scope.selecionarImagem = function(foto){
		if(foto.id == $scope.fotoSelecionada.id ){
			foto.selecionada=null;
			$scope.fotoSelecionada={isSelecionada:false};
		}else if(!$scope.fotoSelecionada.id){
			$scope.fotoSelecionada = foto;
			$scope.fotoSelecionada.isSelecionada = true;
			foto.selecionada="foto-selecionada";
		}else {
			$scope.fotos.forEach(function(item, index) {
				item.selecionada=null;
			});
			$scope.fotoSelecionada = foto;
			$scope.fotoSelecionada.isSelecionada = true;
			foto.selecionada="foto-selecionada";
		}
	};

	$scope.salvarImagem = function(fotoSelecionada){
		$scope.banner.id_foto = fotoSelecionada.id;
		$scope.banner.src = fotoSelecionada.src;		
	};
	
}]);