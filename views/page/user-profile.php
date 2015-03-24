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
	    		max-width: 480px;
	    	}
	    	a{
	    		color: #2BAB15;
	    		text-decoration: none;
	    	}
	    	h1{
	    		font-size: 24px;
	    	}
	    	.user-update-form{
	    		margin-top: 20px;
	    	}
	    	.user-update-form h2{
	    		font-size: 20px;
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

	    	@media only all and (min-width: 768px) {
	    		h1{
	    			font-size: 28px;
	    		}
	    	}

	    </style>
	</head>
	
	<body>
		<div class="wrapper">
			<h1>Hallo <?php echo $currentUser['username']; ?>!</h1>
			<p><?php echo $currentUser['message']; ?></p>
			<a href="/user">@zurück</a>
			<div class="user-update-form">
				<h2>Benutzer Bearbeiten</h2>
				<?php include 'views/form/updateUser.php'; ?>
			</div>
		</div>
	</body>
	
</html>
