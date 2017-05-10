app.config(['$routeProvider','$httpProvider',function($routeProvider,$httpProvider){
	$routeProvider.when('/banners',{
		templateUrl: "view/home-admin.html" ,
		controller: "bannerController",
		resolve: {
		 	banners : ['bannerAPI',function(bannerAPI){
		 		return bannerAPI.getBanners();
		 	}],
		 	page: function(){
		 		return 'admin';
		 	}
		}
	});


	$routeProvider.when('/novo/banner',{
		templateUrl: "view/novo-banner.html" ,
		controller: "novoBannerController",
		resolve: {
		 	fotos : ['fotosAPI',function(fotosAPI){
		 		return fotosAPI.getFotos();
		 	}],
		 	banner : function(){
		 		return {data:{}};
		 	}
		}
	});	

	$routeProvider.when('/novo/banner/:id',{
		templateUrl: "view/novo-banner.html" ,
		controller: "novoBannerController",
		resolve: {
		 	fotos : ['fotosAPI',function(fotosAPI){
		 		return fotosAPI.getFotos();
		 	}],
		 	banner : ['$route','bannerAPI',function($route,bannerAPI){
		 		return bannerAPI.getBanner($route.current.params.id);
		 	}]
		}
	});	


	$routeProvider.when('/album/:id',{
		templateUrl: "view/album-admin.html" ,
		controller: "albumController",
		resolve: {
		 	album : ['albumAPI','$route',function(albumAPI,$route){
		 		return albumAPI.getAlbum($route.current.params.id);
		 	}],
		 	nome : function(){
		 		return "";
		 	},
		 	categoria: function(){
		 		return "";
		 	}
		}
	});



	$routeProvider.when('/albuns/:id',{
		templateUrl: "view/albuns-admin.html" ,
		controller: "categoriaController",
		resolve: {
		 	categoria : ['albumAPI',function(albumAPI){
		 		return albumAPI.getAlbuns();
		 	}],
		 	nome: function(){
		 		return '';
		 	},
		 	fotos : ['fotosAPI',function(fotosAPI){
		 		return {};
		 	}]
		}
	});


	$routeProvider.when('/fotos/:id',{
		templateUrl: "view/fotos-admin.html" ,
		controller: "fotosController",
		resolve: {
		 	fotos : ['fotosAPI',function(fotosAPI){
		 		return fotosAPI.getFotos();
		 	}],
		 	albuns : ['albumAPI',function(albumAPI){
		 		return albumAPI.getAlbuns();
		 	}]
		}
	});
	
	$routeProvider.when('/foto/nova',{
		templateUrl: "view/nova-foto.html" ,
		controller: "novaFotoController",
		resolve: {
		 	albuns : ['albumAPI',function(albumAPI){
		 		return albumAPI.getAlbuns();
		 	}],
		 	album: function(){
		 		return '';
		 	}
		}
	});	

	$routeProvider.when('/foto/nova/album/:id',{
		templateUrl: "view/nova-foto.html" ,
		controller: "novaFotoController",
		resolve: {
		 	albuns : ['albumAPI',function(albumAPI){
		 		return albumAPI.getAlbuns();
		 	}],
		 	album: ['$route',function($route){
		 		return $route.current.params.id;
		 	}]
		}
	});	



	$routeProvider.when('/novo/album',{
		templateUrl: "view/novo-album.html" ,
		controller: "novoAlbumController"
	});	
	
	$routeProvider.when('/videos/:id',{
		templateUrl: "view/videos-admin.html" ,
		controller: "videoController",
		resolve: {
		 	videos : ['videoAPI',function(videoAPI){
		 		return videoAPI.getVideos();
		 	}]
		}
	});


	$routeProvider.otherwise({redirectTo:'/banners'});

  	$httpProvider.interceptors.push('authInterceptor');
}]);