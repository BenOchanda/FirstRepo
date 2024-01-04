<html lang="en">
    <?php 
    include('../templates/studHeader.php');
    include('../config/db_connect.php');
    $id=$_GET['id'];
    if($id){
        $sql="SELECT * FROM posts WHERE id=$id";
        $result=mysqli_query($conn, $sql);

    }else{
        echo "No post found";
    }?>
    <div class="create-form">
     <h3 class='center'>EDIT BLOG</h3>
        <form action="process.php" method="POST">
            <?php
            while($data=mysqli_fetch_array($result)){
            ?>
            <div class="form-field mb-4">
                <input type="text" name="title" id="" placeholder="Enter Post Title" class="form-control" value="<?php echo $data['title']; ?>">
            </div>
            <div class="form-field  mb-4">
                <textarea name="summary" id="" cols="80" rows="10" placeholder="Enter summary" class="form-control"> <?php echo $data['summary'];?></textarea>
            </div>
            <div class="form-field  mb-4">
                <textarea name="content" id="" cols="30" rows="10" placeholder="Enter post" class="form-control"><?php echo $data['content']; ?></textarea>
            </div>
            <input type="hidden" name="date" value="<?php echo date("Y/m/d") ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>" >
            <div class="form-field center  mb-4">
                <input type="submit" value="Update" name="update" class="btn form-control">
            </div>
            <?php } ?>
        </form>
</div>
    </div>
    <?php include('../templates/studfooter.php'); ?>
</html>