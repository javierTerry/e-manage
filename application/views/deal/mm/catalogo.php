<div class="form-row col-md-12">

    <div class="form-group col-md-6">
      <label for="inputCentral">Catalogos</label>

        <select class="form-control custom-select-lg" id="selTipoOferta" name="selTipoOferta"
            style="width:100%">

            <option value="1">INTH</option>
            <option value="2">Zonas de Carga</option>
            <option value="3">PPT& PPNT Pérdidas Técnicas y no técnicas</option>
            <option value="4">PND Precios de nodos distribuidos</option>
            <option value="5">Meses</option>
            <option value="6">Tarifa Distribución</option>
            <option value="7">Tarifa Transmisión</option>
            <option value="8">Tarifa Operación CENACE</option>
            <option value="9">Tarifa SCnMEM</option>
            <option value="10">Tarifa DB1</option>
            <option value="11">Otros costos</option>
            <option value="12">Energia por Division</option>
            <option value="13">Capacidad</option>
            <option value="14">Operación SB</option>
            <option value="15">Inversión</option>
            <option value="16">Tipo de cambio</option>
            <option value="17">Precio Necaxa</option>
        
      </select>
    </div>
    <div class="form-group col-md-6">
        <div class="p-3">      
            
            <label class="form-check-label" for="chktarifas">
                Carga
            </label>
            <div class="input-group">
                
            <label class="input-group-btn">
                <span class="btn btn-primary btn-file">
                    Archivo <input accept=".xls,.xlsx,.csv" class="hidden"
                        name="btarifas" type="file" id="btarifas">
                </span>
            </label>
            
            <input class="form-control" id="tarifa_captura" readonly="readonly"
                name="tarifa_captura" type="text" value="ter">
            </div>
        </div>
    </div>
</div>