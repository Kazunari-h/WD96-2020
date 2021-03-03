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
	print 'ようこそ ';
	print $_SESSION['member_name'];
	print ' 様　';
	print '<a href="member_logout.php">ログアウト</a><br />';
	print '<br />';
	
}
print '<div class="home"><p><a href="../online-shop.html"><svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#77110d" class="bi bi-house-door-fill" viewBox="0 0 16 16">
  <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
	</svg></a></p></div>';


print '<div class="cart"><a href="shop_cartlook.php"><svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#77110d" class="bi bi-cart3" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></a></div>
	

<br />';

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="shop_list.css">
<title>Grand Maison Tokyo</title>
</head>
<body>
	<main>
		<wrapper>
		

		<?php print '<div class="product-list">商品一覧</div><br /><br />';?>
		<section> 
<?php
$number = 'price';
try
{

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,gazou,description FROM mst_product WHERE 1';
$stmt=$dbh->prepare($sql);
$stmt->execute();

$dbh=null;



while(true)
{
	$rec=$stmt->fetch(PDO::FETCH_ASSOC);
	
	if($rec==false)
	{
		break;
	}
	/*print '<a href=".php?procode='.$rec['code'].'">';*/
	
	print '<div class="product"><a href="shop_product.php?procode='.$rec['code'].'"><img src="../product/gazou/'.$rec['gazou'].'"></a></div>';
	print '<div class="product-name">'.$rec['name'].'</div>';
	/*$number = 'price'*/
	print '<div class="price">'.number_format($rec['price']).'</div>'.'<div class="yen">'.'円'.'</div>';
	print '<div class="description"><p>'.$rec['description'].'</p></div>';
	/*print '</a>';*/
	print '<br />';
}

print '<br />';



}
catch (Exception $e)
{
	 print 'ただいま障害により大変ご迷惑をお掛けしております。';
	 exit();
}

?>
			</section>
		</wrapper>
	</main>
</body>
</html>