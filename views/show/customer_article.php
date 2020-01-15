<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Article List</title>
</head>
<body>
<?php include('tmpl/header.php'); ?> 
<br>
<a href="index.php?c=article&a=add">Add article</a>
<!--content-->
<table border="1">
    <tr>
        <th></th>
        <th>Title</th>
        <th>Topic</th>
        <th>Public Date</th>
        <th>Open For Comment</th>
        <th>Comment List</th>
    </tr>
    <?php $index = 1;foreach ($data['list'] as $key => $row):?>
    <tr>
        <td><?=$index ?></td>
        <td><?=$row['title'];?></td>
        <td><?=$row['topic'];?></td>
        <td><?=$row['publication_date'];?></td>
        <td>
            <?php if($row['open_comment']==0) {?>
                <a href="javascript:;" onclick="openComment(<?=$row['id'];?>)">Open</a>
            <?php } ?>
        </td>
        <td>
            <?php if($row['open_comment']==1) {?>
                <a href="index.php?c=article&a=comments&article_id=<?=$row['id'];?>")">Check</a>
            <?php } ?>
        </td>
    </tr>
        <?php $index++; endforeach;?>
</table>

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>

<script>
function openComment(id) {
    let data = {};
    data["id"] = id;
    data["submit"] = true;

    $.ajax({
        type: 'POST',
        url: 'index.php?c=article&a=open',
        data: data,
        success: function (json) {
            location.reload(true);
        }
    });
}
</script>

</body>
</html>