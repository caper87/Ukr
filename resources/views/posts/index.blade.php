@extends('app')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Posts  &nbsp;&nbsp; </div>
				
				<div class="panel-body">
					
					<div>
						
							
							
					</div>
					@foreach ($posts as $post)
						<article>
							<div class="post_thumb col-md-3">
								<img width=150 src="{{ $post->img }}" alt="" />
							</div>
							<div class="post_intro col-md-9">
								<h2>{{ $post->title }}</h2>
								<b>{{ $post->intro }}</b>
								<p>{{ $post->created_at }}</p>
								<a href="posts/{{ $post->id }}">Читать далее</a>
							</div>
							<div class="cl"></div>
						</article>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
