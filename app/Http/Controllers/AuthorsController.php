<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class AuthorsController extends Controller
{
    //
    public function index(Request $request)
    {
        $response = session('response');
        if($response) {
            $token = $response['token_key'];

            $authors = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ])
                ->get('https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1');
            $authorList = $authors['items'];
            return view('author')->with('authors', $authorList);
        } else {
            return redirect('/')->withErrors(['msg' => 'Please login']);
        }
    }

    public function author_books(Request $request, $author_id)
    {
        $response = session('response');
        if($response) {
            $token = $response['token_key'];

            $authorBooks = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ])
                ->get('https://symfony-skeleton.q-tests.com/api/v2/authors/' . $author_id );
            return view('author-books')->with('details', $authorBooks);
        } else {
            return redirect('/')->withErrors(['msg' => 'Please login']);
        }
    }

    public function delete_author(Request $request, $author_id)
    {
        $response = session('response');
        if($response) {
            $token = $response['token_key'];

            $res = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ])
                ->delete('https://symfony-skeleton.q-tests.com/api/v2/authors/' . $author_id );
            if(isset($res['exception'])) {
                return Redirect::back()->withErrors(['msg' => $res['message']]);
            } else {
                return redirect('/authors')->withErrors(['msg' => 'Author Delete Successfully']);
            }
        } else {
            return redirect('/')->withErrors(['msg' => 'Please login']);
        }
    }

    public function delete_book(Request $request, $author_id, $book_id)
    {
        $response = session('response');
        if($response) {
            $token = $response['token_key'];

            $res = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ])
                ->delete('https://symfony-skeleton.q-tests.com/api/v2/books/' . $book_id );

            if(isset($res['exception'])) {
                return Redirect::back()->withErrors(['msg' => $res['message']]);
            } else {
                return redirect('authors/books/' . $author_id)->withErrors(['msg' => 'Book Delete Successfully']);
            }
        } else {
            return redirect('/')->withErrors(['msg' => 'Please login']);
        }
    }

    public function create_book(Request $request)
    {
        $response = session('response');
        if($response) {
            $token = $response['token_key'];
            $authors = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                ])
                ->get('https://symfony-skeleton.q-tests.com/api/v2/authors?orderBy=id&direction=ASC&limit=12&page=1');
            
            $authorList = $authors['items'];
            return view('create-book')->with('authors', $authorList);;
        } else {
            return redirect('/')->withErrors(['msg' => 'Please login']);
        }
        
    }

    public function book_create_process(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'release_date' => 'required',
            'description' => 'required',
            'isbn' => 'required',
            'format' => 'required',
            'page' => 'required|numeric',
            'author' => 'required',
        ]);

        if ($validate->fails()) {
            return Redirect::back()->withErrors(['msg' => $validate->errors()]);
        }

        $response = session('response');
        if($response) {
            $token = $response['token_key'];
            $title = $request->title;
            $release_date = $request->release_date;
            $description = $request->description;
            $isbn = $request->isbn;
            $format = $request->format;
            $page = $request->page;
            $author = $request->author;

            $response = Http::withHeaders([
                    'accept' => 'application/json',
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ])
                ->post('https://symfony-skeleton.q-tests.com/api/v2/books', [
                    'author' => [
                        'id' => $author,
                    ],
                    'title' => $title,
                    'release_date' => $release_date,
                    'description' => $description,
                    'isbn' => $isbn,
                    'format' => $format,
                    'number_of_pages' => (int) $page,
                ]
            );
            if(isset($response['exception'])) {
                return Redirect::back()->withErrors(['msg' => $response['message']]);
            } else {
                return redirect('/authors/books/' . $author);
            }
        } else {
            return redirect('/')->withErrors(['msg' => 'Please login']);
        }
        
    }
}
