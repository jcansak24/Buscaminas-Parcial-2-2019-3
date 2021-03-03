<?php
    //var_dump($_POST);
    //echo "<br/>dimension: ",$tam;

    $total_casillas = $tam*$tam; //Guardo el total de las casillas para moverme luego en un for
    $B=$total_casillas*0.35;
    $Bombas=(int)$B;
    //echo "Bombas totales: ",$Bombas;
    $vector;    //declaramos el vector vacio
 
 
    //vector vacio pero con todas las posiciones
    function vector_v(&$vector,$total_casillas,$tam){
        for($i=0;$i <= $tam;$i++){
            for ($j=0; $j < $tam; $j++) { 
                $vector[$i][$j]= "&nbsp"; 
            }        
        }
        return $vector;
    }
 
 
 
    //Esta funcion introduce las minas aleatoriamente en el vector
    function poner_minas($Bombas,$tam,&$vector){
        $total=$Bombas;//usaremos esta variable para controlar que se escriban correctamente las minas.
        
        do{
            //echo "<br/>total: ",$total;
            $h=rand(0,$tam-1);//creamos un numero aleatorio para movernos por las filas
            $v=rand(0,$tam-1);//creamos un numero para movernos por las columnas.
            
            if ($vector[$h][$v] == "&nbsp"){//Si en esa posición aleatoria hay un asterisco que no haga nada
            $vector[$h][$v] = "*";
                $total--;   
            }
        }while($total > 0);
        return $vector;
    }
 
    //Esta funcion pone los números que indican las posiciones de las minas
    
    function poner_numeros($tam,&$vector){
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
    
 
//Llamamos a todas las funciones para que se genere el array con el juego hecho.
vector_v($vector,$total_casillas,$tam);
poner_minas($B,$tam,$vector);
poner_numeros($tam,$vector);
 
//echo "Usamos un tablero de $tam x $tam y ",(int)$B," minas";
 
    echo "<table border='3'cellpadding='20'>";//Mostramos la tabla con 2 fors que hacen las columnas y las filas
    
    for ($i=0;$i < $tam; $i++){
        echo "<tr>";
        for($j=0;$j < $tam;$j++){
            echo "<td>".$vector[$i][$j]."</td>";//Aqui nos escribe el array dentro de la tabla
        }
        echo "</tr>";
    }
    echo "</table>";
 
echo "</center>";

?>