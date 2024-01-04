<html lang="en">
    <?php 
    include('../templates/studHeader.php');
    ?>
    <div class="create-form">
     <h3 class='center'>CREATE BLOG</h3>
        <form action="process.php" method="POST">
            <div class="form-field mb-4">
                <input type="text" name="title" id="" placeholder="Enter Post Title" class="form-control">
            </div>
            <div class="form-field  mb-4">
                <textarea name="summary" id="" cols="80" rows="10" placeholder="Enter summary" class="form-control"></textarea>
            </div>
            <div class="form-field  mb-4">
                <textarea name="content" id="" cols="30" rows="10" placeholder="Enter post" class="form-control"></textarea>
            </div>
            <input type="hidden" name="date" value="<?php echo date("Y/m/d") ?>">
            <div class="form-field center  mb-4">
                <input type="submit" value="Post" name="create" class="btn form-control">
            </div>
        </form>
</div>
    </div>
    <?php include('../templates/studfooter.php'); ?>
</html>