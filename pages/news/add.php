
<?php

$categories = getAll("SELECT * FROM categories");

// insert
if(isset($_POST['action']) && $_POST['action'] == 'insert') {

    $file_name = '';

    if($_FILES['image']['size']) {

        $path = 'uploads';

        if(!is_dir($path)) {
            mkdir($path);
        }

        $name = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        $file_name = time() . '-' . pathinfo($name, PATHINFO_BASENAME);  // image_test.jpg

        $upload_file_path = $path . '/' . $file_name;

        move_uploaded_file($tmp, $upload_file_path);

    }
    

    $title = isset($_POST['title']) ? $_POST['title'] : '' ;
    $text = isset($_POST['text']) ? $_POST['text'] : '' ;
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '' ;

    if($title && $text && $category_id) {

        $sql = "INSERT INTO news (title, text, category_id, image) 
                     VALUES ('$title', '$text', '$category_id', '$file_name')";

        if(mysqli_query($conn, $sql)) {
            echo "Record Created";
        } else {
            echo "Error";
        }
    }
}

?>

<main>
<div class="container-header">
    <h2>News</h2>
    <a href="" class="btn">Add New</a>
</div>
<div class="content">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title">
        </div>
        <div class="form-group">
            <label for="">Text</label>
            <textarea name="text" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="">Category</label>
            <select name="category_id" id="">
                <?php foreach($categories as $value): ?>
                <option value="<?= $value['id'] ?>"><?= $value['title'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="file" name="image">
        </div>
        <div class="form-group">
            <input type="hidden" name="action" value="insert">
            <button class="btn submit">Add</button>
        </div>
    </form>
</div>
</main>