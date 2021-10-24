<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::all();

        if ($book) {
            return response()->json([
                'success' => "true",
                'data' => $book,
                'mesasge' => 'success show all books',
                'code' => http_response_code(200)
            ]);
        } else {
            return response()->json([
                'success' => "false",
                'data' => null,
                'mesasge' => 'failed show all books',
                'code' => http_response_code(404)
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|unique:books',
            'category' => 'required|string',
            'desc' => 'required|string',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        $imagePath = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName ='U-'. time().'.'.$extension;

            $savePath = '/uploads/books/';
            $savePathDB = '/uploads/books/'. $fileName;
            $path = public_path(). "$savePath";
            $file->move($path, $fileName);

            $imagePath = $savePathDB;
        }

        $data = new Book();
        $data->title = $request->title;
        $data->category = $request->category;
        $data->desc = $request->desc;
        $data->image = $imagePath;
        $data->save();

        if ($data) {
            return response()->json([
                'success' => "true",
                'data' => $data,
                'mesasge' => 'success store book',
                'code' => http_response_code(200)
            ]);
        } else {
            return response()->json([
                'success' => "false",
                'data' => null,
                'mesasge' => 'failed store book',
                'code' => http_response_code(404)
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        if ($book) {
            return response()->json([
                'success' => "true",
                'data' => $book,
                'mesasge' => 'success show detail book by id',
                'code' => http_response_code(200)
            ]);
        } else {
            return response()->json([
                'success' => "false",
                'data' => null,
                'mesasge' => 'failed show detail book by id',
                'code' => http_response_code(404)
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => "false",
                'data' => null,
                'mesasge' => 'book not found',
                'code' => 204
            ]);
        }

        $this->validate($request, [
            'title' => 'string',
            'category' => 'string',
            'desc' => 'string',
            'image' => 'mimes:jpg,png,jpeg'
        ]);



        $imagePath = "";
        if ($request->hasFile('image')) {

            $filePath = public_path().$book->image;
            if (file_exists($filePath)) {
                try {
                    unlink($filePath);
                } catch (Exception $e) {
                    // Do Nothing
                }
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName ='U-'. time().'.'.$extension;

            $savePath = '/uploads/books/';
            $savePathDB = '/uploads/books/'.$fileName;
            $path = public_path(). "$savePath";
            $file->move($path, $fileName);

            $imagePath = $savePathDB;
        }

        $book->title = $request->title;
        $book->category = $request->category;
        $book->desc = $request->desc;
        $book->image = $imagePath;
        $book->save();

        if ($book) {
            return response()->json([
                'success' => "true",
                'data' => $book,
                'mesasge' => 'success update book',
                'code' => http_response_code(200)
            ]);
        } else {
            return response()->json([
                'success' => "false",
                'data' => null,
                'mesasge' => 'failed update book',
                'code' => http_response_code(404)
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'success' => "false",
                'data' => null,
                'mesasge' => 'book not found',
                'code' => 204
            ]);
        }

        $book->delete();

        if ($book) {
            return response()->json([
                'success' => "true",
                'mesasge' => 'success delete book',
                'code' => http_response_code(200)
            ]);
        } else {
            return response()->json([
                'success' => "false",
                'mesasge' => 'failed delete book',
                'code' => http_response_code(404)
            ]);
        }

    }
}
