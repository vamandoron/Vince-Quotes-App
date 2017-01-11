<?php
namespace App\Http\Controllers;
use App\Author;
use App\quotes;
use \Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;

class QuotesController extends Controller{
	
	public function getIndex($author = null){
		if(!is_null($author)){
			$quote_author = Author::where('name',$author)->first();
			if($quote_author){
				$quotes = $quote_author->quotes()->orderBy('created_at', 'desc')->paginate(6);
			}
		}
		else{
		$quotes=quotes::orderBy('created_at','desc')->paginate(6);
}
		return view('index',['quotes'=>$quotes]);
	}

	public function getDeleteQuote($quote_id){
		  $quote = quotes::find($quote_id);
		  if(count($quote->author->quotes) === 1 ){
		  	$quote->author->delete();
		  	$author_deleted = true;
		  }
		  $quote ->delete();
		  $author_deleted = false;

		  $msg = $author_deleted ?'Quote and author deleted!': 'Quote Deleted';

		  return redirect()->route('index2')->with([
		  	'success' => 'Quote deleted!']);
	}

	public function postQuotes(Request $request ){
		$this->validate($request, [
			'author' => 'required|max:30|alpha',
			'quote' => 'required',
			'email' => 'required|email'
			]);
		$authortext = ucfirst($request['author']);
		$quotetext = $request['quote'];
		$author = Author::where('name',$authortext)->first();
		if(!$author){
			$author = new Author();
			$author->name =$authortext;
			$author->email = $request['email'];
			$author->save();
		}
		$quote = new quotes();
		$quote->quote = $quotetext;
		$author->quotes()->save($quote);

		Event::fire(new QuoteCreated($author));	
		return redirect()->route('index2')->with([
			'success' =>'Quote saved!'
			]);
	}
}
?>