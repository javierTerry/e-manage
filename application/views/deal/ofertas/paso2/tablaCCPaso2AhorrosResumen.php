<table id="tablaCCPaso2AhorrosResumen" class="table table-striped table-bordered dt-responsive " cellspacing="0" width="100%" style="display: none;">
    <thead> 
        <tr BGCOLOR ="#86a899" align="center"> <th colspan="7" style="text-align:center">Ahorros</th></tr>
        <tr>    
            <th>Año</th>  
            <th>Mes</th>  
            <th>Consumo sin pérdidas (kWh)</th>  
            <th>Facturación Fénix estimada (MXN)</th>  
            <th>Facturación CFE SSB estimada (MXN)</th>  
            <th>Ahorros (MXN)</th>  
            <th>% Ahorro</th>  
        </tr>   
    </thead>    
    <tbody>
    	<?php foreach ($resumenCCAhorros as $ahorro): ?>
    		<tr>
	    		<td></td>
	    		<td></td>
	    		<td> <?php echo $ahorro['csp_kwh'] ?></td>
	    		<td> <?php echo $ahorro['ffe_mxn'] ?></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
    		</tr>
    	<?php endforeach; ?>
   
    </tbody>    
</table>