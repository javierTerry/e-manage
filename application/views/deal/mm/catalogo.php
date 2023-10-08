<div class="form-row col-md-12">

    <div class="form-group col-md-6">
      <label for="inputCentral">Catalogos</label>

        <select class="form-control custom-select-lg" id="catalogo_id" name="catalogo_id" style="width:100%" >
            <option value="0" selected> Seleccionar ...</option>
            <?php foreach ($catalogos as $key => $catalogo) { 
                echo "<option value='".$catalogo['catalogoId']."'>".$catalogo['nombre']."</option>";
            }?>
            
      </select>
    </div>
    <div class="form-group col-md-6">
        <div class="p-3">      
            
            <label class="form-check-label" for="tipoCatalago">
                Carga
            </label>
            <div class="input-group">
                
            <label class="input-group-btn">
                <span class="btn btn-primary btn-file">
                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                        name="archivo" type="file" id="archivo">
                </span>
            </label>
            
            <input class="form-control" id="archivo_captura" readonly="readonly"
                name="archivo_captura" type="text">
            </div>
        </div>
        
    </div>
</div>