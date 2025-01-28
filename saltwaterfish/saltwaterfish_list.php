<?php include '../view/header.php'; ?>
<main>
    <aside>
        <h1>Search Saltwater Fish</h1>
        <br>
        <a href="../.">Home</a>
        <nav>
    </aside>
    <section>
        <h1>Search Saltwater Fish</h1>
        
        <?php if (isset($_SESSION["CRUD_Result"]))
        {
            echo $_SESSION["CRUD_Result"];
            unset($_SESSION["CRUD_Result"]);
        }
        ?>
        
        <form action="." method="post" >
        Common Name: <INPUT TYPE="text" NAME="common_name" SIZE=5 VALUE="<?php echo htmlspecialchars($common_name);?>">
        Scientific_Name : <INPUT TYPE="text" NAME="scientific_name" SIZE=5 VALUE="<?php echo htmlspecialchars($scientific_name);?>">
        Lifespan : <INPUT TYPE="text" NAME="lifespan" SIZE=5 VALUE="<?php echo htmlspecialchars($lifespan);?>">
        Behavior : <INPUT TYPE="text" NAME="behavior" SIZE=5 VALUE="<?php echo htmlspecialchars($behavior);?>">
        Saltwater Fish ID : <INPUT TYPE="text" NAME="saltwater_fish_ID" SIZE=5 VALUE="<?php echo htmlspecialchars($saltwater_fish_ID);?>">
        <input type="hidden" name="action" value="list_saltwaterfish">
         <input type="submit" value="Search">
        </form>
        <br>
       <form action="." method="post" >
        <input type="hidden" name="action" value="add_saltwaterfish_form">
         <input type="submit" value="Add Saltwater Fish">
        </form>
        <br>

       <?php
        if (($_SESSION["Offset"]-$_SESSION["Limit"])>=0)
        {
        ?>

            <form action="." method="post" style = "display:inline">
                        <INPUT TYPE="hidden" NAME="common_name" VALUE="<?php echo htmlspecialchars($common_name);?>">
                        <INPUT TYPE="hidden" NAME="scientific_name" VALUE="<?php echo htmlspecialchars($scientific_name);?>">
                        <INPUT TYPE="hidden" NAME="lifespan"VALUE="<?php echo htmlspecialchars($lifespan);?>">
                        <INPUT TYPE="hidden" NAME="behavior" VALUE="<?php echo htmlspecialchars($behavior);?>">
                        <INPUT TYPE="hidden" NAME="saltwater_fish_ID"VALUE="<?php echo htmlspecialchars($saltwater_fish_ID);?>">
                            <input TYPE="hidden" NAME="action" VALUE="prev_list_saltwaterfish">
                            <input TYPE="submit" VALUE="Prev">
            </form>
        <?php } ?>
        
        
       <?php
        if (($_SESSION["Offset"]+$_SESSION["Limit"])<$_SESSION["NumResults"])
        {
        ?>

            <form action="." method="post" style = "display:inline">
                    <INPUT TYPE="hidden" NAME="common_name" VALUE="<?php echo htmlspecialchars($common_name);?>">
                    <INPUT TYPE="hidden" NAME="scientific_name" VALUE="<?php echo htmlspecialchars($scientific_name);?>">
                    <INPUT TYPE="hidden" NAME="lifespan"VALUE="<?php echo htmlspecialchars($lifespan);?>">
                    <INPUT TYPE="hidden" NAME="behavior" VALUE="<?php echo htmlspecialchars($behavior);?>">
                    <INPUT TYPE="hidden" NAME="saltwater_fish_ID"VALUE="<?php echo htmlspecialchars($saltwater_fish_ID);?>">
                        <input type="hidden" name="action" value="next_list_saltwaterfish">
                        <input type="submit" value="Next">
            </form>
        <?php } ?>
        
        <table border="1">
            <tr>
                <td>Scientific Name</td>
                <td>Common Name</td>
                <td>Lifespan</td>
                <td>Behavior</td>
                <td>Saltwater Fish ID</td>
            </tr>
            <?php foreach ($fishes as $fish) : ?>
            <tr>
                <td>
                <?php echo $fish->getScientific_Name(); ?>
                </td>
                <td>
                <?php echo $fish->getCommon_Name(); ?>
                </td>
                <td>
                <?php echo $fish->getLifespan(); ?>
                </td>
                <td>
                <?php echo $fish->getBehavior(); ?>
                </td>
                <td>
                <?php echo $fish->getSaltwaterFishID(); ?>
                </td>
                <td>
                 <form action="." method="post">
                    <input type="hidden" name="action"
                           value="view_saltwaterfish">
                    <input type="hidden" name="saltwater_fish_ID"
                           value=<?php echo $fish->getSaltwaterFishID(); ?>>
                    <input type="submit" value="View">
                </form>   
                    
                </td>
            </tr>
            <?php endforeach; ?>
        
        </table>
    </section>
</main>
<?php include '../view/footer.php'; ?>