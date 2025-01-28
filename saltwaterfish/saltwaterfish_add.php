<?php include '../view/header.php'; ?>
<?php include '../view/BasicFormFuncs.php'; ?>

<main>
    <aside>
        <h1>Add a Saltwater Fish</h1>
        <br>
        <a href="../.">Home</a>
        <nav>
    </aside>

    <section>
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
            <input type="hidden" name="action" value="insert_saltwaterfish"/>
            Scientific Name: <INPUT TYPE="text" NAME="ScientificName" SIZE=14 VALUE="<?php echo (isset($fish))? htmlspecialchars($fish->getScientific_Name()): ' ';?>">
            <br>
            Common Name: <INPUT TYPE="text" NAME="CommonName" SIZE=16 VALUE="<?php echo (isset($fish))? htmlspecialchars($fish->getCommon_Name()): ' ';?>">
            <br>
            Lifespan: <INPUT TYPE="text" NAME="Lifespan" SIZE=5 VALUE="<?php echo (isset($fish))? $fish->getLifespan():'';?>">
            <br>
            Behavior:
            <select name="Behavior">
                <option value="Aggressive" <?php echo (isset($behavior) && $behavior == 'Aggressive') ? 'selected' : ''; ?>>Aggressive</option>
                <option value="Semi-Aggressive" <?php echo (isset($behavior) && $behavior == 'Semi-Aggressive') ? 'selected' : ''; ?>>Semi-Aggressive</option>
                <option value="Peaceful" <?php echo (isset($behavior) && $behavior == 'Peaceful') ? 'selected' : ''; ?>>Peaceful</option>
            </select>
            <BR><BR>
        <input type="submit" value="Submit"/>
        </form>
        </div>
    </section>
</main>
<?php include '../view/footer.php'; ?>