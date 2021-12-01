<?php

$orderBy = 'ORDER BY news.id DESC';
$limit = 3;

if(isset($_GET['sort']) && $_GET['sort']) {
    $sort = explode('-', $_GET['sort']); // [ 0 => 'id', 1 => 'asc'];
    if($sort[0] == 'id') {
        $orderBy = 'ORDER BY news.id';
    } elseif($sort[0] == 'title') {
        $orderBy = 'ORDER BY news.title';
    }

    $orderBy .= ' ' . $sort[1];
}

$offset = '';
if(isset($_GET['p']) && $_GET['p'] && $_GET['p'] > 1) {
    $offset = ' OFFSET ' . ($_GET['p'] - 1) * $limit;
}


$count = getFirst("SELECT COUNT(*) as cnt FROM news");

$pageNumber = ceil($count['cnt'] / $limit);


// SELECT Query
$sql = "SELECT news.id as news_id, news.title as news_title, news.text, news.category_id, categories.id as cat_id, categories.title as category_title
          FROM news
    LEFT JOIN categories ON news.category_id = categories.id ". $orderBy . ' LIMIT ' . $limit .' '. $offset;
$news = getAll($sql);

?>

<main>
    <div class="container-header">
        <h2>News</h2>
        <a href="<?= '?' . $_SERVER['QUERY_STRING'] . '&action=add' ?>" class="btn">Add New</a>
    </div>
    <form action="" class="sort">
            <select name="sort" id="">
                <option value="id-desc">ID DESC</option>
                <option value="id-asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'id-asc' ? 'selected' : '' ?>>ID ASC</option>
                <option value="title-desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'title-desc' ? 'selected' : '' ?>>Title DESC</option>
                <option value="title-asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'title-asc' ? 'selected' : '' ?>>Title ASC</option>
            </select>
            <button class="btn">Sort</button>
        </form>
    <div class="content">
        
        <table>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Text</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            <?php foreach($news as $value): ?>
                <tr>
                    <td><?= $value['news_id'] ?></td>
                    <td><?= $value['news_title'] ?></td>
                    <td class="tb-text"><?= substr($value['text'], 0, 200) . '...' ?></td>
                    <td><?= $value['category_title'] ?></td>
                    <td class="actions">
                        <a class="edit" href="<?= '?' . $_SERVER['QUERY_STRING'] . '&action=edit&id='.$value['news_id'] ?>">Edit</a>
                        <form action="" method="post">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $value['news_id'] ?>">
                            <button class="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
    </div>

    <div class="paging">
        <?php for($i = 1; $i <= $pageNumber; $i++): ?>

            <a href="?<?= $_SERVER['QUERY_STRING'] ?>&p=<?= $i ?>" class="btn"><?= $i ?></a>

        <?php endfor; ?>
    </div>

</main>