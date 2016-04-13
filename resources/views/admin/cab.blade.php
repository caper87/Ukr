@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					ADMIN
				</div>
				@include('layout.admin_menu')
				<div class="panel-body col-md-9">
					Это главная страница админ зоны.
					 Тут мы заебеним разные прикольные фишечки:)
				</div>
				<div  class="cl" ></div>
			</div>
		</div>
	</div>
</div>
@endsection
