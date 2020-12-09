<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Control de Usuarios</h1>
            <div class="l-3"></div>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Celular</th>
                    <th><a class="icono" href="index.php?page=User&act=INS">Crear <i class="fas fa-plus-circle"></i></a></th>
                </thead>
                <tbody>
                   {{foreach users}}
                     <tr>
                        <td>{{userEmail}}</td>
                        <td>{{userName}}</td>
                        <td>{{userState}}</td>
                        <td>{{userCell}}</td>
                        <td class="col-s-1 col-m-3 col-2">
                           <a href="index.php?page=User&act=UPD&cod={{userCod}}"><i class="fas fa-pencil-ruler"></i></a>
                           <a href="index.php?page=User&act=DSP&cod={{userCod}}"><i class="fas fa-eye"></i></a>
                        </td>
                    </tr>
                   {{endfor users}}
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