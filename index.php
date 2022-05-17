<html lang="en">
    <head>
    <meta charset="UTF-8">
    <!-- import du fichier less (less : framework css) -->
    <link rel="stylesheet/less" type="text/css" href="less/styles.less"/>
    <script src="https://cdn.jsdelivr.net/npm/less@4" ></script>
    <!-- fontAwesome -->
    <script src="https://kit.fontawesome.com/cabff833b6.js"></script>

    <?php  
    $LesVoitures=array();
    $LesMarques=array();
    $LesCarburants=array();
    $LesNoms=array();
    $CarburantSelectionné;
    $MarqueSelectionnée;

    //recuperation du JSON de toutes les voitures 
    $url="https://localhost:7042/api/Voiture";
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  
    $data = file_get_contents($url, false, stream_context_create($arrContextOptions));
    $json=json_decode($data);


    //Class Voiture
    class Voiture{
        public $Marque;
        public $Modele;
        public $Carburant;
        public $Puissance;
        public $Boite;
        public $NbPorte;
        public $Capacite;
        public $urlImage;

        public function __construct($Marque,$Modele,$Carburant,$Puissance,$Boite,$NbPorte, $Capacite, $urlImage)
        {
            $this->Marque=$Marque;
            $this->Modele=$Modele;
            $this->Carburant=$Carburant;
            $this->Puissance=$Carburant;
            $this->Boite=$Boite;
            $this->NbPorte=$NbPorte;
            $this->Capacite=$Capacite;
            $this->urlImage=$urlImage;
        }

    }

    //Deserialisation du json pour creer les voiture
    foreach($json as $Voiture){
        $caracteristiques=array();
        foreach($Voiture as $attributVoiture){
            array_push($caracteristiques,$attributVoiture);
        }
        $nouvelleVoiture=new Voiture($caracteristiques[0],$caracteristiques[1],$caracteristiques[2],$caracteristiques[3],$caracteristiques[4],$caracteristiques[5],$caracteristiques[6],$caracteristiques[7]);

        array_push($LesVoitures,$nouvelleVoiture);
    }

    //recuperation du JSON de toutes les marques de voiture  
    $url="https://localhost:7042/api/MarquesVoiture";
    $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  
    $data = file_get_contents($url, false, stream_context_create($arrContextOptions));
    $json=json_decode($data);

    foreach($json as $Marque){
        array_push($LesMarques,$Marque);
    }




        //recuperation du JSON de tout les carburant de voiture  
        $url="https://localhost:7042/api/CarburantsVoiture";
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        $data = file_get_contents($url, false, stream_context_create($arrContextOptions));
        $json=json_decode($data);
    
        foreach($json as $Carburant){
            array_push($LesCarburants,$Carburant);
        }

           //recuperation du JSON de tout les noms de voiture  
           $url="https://localhost:7042/api/NomCompletVoiture";
           $arrContextOptions=array(
               "ssl"=>array(
                   "verify_peer"=>false,
                   "verify_peer_name"=>false,
               ),
           );  
           $data = file_get_contents($url, false, stream_context_create($arrContextOptions));
           $json=json_decode($data);
       
           foreach($json as $nom){
               array_push($LesNoms,$nom);
           }

        
    ?>

    <title>BestCar</title>
    </head>
    <body>
        <div id="bestCar">

            <div class="bg">
                <div class="nav-bar"><a href="#" class="logo">BestCar</a></div>
                <div class="content-header">
                <h1>Rechercher la voiture</h1>
                <div class="search-zone">
                    <select id="marque">
                        <option selected="selected" >Sélectionner une marque</option>
                        <?php
                        foreach($LesMarques as $value){
                            ?>
                                <option value="<?php echo $value;  ?>" ><?php echo $value;  ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <select id="carburant" onclick="CarburantSelectionné=this.options[this.selectedIndex].text;">
                        <option selected="selected" >Sélectionner un carburant</option>
                        <?php
                        foreach($LesCarburants as $value){
                            ?>
                                <option value="<?php echo $value;  ?>" ><?php echo $value;  ?></option>
                            <?php
                        }
                        ?>
                    </select>  
                    
                    <button onclick="Actualiser()" >Rechercher</button>              
                
                    <script>
                        function Actualiser() {
                            <?php
                            ?>

                        }
                    </script>
                </div>
                </div>
            </div>
            <?php
                        foreach($LesNoms as $value){

                            ?>
                         
                                <label><?php echo $value;  ?></label><br>
                            <?php
                        }
                        ?>
            <div class="content">
                <div class="wrapper">
                    
                    
                </div>
            </div>

            <footer>
                <a href="#">Tous droits réservés | BestCar</a>
            </footer>
            
        </div>
    </body>
</html>
