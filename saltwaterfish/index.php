<?php
require('../model/database.php');
require('../model/saltwaterfish.php');
require('../model/saltwaterfish_db.php');
require('../view/BasicFieldValidation.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_saltwaterfish';
    }
}  

switch($action) {
    case 'list_saltwaterfish':
        session_start();// Start the session
        $_SESSION["Limit"]=10;
        $_SESSION["Offset"]=0;
        $scientific_name = isset($_POST['scientific_name']) ? trim($_POST['scientific_name']) : '';
        $common_name = isset($_POST['common_name']) ? trim($_POST['common_name']) : '';
        $lifespan = isset($_POST['lifespan']) ? trim($_POST['lifespan']) : '';
        $behavior = isset($_POST['behavior']) ? trim($_POST['behavior']) : '';
        $saltwater_fish_ID = isset($_POST['saltwater_fish_ID']) ? trim($_POST['saltwater_fish_ID']) : '';
        
        $fishes = saltwaterfishDB::SearchSaltwaterFish($scientific_name, $common_name, $lifespan, $behavior, $saltwater_fish_ID);
        include('saltwaterfish_list.php');
        break;
    
    case 'next_list_saltwaterfish':
        // Start the session
        session_start();
        $limit=$_SESSION["Limit"];
        $_SESSION["Offset"] += $limit;
        $scientific_name = isset($_POST['scientific_name']) ? trim($_POST['scientific_name']) : "";
        $common_name = isset($_POST['common_name']) ? trim($_POST['common_name']) : "";
        $lifespan = isset($_POST['lifespan']) ? trim($_POST['lifespan']) : "";
        $behavior = isset($_POST['behavior']) ? trim($_POST['behavior']) : "";
        $saltwater_fish_ID = isset($_POST['saltwater_fish_ID']) ? trim($_POST['saltwater_fish_ID']) : "";
        
        $fishes = saltwaterfishDB::SearchSaltwaterFish($scientific_name, $common_name, $lifespan, $behavior, $saltwater_fish_ID,$_SESSION["Offset"],$_SESSION["Limit"]);
        include('saltwaterfish_list.php');
        break;
    case 'prev_list_saltwaterfish':
        // Start the session
        session_start();
        $limit=$_SESSION["Limit"];
        $_SESSION["Offset"] -= $limit;
        $scientific_name = isset($_POST['scientific_name']) ? trim($_POST['scientific_name']) : "";
        $common_name = isset($_POST['common_name']) ? trim($_POST['common_name']) : "";
        $lifespan = isset($_POST['lifespan']) ? trim($_POST['lifespan']) : "";
        $behavior = isset($_POST['behavior']) ? trim($_POST['behavior']) : "";
        $saltwater_fish_ID = isset($_POST['saltwater_fish_ID']) ? trim($_POST['saltwater_fish_ID']) : ""; 
      
        $fishes = saltwaterfishDB::SearchSaltwaterFish($scientific_name, $common_name, $lifespan, $behavior, $saltwater_fish_ID,$_SESSION["Offset"],$_SESSION["Limit"]);
        include('saltwaterfish_list.php');
        break;

    case 'view_saltwaterfish':
        // Start the session
        session_start();

        $saltwater_fish_ID = filter_input(INPUT_POST, 'saltwater_fish_ID', 
                FILTER_VALIDATE_INT);   

        $_SESSION["saltwater_fish_ID"] = $saltwater_fish_ID;

        $fish = SaltwaterFishDB::getSaltwaterFish($saltwater_fish_ID);

        include('saltwaterfish_view.php');
        break;

    case 'delete_saltwaterfish':
            // Start the session
            session_start();
            $saltwater_fish_ID = filter_input(INPUT_POST, 'saltwater_fish_ID', FILTER_VALIDATE_INT);   
            $_SESSION["saltwater_fish_ID"] = $saltwater_fish_ID;

            $NumChgd = saltwaterfishDB::deleteSaltwaterFish($saltwater_fish_ID);

            $_SESSION["CRUD_Result"] = "".$NumChgd." record was deleted.";

            // display product list for the current category
            header("Location: .");
            break;
    
    case 'show_edit_saltwaterfish':
        // Start the session
        session_start();

        $saltwater_fish_ID = filter_input(INPUT_POST, 'saltwater_fish_ID', 
                FILTER_VALIDATE_INT);   

        $_SESSION["saltwater_fish_ID"] = $saltwater_fish_ID;

        $fish = SaltwaterFishDB::getSaltwaterFish($saltwater_fish_ID);

        include('saltwaterfish_edit.php');
        break;

    case 'update_saltwaterfish':
        // Start the session
        session_start();
        $saltwater_fish_ID = filter_input(INPUT_POST, 'saltwater_fish_ID', FILTER_VALIDATE_INT);
        $_SESSION["saltwater_fish_ID"] = $saltwater_fish_ID;
        $fish = SaltwaterFishDB::getSaltwaterFish($saltwater_fish_ID);

        $scientific_name = filter_input(INPUT_POST, 'ScientificName');
        $common_name = filter_input(INPUT_POST, 'CommonName');
        $lifespan = filter_input(INPUT_POST, 'Lifespan', FILTER_VALIDATE_INT);
        $behavior = filter_input(INPUT_POST, 'Behavior');
        
        $scientific_name = trim($scientific_name);
        $common_name = trim($common_name);
        
        $valid = true;
        $error ="";
        
        //validate Scientific Name
        ValidateText($scientific_name,"Scientific Name",$error,$valid);
        validateRequired($scientific_name,"Scientific Name",$error,$valid);
        //validate Common Name
        ValidateText($common_name,"Common Name",$error,$valid);
        validateRequired($common_name,"Common Name",$error,$valid);
        //validate Lifespan
        ValidateIntRange($lifespan,'Lifespan',$error,$valid,0,50);
        validateRequired($lifespan,"Lifespan",$error,$valid);
        //validate Behavior
        if (isset($_POST['Behavior'])==false)
        {
          $valid = false;
          $error .="Missing Behavior <br>"; 
        }
        
        
        if ($valid) 
        { 
            $fish->setLifespan($lifespan);
            $fish->setBehavior($behavior);
            $fish->setScientific_Name($scientific_name);
            $fish->setCommon_Name($common_name);

            $NumChgd = saltwaterfishDB::updateSaltwaterFish($fish);
            $_SESSION["CRUD_Result"] = "".$NumChgd." record was updated.";
            include('saltwaterfish_view.php');
        }
        else
        {
           include('saltwaterfish_edit.php');
           break; 
        }
        break;
    
    case 'add_saltwaterfish_form':
        include('saltwaterfish_add.php');
        break;       

    case 'insert_saltwaterfish':
        // Start the session
        session_start();
        $scientific_name = filter_input(INPUT_POST, 'ScientificName');
        $common_name = filter_input(INPUT_POST, 'CommonName');
        $lifespan = filter_input(INPUT_POST, 'Lifespan', FILTER_VALIDATE_INT);
        $behavior = filter_input(INPUT_POST, 'Behavior');
        
        $scientific_name = trim($scientific_name);
        $common_name = trim($common_name);

        $fish = new saltwaterfish($scientific_name,
                            $common_name,
                            $lifespan,
                            $behavior);
        $valid = true;
        $error ="";

        //validate Scientific Name
        ValidateText($scientific_name,"Scientific Name",$error,$valid);
        validateRequired($scientific_name,"Scientific Name",$error,$valid);
        //validate Common Name
        ValidateText($common_name,"Common Name",$error,$valid);
        validateRequired($common_name,"Common Name",$error,$valid);
        //validate Lifespan
        ValidateIntRange($lifespan,'Lifespan',$error,$valid,0,50);
        validateRequired($lifespan,"Lifespan",$error,$valid);
        //validate Behavior
        if (isset($_POST['Behavior'])==false)
        {
          $valid = false;
          $err .="Missing Behavior <br>"; 
        }

        if ($valid) 
        { 
            $saltwaterfishID = saltwaterfishDB::addSaltwaterFish($fish);
            $fish = saltwaterfishDB::getSaltwaterFish($saltwaterfishID);
            $_SESSION["saltwater_fish_ID"] = $saltwaterfishID;
            $_SESSION["CRUD_Result"] = "1 record was inserted.";
            include('saltwaterfish_view.php');
        }
        else 
        {
           include('saltwaterfish_add.php');
           break;       
        }
        break;     
}