<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Article Add</title>
</head>
<body>
<?php include('tmpl/header.php'); ?> 

<a href="javascript:history.go(-1);">back</a><br><br>
<!--content-->
title:<input id="txt_title" type="text"><br>
topic:<input id="txt_topic" type="text"><br>
open comment:
<select id="sel_comment">
    <option value="1">YES</option>
    <option value="0">NO</option>
</select><br>
<a href="javascript:;" onclick="add()">submit</a>

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>

<script>
function add() {
    let data = {};
    data["title"] = $("#txt_title").val();
    data["topic"] = $("#txt_topic").val();
    data["open_comment"] = $("#sel_comment").val();
    data["submit"] = true;

    $.ajax({
        type: 'POST',
        url: 'index.php?c=article&a=add',
        data: data,
        success: function (json) {
            window.location.href="index.php?c=customer&a=articles";
        }
    });
}
</script>

</body>
</html>