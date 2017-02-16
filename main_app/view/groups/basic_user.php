<div class="panel">
<center><h3><a href="index.php">Retour accueil</a></h3></center>
<center><h1>Vos images :</h1></center>
 <table class='table table-responsive table-hover lol'>
    <thead>
      <tr class='active'>
        <th>N°</th>
        <th>Fichier</th>
        <th>Action</th>
      </tr>
    </thead><tbody>
<?php
		$x = 0;
                foreach($files as $file)
                        {
        echo '<tr class="active"><td>'.$file['id'].'</td><td><a href="download.php?file='.$file['id'].'">'.$file['name'].'</a></td><td><a href="remove.php?file='.$file['id'].'">Delete</a></td></tr>';
                        $x = $x + 1;
                        }
?>
                </tbody></table>
<div class="container">                <form class="col-lg-12" method="POST" action="upload.php" enctype="multipart/form-data">
 <input type="file" name="file">
                        <span class="input-group-btn"><button class="btn btn-lg btn-primary" id="1" type="submit">Send this file</button></span>
                    </form></div>
</div>
