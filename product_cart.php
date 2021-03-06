<?php
	session_start();
	require("connect.php");
	$username = $_SESSION['username'];
	$name = $_SESSION['email'];
	if(!$username)
	{	
		echo "Section has expired";
		header("Location: index.php");
		exit;
	}
	if(isset($_GET['page']))
	{
		$pages = array("products","cart");
		if(in_array($_GET['page'],$pages))
		{
			$_page = $_GET['page'];
			
		}
		else
		{
			$_page = "products";
		}
	}
	else
	{
		$_page = "products";	
	}
?>
<html>
<head>
	<link href="js/bootstrap.min.js" rel="stylesheet">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href = "style.css"/>
	<title>Shopping Cart</title>
</head>
<body>
	<table width="1030" align="center" border="1" height="450">
  <tr>
    <td colspan="2"><?php require('header.php');?></td>
    </tr>
  <tr>
    <td colspan="2" bgcolor="#FFCC33" align="center">Welcome <?php $username;?> <a href="logout.php"> | Logout</a></td>
    </tr>
  <tr>
    <td width="17" bgcolor="#FFCC33"><?php require('sideBar2.php'); ?>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
   <br/>
    </td>
    <td width="900">
    <div id = "container">
        <div id="main">
        
        	<?php require($_page.".php"); ?>
            
      </div><!--end of main-->
        
        <div id="sideBar" style="padding:5px 1px 35px 35px">
        <h1>Items added to Cart</h1>
        <?php	
           if(isset($_SESSION['cart']))
		   {
				$sql = "SELECT * FROM products WHERE pro_id IN(";
				foreach($_SESSION['cart'] as $id => $value)
		   		{
					$sql.=$id.",";
				}
				$sql = substr($sql, 0, -1).") ORDER BY pro_name ASC";
				$query = mysql_query($sql);
				
				while($row = mysql_fetch_array($query))
				{
					?>
                    
                    <p><?php echo $row['pro_name'] ?> x <?php echo $_SESSION['cart'][$row['pro_id']]['quantity']; ?></p>
                    
                   <?php
					
				}
				
				?>
                <hr color="#000000"/>
                <a href="product_cart.php?page=cart" class='form-1 btn btn-success'>Go insert to cart</a>
                
                <?php
		   }
		   else
		   {
			   echo 'The are no items in your cart. Please insert some items.';
		   }
        ?>
        </div>
</div></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFCC33"><?php require('footer.php'); ?></td>
    </tr>
</table>

</body>
</html>