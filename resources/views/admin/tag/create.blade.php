@extends('app')
@section('content')

        <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Add Post
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="container-fluid">
	 <div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Добавить Тег</div>
				@include('layout.admin_menu')
				<div class="panel-body admin_content col-md-9">
										
					{!! Form::open(['route' => 'admin.tag.store']) !!} 

					<div class="form-group">
					{!! Form::label('Название тега') !!}
					{!! Form::text('tag_name',null,['class' => 'form-control']) !!}
					</div>

					<div class="form-group">
						
						{!! Form::submit('Добавить', ['class' => 'form-submit']) !!}
					</div>
					{!! Form::close() !!}

					
				</div>
				<div  class="cl" ></div>
			</div>
		</div>
	 </div>
	</div>
</section>

@stop
























