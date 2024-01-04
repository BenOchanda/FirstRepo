<?php
    include('../templates/studHeader.php');
?>
<div class="post-list w-100">
    <table class="table table-bordered">
        <thead>
            <tr>
            <th  class="center" style="width:15%">Publication Date</th>
            <th  class="center" style="width:15%">Title</th>
            <th  class="center" style="width:45%">Article</th>
            <th  class="center" style="width:25%">Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        include('../config/db_connect.php');
        $sql = "SELECT * FROM posts";
        $result = mysqli_query($conn, $sql);
        while($data=mysqli_fetch_array($result)) {?>
             <tr>
            <td><?php echo $data["date"]; ?></td>
            <td><?php echo $data["title"]; ?></td>
            <td><?php echo $data["summary"]; ?></td>
            <td class="center">
                <a href="view.php?id=<?php echo $data["id"]; ?>" class="btn">View</a>
                <a href="edit.php?id=<?php echo $data["id"]; ?>" class="btn">Edit</a>
                <a href="delete.php?id=<?php echo $data["id"]; ?>" class="btn btn-danger">Delete</a>
            </td>
            </tr>
        <?php }?>
        
       
        </tbody>
    </table>
    </div>
<?php
   include('../templates/studfooter.php');
?>