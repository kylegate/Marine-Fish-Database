<?php include '../view/header.php'; ?>
<main>
    <aside>
        <h1>View Saltwater Fish</h1>
        <br>
        <a href="../.">Home</a>
        <nav>
    </aside>
        <!-- display buttons -->
    <div class="last_paragraph">
         <form action="." method="post" id="edit_button_form" style = "display:inline">
            <input type="hidden" name="action" value="show_edit_saltwaterfish"/>
            <input type="hidden" name="saltwater_fish_ID"
                   value="<?php echo $fish->getSaltwaterFishID(); ?>" />
            <input type="submit" value="Edit Saltwater Fish" />
        </form>
        
        <form action="." method="post" style = "display:inline">
            <input type="hidden" name="action" value="delete_saltwaterfish"/>
            <input type="hidden" name="saltwater_fish_ID"
                   value="<?php echo $fish->getSaltwaterFishID(); ?>" />
            <input type="submit" value="Delete Saltwater Fish"/>
        </form>
    </div>
        <?php if (isset($_SESSION["CRUD_Result"]))
        {
            echo $_SESSION["CRUD_Result"];
            unset($_SESSION["CRUD_Result"]);
        }
        ?>
    <section>
        <h1><?php echo $fish->getCommon_Name(); ?></h1>
        <div id="right_column">
            <p><b>Saltwater Fish ID:</b> <?php echo $fish->getSaltwaterFishID(); ?></p>
            <p><b>Scientific Name:</b> <?php echo $fish->getScientific_Name(); ?></p>
            <p><b>Lifespan:</b> <?php echo $fish->getLifespan(); ?></p>
            <p><b>Behavior:</b> <?php echo $fish->getBehavior(); ?></p>
        </div>
    </section>
</main>
<?php include '../view/footer.php'; ?>