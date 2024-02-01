<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return Books list
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return $this->successResponse($books);

    }

    /**
     * Store a new book.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        //validacion
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'authord_id' => 'required|min:1',
        ]);

        //$this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
        //return response()->json($author, 201);


    }

    /**
     * return an specific book 
     * @return  \Illuminate\Http\Response
     */
    public function show($book)
    {
        $book = Book::findOrFail($book);

        return $this->successResponse($book);

    }

    /**
     * update the information of an existing author 
     * 
     */
    public function update(Request $request, $book)
    {
        //validacion
        $this->validate($request, [
            'title' => 'max:255',
            'description' => 'max:255',
            'price' => 'min:1',
            'authord_id' => 'min:1',
        ]);

        //$this->validate($request, $rules);

        $book = Book::findOrFail($book);

        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('Al least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);

    }

    /**
     * remove an existing book 
     * @return \Illuminate\Http\Response
     */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);

        $book->delete();

        return $this->successResponse($book);

    }

}
