<?php
// Delete Query
if(isset($_POST['action']) && $_POST['action'] == 'delete'){
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if($id) {
        $delete_query = "DELETE FROM categories WHERE id = " .$id;
        echo query($delete_query) ? "Record Deleted" : "Error" ;
    }
}


// SELECT Query
$categories = getAll("SELECT * FROM categories ORDER BY id DESC");

?>

<main>
    <div class="container-header">
        <h2>Categories</h2>
        <a href="<?= '?' . $_SERVER['QUERY_STRING'] . '&action=add' ?>" class="btn">Add New</a>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
            <?php foreach($categories as $value): ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['title'] ?></td>
                    <td class="actions">
                        <a class="edit" href="<?= '?' . $_SERVER['QUERY_STRING'] . '&action=edit&id='.$value['id'] ?>">Edit</a>
                        <form action="" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $value['id'] ?>">
                            <button class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
    </div>
</main>
