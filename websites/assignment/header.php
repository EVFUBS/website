<?php session_start(); $sidebarNeeded = false; ?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title><?php echo $title;  ?></title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Latest Articles</a></li>
				<li><a href="#">Select Category</a>
					<ul>
						<?php
							$server = 'mysql';
							$username = 'student';
							$password = 'student';
							$schema = 'assignment1';
							$pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password);

							$catergories = $pdo -> prepare('SELECT * FROM catergory');
							$catergories->execute();

							while($x = $catergories -> fetch()){
								echo '<li><a class="articleLink" href="index.php?catergoryId='. $x['catergoryId'] .'">'. $x['name'] .'</a></li>';
							}
						?>
					</ul>
				</li>
				<?php
					if(isset($_SESSION['loggedIn'])){
						$isAdmin = $pdo -> prepare('SELECT * FROM login WHERE loginId = :loginId');
						$val = [
							'loginId' => $_SESSION['loggedIn']
						];
						$isAdmin -> execute($val);
						$admin = $isAdmin -> fetch();

						if($admin['admin'] == 1){
							echo '<li><a href="#">Admin</a>;';
							echo '<ul>';
							echo '<li><a class="articleLink" href="adminArticles.php">Article Admin</a></li>';
							echo '<li><a class="articleLink" href="adminCatergories.php">Catergories Admin</a></li>';
							echo '<li><a class="articleLink" href="manageAdmins.php">Manage Admins</a></li>';
							echo '</ul>';
							echo '</li>';
						}	
					}
				?>
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />
		<main>