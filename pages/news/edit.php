
<?php

$id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null; 

if($id) {
    // select
    $news = getFirst("SELECT * FROM news WHERE id = " . $id);

    if(!$news) {
        die('news not found');
    }
} else {
    die('invalid id');
}

$categories = getAll("SELECT * FROM categories");

// update
if(isset($_POST['action']) && $_POST['action'] == 'update') {
    $title = isset($_POST['title']) ? $_POST['title'] : '' ;
    $text = isset($_POST['text']) ? $_POST['text'] : '' ;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '' ;

    if($title && $text && $category_id) {

        $sql = "UPDATE news SET title = '$title', text = '$text', category_id = '$category_id' WHERE id = ".$id;
        echo query($sql) ? "Record Update" : "Error" ;
    }
}

?>

<main>
<div class="container-header">
    <h2>News</h2>
    <a href="index.php" class="btn">Back</a>
</div>
<div class="content">
    <form action="" method="post">
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" value="<?= $news['title'] ?>">
        </div>
        <div class="form-group">
            <label for="">Text</label>
            <textarea name="text" id="" cols="30" rows="10"><?= $news['text'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="">Category</label>
            <select name="category_id" id="">
                <?php foreach($categories as $value): ?>
                <option value="<?= $value['id'] ?>" <?= $value['id'] == $news['category_id'] ? 'selected' : '' ?>><?= $value['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" name="action" value="update">
            <button class="btn submit">Updates</button>
        </div>
    </form>
</div>
</main>