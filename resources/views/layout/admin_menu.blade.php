<div class="panel-body sitebar col-md-3">
	<p>Рецепты</p>
	<ul>
		<li>{!! link_to_route('admin.posts.index','Все рецепты') !!}</li>	
		<li>{!! link_to_route('admin.posts.create','Добавить рецепт') !!}</li>
		
	</ul>
	
	<p>Теги</p>
	<ul>
		<li>{!! link_to_route('admin.tag.index','Все теги') !!}</li>	
		<li>{!! link_to_route('admin.tag.create','Добавить тег') !!}</li>
		
	</ul>
	
	<p>Категории</p>
	<ul>
		<li>{!! link_to_route('admin.cat.index','Все категории') !!}</li>	
		<li>{!! link_to_route('admin.cat.create','Добавить категорию') !!}</li>
		
	</ul>
	
	
</div>