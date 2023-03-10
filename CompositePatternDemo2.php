<html>
<body>
<head>
<style>
body {font : 12px verdana; font-weight:bold}
td {font : 11px verdana;}
</style>
</head>
<?php
    abstract class Construccio {
        private $name;
        private $superficie;
        private $construccio = array();
        
        public function add(Construccio  $construccions) {
            array_push($this->construccio, $construccions);
        }
        
        public function remove(Construccio  $construccions) {
            array_pop($this->construccio);
        }
                
        public function hasChildren() {
            return (bool)(count($this->construccio) > 0);
        }
            
        public function getChild($i) {
            return $this->construccio[i];
        }
            
        public function getDescription() {
            echo "- one " . $this->getName();
            if ($this->hasChildren()) {
                echo " which includes:<br>";
                foreach($this->construccio as $construccions) {
                    echo "<table cellspacing=5 border=0><tr><td>&nbsp;&nbsp;&nbsp;</td><td>-";
                    $construccions->getDescription();
                    echo "</td></tr></table>";
                }        
            }
        }
        public function getSuma() {
            echo "- one " . $this->getName();
            $superficieTotal = 0;
            if ($this->hasChildren()) {
                echo " which includes:<br>";
                foreach($this->construccio as $construccions) {
                    echo "<table cellspacing=5 border=0><tr><td>&nbsp;&nbsp;&nbsp;</td><td>-";
                    $superficieTotal = $superficieTotal + $construccions->getSuma();
                    echo "</td></tr></table>";
                }        
            } 
            return $superficieTotal + $this->superficie;
        }
        public function setName($name) {
            $this->name = $name;
        }
           
        public function getName() {
            return $this->name;
        }
                  
        public function setSuperficie($superficie) {
            $this->superficie = $superficie;
        }
         
         public function getSuperficie() {
             return $this->superficie;
         }
    }

    class Habitacio extends Construccio {
        function __construct($name, $superficie) {
          parent::setName($name);
          parent::setSuperficie($superficie);
        }      
      }
      
      class Porta extends Construccio {
        function __construct($name, $superficie) {
         parent::setName($name);
         parent::setSuperficie($superficie);
        }
      }
      
      class Finestra extends Construccio {
        function __construct($name,$superficie) {
          parent::setName($name);
          parent::setSuperficie($superficie);
        }
      }

      //Galer??a y cocina
       $PuertaPrincipalCocina = new Porta("Puerta de la cocina", 67);
       $cocina = new Habitacio("Cocina", 234);
       $PuertaGaleria = new Porta("Puerta de la galer??a", 67);
       $galeria = new Habitacio("La galer??a", 123);
       $pasilloprincipal = new Habitacio("Pasillo Principal", 34);
       $galeria->add(new Finestra("La ventana de la galer??a", 153));
       $PuertaGaleria->add($galeria);
       $PuertaPrincipalCocina->add($cocina);
       $cocina->add($PuertaGaleria);
       $pasilloprincipal->add($cocina);
       

    //   $pasilloprincipal->add($PuertaPrincipalCocina);

      //Habitaciones, ba??o, recibidor y comedor
      $PuertaPrincipalComedor = new Porta("Puerta del comedor", 112);
      $comedor = new Habitacio("Comedor", 120);
      $PuertaRecibidor = new Porta("Puerta del recibidor", 126);
      $recibidor = new Habitacio("Recibidor", 50);
      $PuertaHabitacion = new Porta("Puerta de mi habitaci??n", 67);
      $PuertaHabitacionPadres = new Porta("Puerta habitaci??n de mis padres", 67);
      $PuertaHabitacionHermana = new Porta("Puerta de la habitaci??n de mi hermana", 67);
      $PuertaLavabo = new Porta("Puerta del cuarto de ba??o", 67);
      $Habitacion = new Habitacio("Mi habitaci??n", 40);
      $HabitacionPadres = new Habitacio("Habitaci??n de mis padres", 40);
      $HabitacionHermana = new Habitacio("Habitaci??n de mi hermana", 40);
      $Lavabo = new Habitacio("Lavabo", 30);

      $Lavabo->add(new Finestra("Ventana del ba??o", 5));
      $Habitacion->add(new Finestra("Ventana de mi habitaci??n", 45));
      $HabitacionPadres->add(new Finestra("Ventana de la habitaci??n de mis padres", 45));
      $HabitacionHermana->add(new Finestra("Ventana de la habitaci??n de mi hermana", 45));
      $PuertaLavabo->add($Lavabo);
      $PuertaHabitacionPadres->add($HabitacionPadres);
      $PuertaHabitacion->add($Habitacion);
      $PuertaHabitacionHermana->add($HabitacionHermana);

      $recibidor->add($PuertaLavabo);
      $recibidor->add($PuertaHabitacion);
      $recibidor->add($PuertaHabitacionPadres);
      $recibidor->add($PuertaHabitacionHermana);

      $PuertaRecibidor->add($recibidor);
      $comedor->add($PuertaRecibidor);

      $comedor->getDescription();
      //$pasilloprincipal->getDescription();
      
      $superficieTotal = $pasilloprincipal->getSuma();
      echo "La superficie total es: ";
      echo $superficieTotal;
?>