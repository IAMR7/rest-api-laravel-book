<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Facade\FlareClient\Http\Response;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

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
        $response = [
            'message' => 'Data Buku',
            'data' => $book,
        ];
        return response()->json($response, HttpFoundationResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "judul" => ['required'],
            "penulis" => ['required'],
            "tahun" => ['required'],
            "penerbit" => ['required']
        ]);

        if($validator->fails()){
            return response()->json(
                $validator->errors(),
                HttpFoundationResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        try{
            $book = new Book;

            $book->judul = $request->judul;
            $book->penulis = $request->penulis;
            $book->tahun = $request->tahun;
            $book->penerbit = $request->penerbit;
            $book->save($request->all());
            // $book = Book::save($request->all());
            $response = [
                'message' => 'Berhasil Disimpan',
                'data' => $book,
            ];
            return response()->json($response, HttpFoundationResponse::HTTP_CREATED);
        } catch(QueryException $e){
            return response()->json([
                'message' => "Gagal " . $e->errorInfo,
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
        if (is_null($book)) {
            return response()->json([
                "success" => false,
                "message" => "Data buku tidak ditemukan"
            ]);
        }
        return response()->json([
            "success" => true,
            "message" => "Data Buku ditemukan",
            "data" => $book,
        ]);
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
        $book->update($request->all());
        return response()->json([
            "success" => true,
            "message" => "Data Buku telah diubah.",
            "data" => $book,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = Book::where('id', $id)->delete();
        return response()->json([
            "success" => true,
            "message" => "Data Buku berhasil dihapus.",
            "data" => $deletedRows,
        ]);
    }
}
