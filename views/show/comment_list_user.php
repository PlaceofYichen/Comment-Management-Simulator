<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Comment List</title>
</head>
<body>
<?php include('tmpl/header.php'); ?>

<a href="index.php?c=user&a=index">back</a>
<a href="index.php?c=comment&a=add&article_id=<?=$data['article_id']?>">add comment</a>

<?php if($data['show_flag']){ ?>
    <a href="index.php?c=comment&a=flag_list&article_id=<?=$data['article_id']?>">check flag comments</a>
<?php }?>

<!--content-->
<table border="1">
    <tr>
        <th></th>
        <th>UserName</th>
        <th>Content</th>
        <th>I like?</th>
        <th>Public Date</th>
        <th></th>
    </tr>
    <?php $index = 1;foreach ($data['list'] as $key => $row):?>
    <tr>
        <td><?=$index ?></td>
        <td><?=$row['username'];?></td>
        <td><?=$row['content'];?></td>
        <th>
            <?php if(empty($row['like'])) {?>
            <a href="javascript:;" onclick="like(<?=$row['id']?>,'like');">like</a> / <a href="javascript:;" onclick="like(<?=$row['id']?>,'dislike');">dislike</a>
            <?php } if(!empty($row['like'])) echo $row['like'];?>

        </th>
        <td><?=$row['publication_date'];?></td>
        <td><a href="index.php?c=comment&a=add&article_id=<?=$data['article_id']?>&parent_id=<?=$row['id']?>">Reply</a></td>
    </tr>
    <?php $index++; endforeach;?>
</table>

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>

<script>
function like(id,status) {
    let data = {};
    data["comment_id"] = id;
    data['status'] = status;
    data["submit"] = true;

    $.ajax({
        type: 'POST',
        url: 'index.php?c=commentlike&a=add',
        data: data,
        success: function (json) {
            location.reload(true);
        }
    });
}
</script>

</body>
</html>