<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Manejo de Modulos</h1>
            <div class="l-3"></div>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Clase</th>
                    <th><a class="icono" href="index.php?page=Modulo&act=INS">Crear <i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach module}}
                     <tr>
                        <td>{{mdlCod}}</td>
                        <td>{{mdlDscES}}</td>
                        <td>{{mdlState}}</td>
                        <td>{{mdlClass}}</td>
                        <td class="col-s-2 col-m-3 col-2">
                           <a href="index.php?page=Modulo&act=UPD&cod={{mdlCod}}"><i class="fas fa-pencil-ruler"></i></a> 
                           <a href="index.php?page=Modulo&act=DSP&cod={{mdlCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor module}}
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