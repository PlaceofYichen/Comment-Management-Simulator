<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Statistic List</title>
</head>
<body>
<?php include('tmpl/header.php'); ?>
<a href="javascript:history.go(-1);">back</a>
<!--content-->

<br><br>
The top-20 users by the number of coments they post
<table border="1">
    <tr>
        <th>UserName</th>
        <th>Count</th>
    </tr>
    <?php $index = 1;foreach ($data['list_1'] as $key => $row):?>
    <tr>
        <!--<td><?=$row['id'];?></td>-->
        <td><?=$row['name'];?></td>
        <td><?=$row['count'];?></td>
    </tr>
    <?php $index++; endforeach;?>
</table>

<br><br>
The top-20 users by the number of replies they post
<table border="1">
    <tr>
        <th>UserName</th>
        <th>Count</th>
    </tr>
    <?php $index = 1;foreach ($data['list_2'] as $key => $row):?>
        <tr>
            <!--<td><?=$row['id'];?></td>-->
            <td><?=$row['name'];?></td>
            <td><?=$row['count'];?></td>
        </tr>
        <?php $index++; endforeach;?>
</table>

<br><br>
The top-20 users by the number of like/dislike they post
<table border="1">
    <tr>
        <th>UserName</th>
        <th>Count</th>
    </tr>
    <?php $index = 1;foreach ($data['list_3'] as $key => $row):?>
        <tr>
            <td><?=$row['name'];?></td>
            <td><?=$row['count'];?></td>
        </tr>
        <?php $index++; endforeach;?>
</table>

<br><br>
The top-10 websites with the most requests for article comments
<table border="1">
    <tr>
        <th>Customer/Website</th>
        <th>Count</th>
    </tr>
    <?php $index = 1;foreach ($data['list_4'] as $key => $row):?>
        <tr>
            <td><?=$row['name'];?></td>
            <td><?=$row['count'];?></td>
        </tr>
        <?php $index++; endforeach;?>
</table>

<br><br>
The top-10 websites with the most sales this week
<table border="1">
    <tr>
        <th>Customer/Website</th>
        <th>Count</th>
    </tr>
    <?php $index = 1;foreach ($data['list_5'] as $key => $row):?>
        <tr>
            <td><?=$row['name'];?></td>
            <td><?=$row['count'];?></td>
        </tr>
        <?php $index++; endforeach;?>
</table>

<br><br>
The top-10 websites with the most sales this month
<table border="1">
    <tr>
        <th>Customer/Website</th>
        <th>Count</th>
    </tr>
    <?php $index = 1;foreach ($data['list_6'] as $key => $row):?>
        <tr>
            <td><?=$row['name'];?></td>
            <td><?=$row['count'];?></td>
        </tr>
        <?php $index++; endforeach;?>
</table>

<br><br>
The top-10 websites with the most sales this year
<table border="1">
    <tr>
        <th>Customer/Website</th>
        <th>Count</th>
    </tr>
    <?php $index = 1;foreach ($data['list_7'] as $key => $row):?>
        <tr>
            <td><?=$row['name'];?></td>
            <td><?=$row['count'];?></td>
        </tr>
        <?php $index++; endforeach;?>
</table>

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>

</body>
</html>