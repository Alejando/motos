

<div>
    <h4 class="page-title">Edición "@{{objContent.title}}"</h4>
    <p class="text-muted page-title-alt">Desde este formulario puedes editar el contenido de tu sitio!</p>
</div>
<div>
    <div class="card-box">
	    <form method="post" >
	        <textarea style="width: 100%; height: 300px" class="form-control" ui-tinymce="tinymceOptions" ng-model="objContent.content"></textarea>
		</form>
        <div style="margin:10px">
             <button class="btn btn-primary" ng-click="saveContent()">Guardar</button>
             <button class="btn btn-primary" ng-click="cancel()">Cancelar</button>
        </div>
    </div>
</div>