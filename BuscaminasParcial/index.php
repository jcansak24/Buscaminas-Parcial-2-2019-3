<?php
	echo "<center><h1><b>JUEGO DEL BUSCAMINAS</b></h1>";//
	session_start();	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buscaminas</title>
	
</head>
<body onload='BombaInit()'>
	<form name="dimensionTablero" action="" method="POST">
		
		<label>Nombre: </label><input type="text" name="nombre" value="<?php
		if(isset($_POST["nombre"])) echo $_POST["nombre"];
	?>" required="required" placeholder="Ingrese su nombre aquí...">
		
			<label>Dimension Tablero: </label>
			<select name="cantidad" value="<?php
		if(isset($_POST["nombre"])) echo $_POST["nombre"];
	?>" required="required">
				<option>Seleccione la cantidad</option>
				<?php
					for($i=8;$i<=20;$i++) echo "<option value='",$i,"'>",$i,"x",$i,"</option>";
				?>
			</select>
			<label>Tiempo </label>
			<div id="response"></div>
			
			<input type="submit" name="Boton" value="Aceptar">
			<input type="submit" name="BotonReinicio" value="Reiniciar">
			
	</form>
		
	<script type="text/javascript">
			var ArregloImagenes = new Array();
			function BombaInit(){
				var i;
				var numero;
				for (i = 0; i < 10; i++) {
					ArregloImagenes[i]=imagen.id;
				}
				for(i=0;i<4;i++){
					do{
						numero=Math.floor(Math.random()*12);
					}while(ArregloImagenes[numero]!="imagenes/bomba.jpg");
					ArregloImagenes="imagenes/bomba.jpg";
				}
			}
			function BombaInicializarIU(){
				var i;
				for (i = 0; i < $_POST['cantidad']*$_POST['cantidad']; i++) {
					document.getElementById(i).src("imagenes/casilla.jpg");
				}
			}
			var conta=0;
			function img_click(imagen,$f,$c){
				var f=$f;
				var c=$c;
				
				imagen.src=ArregloImagenes[imagen.id];
				//alert("juego terminado");
				llenarTablero($tam,f,c,$Bombas,$vector,conta);
				matrizJuego($_POST['cantidad'],true);
				//BombaInit();
				//BombaInicializarIU();
				//document.getElementById("0").src("imagenes/casilla.jpg");
				
				conta++;
			}
		</script>
	<?php
		/*if(isset($_POST["nombre"])) {
			echo "Nombre: ", $_POST["nombre"];
			echo "Dimension: ", $_POST["cantidad"];
			echo "Dimension: ", $_POST["cantidad"];
		}*/
		
		$tam=gettext($_POST["cantidad"]);
	?>
</body>
</html>
<?php
    //var_dump($_POST);
    //echo "<br/>dimension: ",$tam;
	$f=0;
	$c=0;
	$cont=0;
    $total_casillas = $tam*$tam; //Guardo el total de las casillas para moverme luego en un for
    $B=$total_casillas*0.35;
    $Bombas=(int)$B;
    //echo "Bombas totales: ",$Bombas;
    $vector;    //declaramos el vector vacio
    $vectorImagenes;
 
    //vector vacio pero con todas las posiciones
    function vector_v(&$vector,$total_casillas,$tam){
    	for($i=0;$i <= $tam;$i++){
        	for ($j=0; $j < $tam; $j++) { 
        		$vector[$i][$j]= "&nbsp"; 
        		
        	}        
    	}
      	return $vector;
    }
 	function vector_i(&$vectorImagenes,$total_casillas,$tam){
    	
    	for($i=0;$i <= $tam;$i++){
        	for ($j=0; $j < $tam; $j++) {$vectorImagenes[$i][$j]="imagenes/vacio.jpg";
        	}        
    	}
      	return $vectorImagenes;
    }
 
 
    //Esta funcion introduce las minas aleatoriamente en el vector
    function poner_minas($Bombas,$tam,&$vector,&$vectorImagenes){
    	$total=$Bombas;//usaremos esta variable para controlar que se escriban correctamente las minas.
    	
    	do{
    		//echo "<br/>total: ",$total;
    		$h=rand(0,$tam-1);//creamos un numero aleatorio para movernos por las filas
    		$v=rand(0,$tam-1);//creamos un numero para movernos por las columnas.
    		
            if ($vector[$h][$v] == "&nbsp"){//Si en esa posición aleatoria hay un asterisco que no haga nada
 			$vector[$h][$v] = "*";
 			$vectorImagenes="imagenes/bomba.jpg";
            	$total--;	
            }
        }while($total > 0);
        return $vector;
    }
 
    //Esta funcion pone los números que indican las posiciones de las minas
    
    function poner_numeros($tam,&$vector,&$vectorImagenes){
 	$contMinas=0;
 	//$contnum2=0;
    for($I=0;$I < $tam;$I++){             //hacemos 2 fors que nos recorran el vector (columnas y filas)
        for($J=0;$J < $tam;$J++){         //Tenemos 8 if's que miran las posiciones que rodean dónde nos encontremos
             
              
             	if($vector[$I][$J]!="*"){ //miramos si delante hay un asterisco
             		if($J<$tam-1 && $vector[$I][$J+1]=="*") $contMinas++;
             		if (($J<$tam-1 && $I<$tam-1) && $vector[$I+1][$J+1]=="*") $contMinas++;
             		if ($I<$tam-1 && $vector[$I+1][$J]=="*") $contMinas++;
             		if (($I<$tam-1 && $J>0) && $vector[$I+1][$J-1]=="*") $contMinas++;
             		if ($J>0 && $vector[$I][$J-1]=="*") $contMinas++;
             		if (($I>0 && $J>0) && $vector[$I-1][$J-1]=="*") $contMinas++;
             		if ($I>0 && $vector[$I-1][$J]=="*") $contMinas++;
             		if (($I>0 && $J<$tam-1) && $vector[$I-1][$J+1]=="*") $contMinas++;
             		if ($contMinas!=0) $vector[$I][$J]=$contMinas;
             		//echo "numMinas= ",$contMinas;

             	}	
        	$contMinas=0;     
             
        }
        //$contMinas=0;
    }
    return $vector;
}
	//var ArregloImagenes=new Array();
	function llenarTablero($tam,$f,$c,$Bombas,&$vector,$cont){
		echo "<table border='1'cellpadding='1'>";
		echo "Minas: ",$Bombas;
		for ($i=0;$i < $tam; $i++){
        echo "<tr>";
        for($j=0;$j < $tam;$j++){
            if($cont>0){
            	if($i==$f && $j==$c){
            		if($vector[$i][$j]=="&nbsp"){
            		echo "<td><img src='imagenes/vacio.jpg' onclick='img_click(this,$i,$j)'></td>";//Aqui nos escribe el array dentro de la tabla		
            	}
            	else{
            		if($vector[$i][$j]=="*"){
            		echo "<td><img src='imagenes/bomba.jpg' onclick='img_click(this,$i,$j)'></td>";//Aqui nos escribe el array dentro de la tabla		
            		}
            		else{
            			if($vector[$i][$j]==1) echo "<<td><img src='imagenes/1.jpg' onclick='img_click(this,$i,$j)'></td>";
            			if($vector[$i][$j]==2) echo "<<td><img src='imagenes/2.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==3) echo "<<td><img src='imagenes/3.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==4) echo "<<td><img src='imagenes/4.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==5) echo "<<td><img src='imagenes/5.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==6) echo "<<td><img src='imagenes/6.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==7) echo "<<td><img src='imagenes/7.jpg' onclick='img_click(this$i,$j)'></td>";//Aqui nos escribe el array dentro de la tabla		
            			}
            		}
            	}
            	else{

            		echo "<td><img src='imagenes/casilla.jpg' onclick='img_click(this,$i,$j)'></td>";//Aqui nos escribe el array dentro de la tabla		
            	}
            
            }else{
            	echo "<td><img src='imagenes/casilla.jpg' onclick='img_click(this,$i,$j)'></td>";
            }
        }
        echo "</tr>";
    }

    echo "</table>";
 
echo "</center>";

	}

function matrizJuego($tam,$f,$c,$Bombas,&$vector){

    echo "<table border='1'cellpadding='1'>";//Mostramos la tabla con 2 fors que hacen las columnas y las filas
    echo "Minas: ",$Bombas;
    for ($i=0;$i < $tam; $i++){
        echo "<tr>";
        for($j=0;$j < $tam;$j++){
            if($vector[$i][$j]=="&nbsp"){
            		echo "<td><img src='imagenes/vacio.jpg' onclick='img_click(this,$i,$j)'></td>";//Aqui nos escribe el array dentro de la tabla		
            	}
            	else{
            		if($vector[$i][$j]=="*"){
            		echo "<td><img src='imagenes/bomba.jpg' onclick='img_click(this,$i,$j)'></td>";//Aqui nos escribe el array dentro de la tabla		
            		}
            		else{
            			if($vector[$i][$j]==1) echo "<<td><img src='imagenes/1.jpg' onclick='img_click(this,$i,$j)'></td>";
            			if($vector[$i][$j]==2) echo "<<td><img src='imagenes/2.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==3) echo "<<td><img src='imagenes/3.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==4) echo "<<td><img src='imagenes/4.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==5) echo "<<td><img src='imagenes/5.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==6) echo "<<td><img src='imagenes/6.jpg' onclick='img_click(this$i,$j)'></td>";
            			if($vector[$i][$j]==7) echo "<<td><img src='imagenes/7.jpg' onclick='img_click(this$i,$j)'></td>";//Aqui nos escribe el array dentro de la tabla		
            		}
            	}

            
            
            
        }
        echo "</tr>";
    }
    echo "</table>";
 
echo "</center>";

} 
require "Timer.php";
//Llamamos a todas las funciones para que se genere el array con el juego hecho.
vector_v($vector,$total_casillas,$tam);
poner_minas($B,$tam,$vector,$vectorImagenes);
poner_numeros($tam,$vector,$vectorImagenes);
llenarTablero($tam,$f,$c,$Bombas,$vector,$cont); 
matrizJuego($tam,$f,$c,$Bombas,$vector);
//echo "Usamos un tablero de $tam x $tam y ",(int)$B," minas";
 

?>
