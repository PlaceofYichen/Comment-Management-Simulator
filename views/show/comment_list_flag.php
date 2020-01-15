<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Comment List</title>
</head>
<body>
<?php include('tmpl/header.php'); ?> 

<a href="javascript:history.go(-1);">back</a>
<!--content-->
<table border="1">
    <tr>
        <th></th>
        <th>UserName</th>
        <th>Content</th>
        <th>Public Date</th>
        <th>Is Flag</th>
        <th>Derogatory</th>
    </tr>
    <?php $index = 1;foreach ($data['list'] as $key => $row):?>
    <tr>
        <td><?=$index ?></td>
        <td><?=$row['username'];?></td>
        <td><?=$row['content'];?></td>
        <td><?=$row['publication_date'];?></td>
        <td><?=$row['is_flag']==0?'':'YES';?></td>
        <td>
            <a href="javascript:;" onclick="derogatory(<?=$row['id']?>,'YES');">YES</a> / <a href="javascript:;" onclick="derogatory(<?=$row['id']?>,'NO');">NO</a>
        </td>
    </tr>
    <?php $index++; endforeach;?>
</table>

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>

<script>
    function derogatory(id,status) {
        let data = {};
        data["id"] = id;
        data['status'] = status;
        data["submit"] = true;

        $.ajax({
            type: 'POST',
            url: 'index.php?c=comment&a=derogatory',
            data: data,
            success: function (json) {
                location.reload(true);
            }
        });
    }
</script>
</body>
</html>