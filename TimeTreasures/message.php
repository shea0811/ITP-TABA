<?php
if (isset($_GET['status'])) {
    $color = $_GET['status'];
    $message = $_GET['message'];
?>
    <div id="show-message-id" class="alert alert-<?= $color; ?>">

        <?= $message; ?>
    </div>
<?php
}
?>

<script>
    let el = document.querySelector("#show-message-id");
    if (el) {
        setTimeout(function() {
            el.remove();
        }, 3000)
    }
</script>