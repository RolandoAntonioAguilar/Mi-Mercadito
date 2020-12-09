<div class="hero">
        <div class="ad">
            <h2>Revisa nuestra tienda</h2>
            <button id="btnOrder">Ordenar</button>    
        </div>
    </div>
<script>
    $().ready(function(){
    $("#btnOrder").click(function(e){
    e.preventDefault();
    e.stopPropagation();
    window.location.assign("index.php?page={{store}}");
    });
});
</script>   