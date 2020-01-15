<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Comment Add</title>
</head>
<body>
<?php include('tmpl/header.php'); ?> 

<a href="javascript:history.go(-1);">back</a>
<!--content-->
content:<textarea id="txt_content"></textarea>
<a href="javascript:;" onclick="add()">submit</a>

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>

<script>
function add() {
    let data = {};
    data["article_id"] = <?=$data['article_id']?>;
    data["parent_id"] = <?=$data['parent_id']?>;
    data["content"] = $("#txt_content").val();
    data["submit"] = true;

    $.ajax({
        type: 'POST',
        url: 'index.php?c=comment&a=add',
        data: data,
        success: function (json) {
            window.location.href="index.php?c=article&a=comments_user&article_id=<?=$data['article_id']?>";
        }
    });
}
</script>

</body>
</html>