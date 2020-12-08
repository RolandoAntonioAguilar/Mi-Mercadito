<div class="page-table">
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Accesos Garantizados</h1>
            <div class="l-3"></div>
            <div class="row col-offset-s-3 col-offset-m-8 col-offset-9 no-padding">
              <button class="button-3 col-s-7 col-m-7 col-6 col-l-5" id="btnRegresar">Regresar</button>  
            </div>
            <br>
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Clase</th>
                    <th>Denegar Acceso</th>
                </thead>
                <tbody>
                   
                   {{foreach hasAccess}}
                    
                     <tr>
                         <form action="index.php?page=Acceso&cod={{typeCod}}" method="post">
                            <input type="hidden" name="typeCod" id="typeCod" value="{{typeCod}}">
                            <input type="hidden" name="mdlCod" id="mdlCod" value="{{mdlCod}}"> 
                            <td>{{mdlCod}}</td>
                            <td>{{mdlDscES}}</td>
                            <td>{{mdlClass}}</td>
                            <td class="col-s-2 col-m-3 col-2 no-padding">
                            <button class="button-3 col-s-9 col-m-4" name="btnDenegar" id="btnDenegar" type="submit"><i class="fas fa-ban"></i></button> 
                            </td>
                        </form>
                    </tr>
                     
                   {{endfor hasAccess}}
                   
                </tbody>
            </table>
        </div>
        <br>
        <div class="action-title">
            <h1 class="row col-s-12">Accesos Denegados</h1>
            
        </div>
        <div class="table">
            <table class="col-s-12 no-margin no-padding">
                <thead>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Clase</th>
                    <th>Garantizar Acceso</th>
                </thead>
                <tbody>
                   
                   {{foreach deniedAccess}}
                     <tr>
                            <form action="index.php?page=Acceso&cod={{typeCod}}" method="post" class="col-s-12">
                                <input type="hidden" name="typeCod" id="typeCod" value="{{typeCod}}">
                                <input type="hidden" name="mdlCod" id="mdlCod" value="{{mdlCod}}"> 
                                    <td>{{mdlCod}}</td>
                                    <td>{{mdlDscES}}</td>
                                    <td>{{mdlClass}}</td>
                                    <td class="col-s-1 col-m-3 col-2">
                                    <button class="button-3 col-s-9 col-m-4" name="btnAcceder" id="btnAcceder" type="submit"><i class="fas fa-plus-circle"></i></button> 
                                    </td>
                        </form>
                    </tr>
                   {{endfor deniedAccess}}
                    
                </tbody>
            </table>
        </div>
    </div>
<script>
  $().ready(function(){

    $("#btnFiltrarA").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[0].submit();
    });
    $("#btnFiltrarD").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      document.forms[2].submit();
    });
    $("#btnRegresar").click(function(e){
      e.preventDefault();
      e.stopPropagation();
      window.location.assign("index.php?page=Accesos");
    });
  });
</script>