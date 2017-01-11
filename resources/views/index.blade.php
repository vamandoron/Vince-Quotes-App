@extends('layouts.main')
@section('title')
	Trending Quotes
@endsection
@section('styles')
@endsection
@section('content')
@if(!empty(Request::segment(1)))
<div class = "filter-bar">
	A filter has been set!</br> <a href ="{{route('index2')}}">Show All quotes </a>
</div>
@endif
@if(count($errors) > 0)
	<section class="info-box fail">
	@foreach($errors->all() as $error)
	{{$error }}
	@endforeach
	</section>

@endif

@if(Session::has('success'))
<section class="info-box success" >
	{{Session::get('success')}}
</section>
@endif
	<section class="quotes">

	 <h1>Latest Quotes</h1>
	 @for($x=0; $x<count($quotes); $x++)
	 <article class="quote"{{$x % 3 === 0 ? '.first-in-line': ($x+1) === 0 ? '.last-in-line': ''}}>
	 	<div class="delete"> <a href="{{ route('delete', [
	 	'quote_id' => $quotes[$x]->id
	 	])}}">X</a></div>
	 	{{$quotes[$x]->quote}}
	 	{{$name = $quotes[$x]->author->name}} 
	 	<div class ="info">Created by <a href="{{ route('index',['author' => $name]) }}">{{$quotes[$x]->author->name }}</a> on {{$quotes[$x]->created_at }}</div>
	 </article>
	 @endfor
	 
	</section>

	@if($quotes->hasPages() && $quotes->currentPage() != $quotes->lastPage())
		<a href="{{ $quotes->nextPageUrl() }}">  <div class="box"> > </div>  </a>
	@endif
	@if($quotes->currentPage() !== 1)
	<a href="{{ $quotes->previousPageUrl() }}">  <div class="box-next"> < </div>  </a>
	@endif
	
	

	<section class="edit-quote">
	<h1>Add a quote</h1>
	<form method ="post" action="{{route('create')}}">
		<div class="input-group">
			<label for="author">Your Name</label>
			<input type="text" name="author" id="author" placeholder="Your Name"/>
		</div>

		<div class="input-group">
			<label for="email">Your email</label>
			<input type="text" name="email" id="email" placeholder="Your Email"/>
		</div>

		<div class="input-group">
			<label for="quote">Your Quote</label>
			<textarea name="quote" id="quote" rows="5" placeholder="Quote"></textarea>
		</div>
		<button type="submit" class="btn">Submit Quote</button>
		<input type="hidden" name="_token" value="{{ Session::token() }}"/>
	</form>
	</section>

@endsection