<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print 'ようこそゲスト様　';
	print '<a href="member_login.html">会員ログイン</a><br />';
	print '<br />';
}
else
{
	print 'ようこそ';
	print $_SESSION['member_name'];
	print '様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="bootstrap.css" rel="stylesheet" type="test/css">
<link href="shop_product.css" rel="stylesheet" type="text/css">
<title>Grand Maison Tokyo</title>
</head>
<body>
	<main>
		<wrapper>
	

<?php

try
{

$pro_code=$_GET['procode'];

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];

$dbh=null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}


}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

<div class="product-reference">商品情報参照</div><br />
<br />
<div class="product-code">商品コード</div><br />
<?php print $pro_code; ?>
<br />
<div class="product-name">商品名</div><br />
<?php print '<div class="name-of-product">'.$pro_name.'</div>'; ?>
<br />
<div class="price">価格</div><br />
<?php $number = $pro_price;
	  print /*$pro_price*/'<div class="number_format">'.number_format($number).'</div>'; ?><div class="yen">円</div>
<br />
<?php print $disp_gazou; ?>
<br />
<br />
<?php print '<div class="cart-in"><a href="shop_cartin.php?procode='.$pro_code.'">カートに入れる</a></div><br /><br />'; ?>


<div class="btn-secondary" onclick="history.back()"><a href="#">戻る</a></div>

		</wrapper>
	</main>
</body>
</html>