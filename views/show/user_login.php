<!DOCTYPE html>
<html>
<head>
<?php include('tmpl/head.php'); ?>   
<title>Login</title>
</head>
<body>
<?php include('tmpl/header.php'); ?> 

<div class="account">
	<div class="container">
		<h1>Account</h1>
		<div class="account_grid">
			   <div class="col-md-6 login-right">
					<span>UserName</span>
					<input id="txt_uname" name="txt_uname" type="text"> 
				
					<span>Password</span>
					<input id="txt_pwd" name="txt_pwd" type="password"> 
					<div class="word-in">
				 		 <input id="btn_sub" type="button" value="log in">
				  	</div>
			   </div>
			 </div>
	</div>
</div>

<?php include('tmpl/footer.php'); ?>
<?php include('tmpl/foot.php'); ?>
<script src="<?=CommonRoot;?>jquery.validate.min.js"></script>
<script src="<?=CommonRoot;?>additional-methods.js"></script>

<script>

$("#btn_sub").click(function()
{
	var n = $("#txt_uname").val();
    var p = $("#txt_pwd").val();
    if(n == '' || p == '')
    {
        alert_msg("username and password should not be empty");
    }
    else
    {
      var data = {};
      data["n"] = n;
      data["p"] = p;
      data["submit"] = true;

      $.ajax({
        type: 'POST',
        url: 'index.php?c=user&a=login',
        data: data,
        success:function(json){
          if(json > 0)
          {
            alert_jump('successful', "index.php?c=user&a=index");
          }
          else{
            alert_msg("fail, check ur account and password");
          }
        }
      });
      
    }
});

</script>

</body>
</html>