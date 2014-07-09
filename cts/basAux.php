<?
require('../enc.php');
require('../scrSub.php');
?>

<div class="row">
    <div class="col-lg-12">
        <h1>
            Bases Auxiliares
        </h1>
        <h5>
        	Modulo de actualizacion de bases auxiliares para Cost To Serve
        </h5>
    </div>
</div>

<div class="row">
    	
        <div class="col-lg-12">
        
        <br>	
        <div class="table-responsive">
        	<table class="table table-bordered table-hover">
            	<thead class="bg-primary">
                	<th class="text-center">Nombre Base
                    </th>
                    <th class="text-center">Actualizar
                    </th>
                </thead>
            	
                <tr>
                	<td>
                    	Base Sku - Bussines Unit
                    </td>
                    
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="bus_uni" 
                            columnasVacias="0"
                            archivo="Base Sku - Bussines Unit"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        Base Palets - Cajas
                    </td>
                    
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="pal_caj"
                            columnasVacias="0"
                            archivo="Base Conversion Palets a Cajas"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                	<td>
                    	Base Payer, Sold To Party, Ship To Party
                    </td>
                    
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="pay_shi_sol" 
                            columnasVacias="0"
                            archivo="Base Payer, Sold To Party, Ship To Party"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                	<td>
                    	OVH Base de Porcentajes de cuentas Especiales en Overhead
                    </td>
                    
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="cta_esp" 
                            columnasVacias="0"
                            archivo="OVH Base de Porcentajes de cuentas Especiales en Overhead"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        IB Planta - Sku
                    </td>
                    

                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="pla_sku"
                            columnasVacias="0"
                            archivo="Archivo de Planta Origen por Sku"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>

                <tr>
                	<td>
                    	DxD Base de Factores por payer
                    </td>
                   
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="fac_dxd"
                            columnasVacias="0"
                            archivo="DxD Base de Factores por payer"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                	<td>
                    	3PL Base de Costos en relacion Porcentajes de Picking en Fletes
                    </td>
                    
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="tab_por"
                            columnasVacias="0"
                            archivo="3PL Base de Costos en relacion Porcentajes de Picking en Fletes"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                	<td>
                    	RTA Base de Estandar y Estiba por Sku
                    </td>
                    
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="sku_ren"
                            columnasVacias="0"
                            archivo="RTA Base de Estandar y Estiba por Sku"
                            url=""
                        >
                                <i class="glyphicon glyphicon-refresh"></i> Actualizar
                        </button>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        RTA Factores para Renta
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="cos_alm_fac" 
                            columnasVacias="0"
                            archivo="Archivo de Factores para Renta"
                            url=""
                        >
                            <i class="glyphicon glyphicon-refresh"></i>
                            Actualizar
                        </button>
                    </td>
                </tr>

                <tr>
                    <td>
                        RTA Impactos Beneficios
                    </td>
                    <td class="text-center">
                        <button
                            type="button" 
                            class="activarModal btn btn-danger btn-xs"  
                            tabla="ren_imp_ben" 
                            columnasVacias="2"
                            archivo="Archivo de Factores para Renta"
                            url=""
                        >
                            <i class="glyphicon glyphicon-refresh"></i>
                            Actualizar
                        </button>
                    </td>
                </tr>

            </table>
        </div>
            
        </div>
    </div>

<? require('pie.php');?>