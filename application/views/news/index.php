<h1>Все новости</h1>

<p><a href="create">добавить новость</a></p><br>

<?php foreach ($news as $key => $value): ?>
	<p><a href="view/<?php echo $value['slug']; ?>"><?php echo $value['title']; ?></a> | <a href="edit/<?php echo $value['slug']; ?>">edit</a> | <a href="delete/<?php echo $value['slug']; ?>">Х</a></p>
<?php endforeach ?>