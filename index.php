<?php  include('server.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Delete PHP MySQL</title>
        <link rel="stylesheet" type="text/css" href="style.css">
      
        <link rel="stylesheet" href="fontawesome/css/all.css" />
    </head>
    <body>
    <?php include ('includes/nav.php'); ?>
    <div class="msg-action">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="msg">
                <span style="color:black;">Information</span><br /><br />
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
                <span id="close" class="close">Ok </span>
            </div>
        <?php endif ?>
    </div>  
        
        <form method="post" action="server.php" >
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="Email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
                <label>Fullname</label>
                <input type="fullname" name="fullname" required placeholder="Fullname" value="<?php echo $fullname; ?>">
            </div>
            <?php if ($update == true): ?>
                <button class="btn" type="submit" name="update" title="updare" style="background: rgb(26,132,57); opacity:.8;" >Update</button>
            <?php else: ?>
                <button class="btn" type="submit" name="save" title="save" >Save</button>
            <?php endif ?>
        </form>
        <form method="post" action="index.php">
            <div class="input-group">
                <input type="text" name="valueToSearch" placeholder="Value To Search" style="width:40%; float:left; border-right:0px;" >
            </div>
            <button class="btn" type="submit" name="search" title="search" style="background: rgb(0, 153, 204); margin-left:-2px;"  ><i class="fas fa-search" style="font-size:17px;"></i></button><button class="btn" id="refresh" type="submit"  onClick="refreshPage()" title="Refresh"><i class="fas fa-sync" ></i></button><label style="margin-left:10px;color: gray;" ><b><?php $row = mysqli_num_rows($search_result); echo("Number of data : " ."(" . $row . ")");?></b></label><br><br />

            <div class="table" id="style-2">
                <table>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>FullName</th>
                        <th colspan="2">Action</th>
                    </tr>
                    <?php while($row = mysqli_fetch_array($search_result)) { ?>
                    <tr>
                        <td><?php echo $row['username'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['fullname'];?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" title="Edit" class="edit_btn"><i class="far fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="server.php?del=<?php echo $row['id']; ?>" title="Delete" onclick="return deleletconfig()" class="del_btn" ><i class="far fa-trash-alt" ></i></a>
                        </td>
                    </tr>

                    <?php }?>
                    
                </table>
            </div>
        </form>
    </body>
    <script>
        function deleletconfig(){
            var del=confirm("Are you sure you want to delete this record?");
            return del;
        }
    </script>
    <script>
        function refreshPage(){
            window.location.reload();
        } 
    </script>
    <script>
        var closebtns = document.getElementsByClassName("close");
        var i;
        for (i = 0; i < closebtns.length; i++) {
          closebtns[i].addEventListener("click", function() {
            this.parentElement.style.display = 'none';
          });
        }
    </script>
</html>