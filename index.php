<?php include 'inc/header.php'; ?>
<?php 
	include 'lib/config.php';
	include 'lib/Database.php';
	$db = new Database();
 ?>

	<section class="mainoption">
		<div class="myform">
			<?php 
				$file_name = '';
				if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
					if (isset($_FILES['image']['name'])) {
						$permitted = array('jpg','png','jpeg', 'gif');
						$file_name = $_FILES['image']['name'];
						$file_size = $_FILES['image']['size'];
						$file_tmp  = $_FILES['image']['tmp_name'];

						$div = explode('.', $file_name);
						$file_ext = strtolower(end($div));
						$unique_image = substr(md5(time()), 0, 15).'.'.$file_ext;
						$uploaded_image = 'uploads/'.$unique_image;

						if (empty($_FILES['image']['name'])) {
							echo "<script>alert('Please choose any image!')</script>";
						}elseif($file_size > 1048567){
							echo "<script>alert('Image size should be less that 1 MB')</script>";
						}elseif(in_array($file_ext, $permitted) === false){
							echo "<script>alert('Your file should be jpg,png,gif,jpeg');</script>";
						}else{
							$query = "INSERT INTO tbl_image (img) VALUES ('$uploaded_image')";
							$inserted_rows = $db->insert($query);
							if ($inserted_rows) {
								move_uploaded_file($file_tmp, $uploaded_image);
								echo "<script>alert('Image Inserted successfully!')</script>";
							}else{
								echo "<script>alert('Image Uploading failed!')</script>";
							}
						}
					}
				}

			 ?>
			<form action="" method="POST" enctype="multipart/form-data">
				<label>Select Image</label>
				<input type="file"  name="image" >
				<input type="submit" value="Upload Image" name="">
			</form>
			<?php 

				// Select image from database
				$query = "SELECT * FROM tbl_image";
				$result = $db->select($query);

				// Delete image from database and from root folder
				if (isset($_GET['del'])) {
					$id = $_GET['del'];
					$unlink_query = "SELECT * FROM tbl_image WHERE id='$id'";
					$getImg = $db->select($unlink_query);
					$query = "DELETE FROM tbl_image WHERE id='$id'";
					$result = $db->delete($query);
					if ($result) {
						$row = $getImg->fetch_assoc();
						unlink($row['img']);
						header('location:index.php');
					}
				}

			 ?>

			 <div class="img_wrapper">
			 	<?php
			 		if ($result) {
			 		 	while ($row = $result->fetch_assoc()) { ?>
						<a href="?del=<?= $row['id']; ?>">
							<img width="100px" style="max-height: 100px;object-fit: cover;margin: 0 10px;" src="<?= $row['img']; ?>">
						</a>
					<?php }?>
				<?php }?>
			 		  
			 		
			 </div>
		</div>
	</section>

<?php include 'inc/footer.php'; ?>