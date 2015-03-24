<form method="post" action="/user/<?php echo $currentUser['id'] ?>" enctype="multipart/form-data">

	<input type="hidden" name="_method" value="put"/>

	<input type="text" name="username" placeholder="Username" value="<?php echo $currentUser['username']; ?>">

	<textarea name="message" placeholder="Nachricht"><?php echo $currentUser['message']; ?></textarea>

	<input type="submit" value="Send" class="submit">

</form>