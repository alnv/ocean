<?php namespace Ocean; ?>
<!DOCTYPE html>
<html>

	<head>
	    <meta charset="UTF-8">
	    <title>Ocean</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1" />
	    <style>
	    	body{
	    		font-family: "Lucida Console", Monaco, monospace;
	    		color: #3D3D3D;
	    		font-size: 16px;
	    		background: #FFFFFA;
	    		line-height: 1.7;
	    	}
	    	.wrapper{
	    		width: 90%;
	    		max-width: 520px;
	    	}
	    	a{
	    		color: #2BAB15;
	    		text-decoration: none;
	    	}
	    	h1{
	    		font-size: 24px;
	    	}

	    	input,
	    	textarea{
	    		font-family: "Lucida Console", Monaco, monospace;
	    		font-size: 16px;
	    		width: 100%;
	    		-webkit-box-sizing: border-box;
	    		-moz-box-sizing: border-box;
	    		box-sizing: border-box;
	    		padding: 10px;
	    		margin: 0;
	    		outline-color: #2BAB15;
	    		margin-bottom: 10px;
	    		border: 1px solid #dedede;
	    	}
	    	textarea{
	    		resize: none;
	    	}
	    	input.submit{
	    		background: #2BAB15;
	    		color: #fff;
	    		border: 0;
	    		cursor: pointer;
	    	}

	    	.user-form input{
	    		padding: 0;
	    		margin: 0;
	    		line-height: 1;
	    		background: 0;
	    		color: #2BAB15;
	    		border: 0;
	    		cursor: pointer;
	    		text-align: left;
	    		outline: none;
	    	}
	    	.user-form form{
	    		width: auto;
	    		float: left;
	    		margin-right: 10px;
	    	}

	    	.user-container{
	    		margin-top: 25px;
	    	}

	    	.user{
	    		margin-bottom: 15px;
	    		background: #fff;
	    		border: 1px solid #dedede;
	    		padding: 10px;
	    		overflow: hidden;
	    	}

	    	.user-container h2{
	    		font-size: 18px;
	    		margin-bottom: 5px;
	    		margin-top: 0;
	    		width: auto;
	    		display: inline-block;
	    	}

	    	.user-container p{
	    		margin-top: 0;
	    		margin-bottom: 5px;
	    		width: auto;
	    		display: inline-block;
	    	}

	    	@media only all and (min-width: 768px) {
	    		h1{
	    			font-size: 28px;
	    		}
	    	}
	    </style>
	</head>
	
	<body>
		<div class="wrapper">
			<h1>Gästebuch</h1>
			<p>Hinterlasse eine Nachricht</p>
			<?php include 'views/form/createUser.php'; ?>
			<a href="/">@zurück</a>
			<div class="user-container">
					<?php foreach($users as $user): ?>
				<div class="user">
					<div class="user-description">
						<h2><a href="user/<?php echo $user['id']; ?>">@<?php echo $user['username']; ?>:</a></h2>
						<p><?php echo $user['message']; ?></p>
					</div>
					<div class="user-form">
						<!-- delete form -->
						<form method="post" action="user/<?php echo $user['id'] ?>">
							<input type="hidden" name="_method" value="delete"/>
							<input type="submit" value="@Löschen">
						</form>
					</div>
				</div>	
				<?php endforeach; ?>
			</div>

		</div>		
	</body>
	
</html>
