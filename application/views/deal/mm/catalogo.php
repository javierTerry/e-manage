<div class="form-row col-md-12">

    <div class="form-group col-md-6">
      <label for="inputCentral">Catalogos</label>

        <select class="form-control custom-select-lg" id="catalogo_id" name="catalogo_id" style="width:100%" >
            <option value="0" selected> Seleccionar ...</option>
            <option value="1"> Zona Carga</option>
            <option value="2"> Tarifa Capacidad</option>
            <option value="3"> Tarifas Distribucion </option>
            <option value="4"> Tarifa Transmision</option>
            <option value="5"> Esquema Tarifario</option>
            <option value="6"> Intervalos</option>
            <option value="7"> Tarifa Energia</option>
            <option value="8"> PML Ajustado</option>
            <option value="9"> Tarifa Op CENACE</option>
            <option value="10"> Tarifa SCnMEM</option>
            <option value="11"> Operacion SB</option>
            
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