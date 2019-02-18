<form action="/news/edit/" method="post">
	
	<input type="input" name="slug" value="<?php echo $slug_news; ?>" placeholder="slug"></br>
	<input type="input" name="title" value="<?php echo $title_news; ?>" placeholder="название новости"></br>
	<textarea name="text" placeholder="текст новости"><?php echo $content_news; ?></textarea></br>
	<input type="submit" name="submit" value="Добавить новость">

</form>