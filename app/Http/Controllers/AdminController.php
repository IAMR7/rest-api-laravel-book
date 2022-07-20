<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $book = Book::all();
        // dd($book);
        return view('home', ['listbook'=>$book]);
    }

    public function addbook(Request $request){
        // dd($request);
       
        $book = new Book; //membuat object model/tabel baru

        //kolom database = data yang akan dimasukan
        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->tahun = $request->tahun;
        $book->penerbit = $request->penerbit;

        $book->save(); //insert data ke database
        return redirect()->back()->with('success','Data Berhasil Dimasukan');      
    }

    public function editbook(Request $request){
        // dd($request);
       
        $book = Book::find($request->id); //mencari record berdasarkan id

        //kolom database = data yang akan dimasukan
        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->tahun = $request->tahun;
        $book->penerbit = $request->penerbit;

        $book->save(); //insert data ke database
        return redirect()->back()->with('success','Data Berhasil Di updates');      
    }

    public function deletebook($id){
        $book = Book::find($id); //mencari data berdasarkan id
        $book->delete(); //fungsi menghapus data
        return redirect()->back()->with('success','Data Berhasil Di Hapus');    //   
    }

    public function detailbook($id){
        $book = Book::find($id); //mencari row didatabase berdasar id
        // dd($book);
        return view('detail', ['book'=> $book]);   
    }

}
