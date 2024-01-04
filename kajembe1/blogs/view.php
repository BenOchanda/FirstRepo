<?php
    include('../templates/studHeader.php');
    include('../config/db_connect.php');
?>
    <div class="post w-100 bg-light p-5">
        <?php
            $id= $_GET['id'];
            if($id){
                $sql="SELECT * FROM posts WHERE id=$id";
                $result=mysqli_query($conn, $sql);
                //$data= mysqli_fetch_array($result); INFINITE LOOP!!!!
                while($data= mysqli_fetch_array($result)){?>
                  <h1><?php echo $data['title'];?> </h1>  
                  <p><?php echo $data['date'];?> </p>  
                  <p><?php echo $data['content'];?> </p> 
               <?php }
            }else{
                die("POST doesnt exist!");
            } ?>
    </div>
<?php   include('../templates/studfooter.php');?>