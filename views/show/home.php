<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Home</title>
</head>
<body>
<?php include('tmpl/header.php'); ?> 

<!--banner-->
<div class="banner">
	<div class="col-sm-3 banner-mat">
		<div class="pull-left"><img class="img-responsive"	src="<?=showRoot;?>images/2.jpg" alt=""></div>
	</div>
	<div class="col-sm-6 matter-banner">
	 	<div class="slider">
	    	<div class="callbacks_container">
	      		<ul class="rslides" id="slider">
	        		<li>
	          			<img src="<?=showRoot;?>images/1.jpg" alt="">
	       			 </li>	
	      		</ul>
	 	 	</div>
		</div>
	</div>
	<div class="col-sm-3 banner-mat">
		<div class="pull-right"><img class="img-responsive" src="<?=showRoot;?>images/3.jpg" alt=""></div>
	</div>
	<div class="clearfix"> </div>
</div>
<!--//banner-->

<!--content-->
<div class="content">
	<div class="container">
		<div class="content-top">
			<h1>Recent Products</h1>
            <?php foreach ($data['list_pro'] as $key => $row):?>
            
            <?php if($key % 4 == 0) echo '<div class="content-top1">'; ?>		
				<div class="col-md-3 col-md2">
					<div class="col-md1 simpleCart_shelfItem">
						<a href="index.php?c=productshow&a=detail&i=<?=$row['id'];?>">
							<img class="img-responsive" src="<?=imgProduct.smallpic.$row['p_faceimg'];?>" alt="" />
						</a>
						<h3><a href="index.php?c=productshow&a=detail&i=<?=$row['id'];?>"><?=$row['p_name'];?></a></h3>
						<div class="price">
								<h5 class="item_price">$<?=$row['p_price'];?></h5>
								<a href="index.php?c=productshow&a=detail&i=<?=$row['id'];?>" class="item_add">Detail</a>
								<div class="clearfix"> </div>
						</div>
					</div>
				</div>				
				
            <?php if($key % 4 == 3 || $key == count($data['list_pro']) - 1) echo '<div class="clearfix"> </div></div>'; ?>
            <?php endforeach;?>
		</div>
	</div>
</div>
<!--//content-->

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>

</body>
</html>