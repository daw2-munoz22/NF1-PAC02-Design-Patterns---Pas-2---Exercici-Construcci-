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

      //Galería y cocina
       $PuertaPrincipalCocina = new Porta("Puerta de la cocina", 67);
       $cocina = new Habitacio("Cocina", 234);
       $PuertaGaleria = new Porta("Puerta de la galería", 67);
       $galeria = new Habitacio("La galería", 123);
       $pasilloprincipal = new Habitacio("Pasillo Principal", 34);
       $galeria->add(new Finestra("La ventana de la galería", 153));
       $PuertaGaleria->add($galeria);
       $PuertaPrincipalCocina->add($cocina);
       $cocina->add($PuertaGaleria);
       $pasilloprincipal->add($cocina);
       

    //   $pasilloprincipal->add($PuertaPrincipalCocina);

      //Habitaciones, baño, recibidor y comedor
      $PuertaPrincipalComedor = new Porta("Puerta del comedor", 112);
      $comedor = new Habitacio("Comedor", 120);
      $PuertaRecibidor = new Porta("Puerta del recibidor", 126);
      $recibidor = new Habitacio("Recibidor", 50);
      $PuertaHabitacion = new Porta("Puerta de mi habitación", 67);
      $PuertaHabitacionPadres = new Porta("Puerta habitación de mis padres", 67);
      $PuertaHabitacionHermana = new Porta("Puerta de la habitación de mi hermana", 67);
      $PuertaLavabo = new Porta("Puerta del cuarto de baño", 67);
      $Habitacion = new Habitacio("Mi habitación", 40);
      $HabitacionPadres = new Habitacio("Habitación de mis padres", 40);
      $HabitacionHermana = new Habitacio("Habitación de mi hermana", 40);
      $Lavabo = new Habitacio("Lavabo", 30);

      $Lavabo->add(new Finestra("Ventana del baño", 5));
      $Habitacion->add(new Finestra("Ventana de mi habitación", 45));
      $HabitacionPadres->add(new Finestra("Ventana de la habitación de mis padres", 45));
      $HabitacionHermana->add(new Finestra("Ventana de la habitación de mi hermana", 45));
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