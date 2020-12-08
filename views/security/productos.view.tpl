<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Inventario</h1>
            <div class="l-3"></div>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>IMG URL</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Porciones</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th><a class="icono" href="index.php?page=Producto&act=INS">Crear <i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach product}}
                     <tr>
                        <td>{{prdCod}}</td>
                        <td>{{prdImageURL}}</td>
                        <td>{{prdDscES}}</td>
                        <td>{{prdPrice}}</td>
                        <td>{{prdQuantity}}</td>
                        <td>{{prdCategory}}</td>
                        <td>{{prdStock}}</td>
                        <td>{{prdState}}</td>
                        <td>
                           <a href="index.php?page=Producto&act=UPD&cod={{prdCod}}"><i class="fas fa-pencil-ruler"></i></a>
                           <a href="index.php?page=Producto&act=DSP&cod={{prdCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor product}}
                </tbody>
            </table>
        </div>
    </div>
<script>
  $().ready(function(){
    $("#btnFiltrar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });
  });
</script>