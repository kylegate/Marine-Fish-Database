<?php include '../view/header.php'; ?>
<?php include '../view/BasicFormFuncs.php'; ?>

<main>
    <aside>
        <h1>Edit Saltwater Fish</h1>
        <br>
        <a href="../.">Home</a>
        <nav>
    </aside>

    <section>
        <h1><b>Saltwater Fish ID:</b> <?php echo $fish->getSaltwaterFishID(); ?></h1>
        <div id="right_column">
        <?php  
        if (isset($error))
        {?>
            <label>Errors:</label><br>
            <?php echo $error?><br>    
        <?php
        }
        ?>  
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="update_saltwaterfish"/>
            <input type="hidden" name="saltwater_fish_ID"
                   value="<?php echo $fish->getSaltwaterFishID(); ?>" />
            
            Scientific Name: <INPUT TYPE="text" NAME="ScientificName" SIZE=14 VALUE="<?php echo htmlspecialchars($fish->getScientific_Name());?>">
            <br>
            Common Name: <INPUT TYPE="text" NAME="CommonName" SIZE=16 VALUE="<?php echo htmlspecialchars($fish->getCommon_Name());?>">
            <br>
            Lifespan: <INPUT TYPE="text" NAME="Lifespan" SIZE=5 VALUE="<?php echo htmlspecialchars($fish->getLifespan());?>">
            <br>
            Behavior: 
            <SELECT name="Behavior">
            <OPTION VALUE="Peaceful" 
            <?php  setSelected($fish->getBehavior(),"Peaceful");?>
            > Peaceful
            <OPTION VALUE="Semi-aggressive" 
            <?php  setSelected($fish->getBehavior(),"Semi-aggressive");?>
            > Semi-aggressive
            <OPTION VALUE="Aggressive" 
            <?php  setSelected($fish->getBehavior(),"Aggressive");?>
            > Aggressive
            </SELECT> 
            <BR><BR>
          
        <input type="submit" value="Submit"/>
        </form>

        </div>
    </section>
</main>
<?php include '../view/footer.php'; ?>