<?php namespace Ocean; ?>
<!DOCTYPE html>
<html>

	<head>
	    <meta charset="UTF-8">
	    <title>Ocean</title>
	</head>
	
	<body>
		<form method="post" action="/user/create">
			<input type="hidden" name="token" value="<?php echo Token::get(); ?>">
			<input type="text" name="username" placeholder="username">
			<input type="text" name="email" placeholder="email">
			<input type="text" name="password" placeholder="password">
			<input type="submit" value="create">
		</form>
		
		<ul>
			<?php foreach($users as $user): ?>
				<li>
					<div>
						<strong>Name:</strong> 
						<a href="/user/<?php echo $user['id']; ?>"><?php echo $user['name']; ?></a>
						<form method="post" action="user/delete/<?php echo $user['id'] ?>">
							<input type="hidden" name="_method" value="delete"/>
							<input type="submit" value="delete"/>
						</form>
						<form method="post" action="user/update/<?php echo $user['id'] ?>">
							<input type="hidden" name="_method" value="put"/>
							<input type="text" name="name" placeholder="name"/>
							<input type="submit" value="update"/>
						</form>
					</div>
				</li>
					
			<?php endforeach;?>
		</ul>
		
	</body>
	
</html>
