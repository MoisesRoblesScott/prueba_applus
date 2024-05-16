var app  = angular.module("ProductosApp", []);
app.controller("ProductosController", function($scope, $http){
    $scope.productos = []
    $scope.categorys = []
    
    $scope.id       = ""
    $scope.code     = ""
    $scope.name     = ""
    $scope.price    = ""
    $scope.category = ""

    listProduct()
    function listProduct(){
        $http.post('http://localhost/prueba_apples/back-end/index.php',{param: 'index'})
        .success(function(data){
            $scope.productos  = data.products
            $scope.categorys  = data.categorys
        })
        .error(function(e){
            console.error(e);
        })
    }

    $scope.agregarProducto = function(){
        $http.post('http://localhost/prueba_apples/back-end/index.php', {
            param: 'create',
            data:{
                code:     $scope.code,
                name:     $scope.name,
                price:    $scope.price,
                category: $scope.category.id
            }
        })
        .success(function(data){
            $scope.code = ""
            $scope.name = ""
            $scope.price = ""
            $scope.category = ""
            
            listProduct()
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Registrado Correctamente",
                showConfirmButton: false,
                timer: 1000
            });

        })
        .error(function(e){
            console.error(e);
        })
    }

    $scope.deleteProducto = function(id){
        Swal.fire({
            title: "Esta Seguro de eliminar este producto ?",
            icon: "question",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Si",
            denyButtonText: `No`
          }).then((result) => {
            if (result.isConfirmed) {
                $http.post('http://localhost/prueba_apples/back-end/index.php', {
                    param: 'delete',
                    data:{
                        id: id,
                    }
                })
                .success(function(data){
                    console.log(data);
                    listProduct()
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Eliminado Correctamente",
                        showConfirmButton: false,
                        timer: 1000
                    });
        
                })
                .error(function(e){
                    console.error(e);
                })
            
            }
        });
    }

    $scope.updateProducto = function(){
        $http.put('http://localhost/prueba_apples/back-end/index.php', {
            param: 'update',
            data:{
                id:       $scope.id,
                code:     $scope.code,
                name:     $scope.name,
                price:    $scope.price,
                category: $scope.category,
            }
        })
        .success(function(data){
            listProduct()
            Swal.fire({
                position: "center",
                icon: "success",
                title: "Actalizado Correctamente",
                showConfirmButton: false,
                timer: 1000
            });

        })
        .error(function(e){
            console.error(e);
        })
    }

    $scope.updateModal = function(item){
        $scope.id       = item.id
        $scope.code     = item.code
        $scope.name     = item.name_product
        $scope.price    = item.price
        $scope.category = item.category
        $('#updateModal').modal('show');            
    }

    $scope.openModal = function(){
        $scope.id       = ""
        $scope.code     = ""
        $scope.name     = ""
        $scope.price    = ""
        $scope.category = ""
        $('#creationModal').modal('show');
    }
})