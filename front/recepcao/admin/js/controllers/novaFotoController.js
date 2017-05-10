app.controller('novaFotoController', ['$scope','$location','albuns','album','fotosAPI',function ($scope,$location,albuns,album,fotosAPI) {
	$scope.albuns = albuns.data.albuns;
	$scope.foto = {id_album : album};
	$scope.fotoDataRetorno ={percentual:0,percentualErr:0,message:{}};

	$scope.salvarFoto = function(foto,imagem,dataRetorno){
		fotosAPI.postFoto(foto,imagem,dataRetorno);
	};
}]);