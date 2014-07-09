<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<link href="../c/bootstrap.css" rel="stylesheet"/>
<link rel="stylesheet" href="../c/jquery.fileupload-ui.css">
<link rel="stylesheet" href="../c/bsm/prism.css">
<link rel="stylesheet" href="../c/bsm/bootstrap-switch.min.css" />

    <div class="contenedor">
        <div class="resolucion">
        </div>
       
        <!--Menu -->
        <nav class="navbar navbar-default" role="navigation">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Brand</a>
            </div>
        
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              
              <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
        <div class="cuerpo">
        	
            <h1>
	        	Titulo	
	        </h1>
            <hr>
            
            <div class="row">
            	<div class="col-lg-12">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros sollicitudin, venenatis nulla non, adipiscing justo. Vivamus eu aliquam nunc, nec consequat turpis. Quisque pulvinar velit eu libero tincidunt cursus. Pellentesque rhoncus dolor vel enim elementum semper sit amet non mi. Sed urna arcu, cursus eget scelerisque id, rutrum ac lacus. Morbi venenatis nisl quam, eget adipiscing nisl laoreet quis. Sed vel sem eget nulla porttitor posuere. Cras eget aliquam eros.
                    </p>
                </div>
            </div>
            
            <div class="row">
            	<div class="col-lg-12">
                	<div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                        <th>Table heading</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                        <td>Table cell</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                </div>
            	
            </div>
           
           <div class="row">
           		<div class="col-lg-4">
                	<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros sollicitudin, venenatis nulla non, adipiscing justo.
                </div>
                <div class="col-lg-4">
	                <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros sollicitudin, venenatis nulla non, adipiscing justo.
                </div>
                <div class="col-lg-4">
                	<br>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent vitae eros sollicitudin, venenatis nulla non, adipiscing justo.
                </div>
           </div>
           
        </div>
        
        
        
    </div>
    <hr>
    <div class="cuerpo">
    	<div class="row text-center">
         <div class="col-sm-12">
         	Desarrollado por Oscar Mendoza
         </div>
        </div>
        <div class="row text-center">
         <div class="col-sm-12">
         	Cedis Qro, 2014
         </div>
        </div>
    </div>

</html>
<script src="../j/jquery.js"></script>
<script src="../j/bootstrap.min.js"></script>
<style>
@media screen and (min-width: 1200px) {
	.contenedor{
		/*background-color:#999;*/
		width:980px;
		margin:0 auto 0 auto;
		padding-top:30px;
	}
	
	p{
		font-family:"Kellogg's Sans";
	}
	
	.cuerpo{
		/*background-color:#CCC;*/
		padding-left:20px;
		padding-right:20px;
		
	}
	
	.resolucion{
		height:10px;
		width:10px;
		background-color:#F00;
	}

}

@media screen and (max-width: 1200px) {	
	.contenedor{
		margin-top:20px;
		/*background-color:#999;*/
		width:980px;
		margin:0 auto 0 auto;
	}
	.resolucion{
		height:10px;
		width:10px;
		background-color:#FF0;
	}
}

@media screen and (max-width: 980px) {	
	.contenedor{
		/*background-color:#999;*/
		width:100%;
		padding-top:0px;
	}
	.resolucion{
		height:10px;
		width:10px;
		background-color:#00FF40;
	}
}

@media screen and (max-width: 650px) {
	.contenedor{
		/*background-color:#999;*/
		width:100%;
		padding-top:0px;
	}
	.resolucion{
		height:10px;
		width:10px;
		background-color:#0FF;
	}
}

@media screen and (max-width: 480px) {
	.contenedor{
		padding-top:0px;
		/*background-color:#999;*/
		width:100%;
	}
	
	.cuerpo{
		/*background-color:#CCC;*/
		padding-left:10px;
		padding-right:10px;
		
	}
	
	.resolucion{
		height:10px;
		width:10px;
		background-color:#F0F;
	}
}
	
</style>




