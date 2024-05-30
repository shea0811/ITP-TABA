<?php
if(!isset($_SESSION['id'])){
	header('location:index.php?status=danger&message='.urlencode('You Must login first'));
}
?>