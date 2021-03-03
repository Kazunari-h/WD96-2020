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

print '<a href="shop_cartlook.php">カートを見る</a><br />';

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

		<?php print '商品一覧<br /><br />';?>
		<section> 
<?php
try
{

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name,price,gazou FROM mst_product WHERE 1';
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
	
	print '<a href="shop_product.php?procode='.$rec['code'].'"><img src="../product/gazou/'.$rec['gazou'].'"></a>';
	print $rec['name'].' ___  ';
	print $rec['price'].'円';
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
			</div>
		</wrapper>
	</main>
</body>
</html>