<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use DB;

class ProductoController extends Controller
{
   public function index(Request $request)
    {
        $pds = Producto::all();
        return view('supervisor.producto.index',compact('pds'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cts = Categoria::all();
        return view('supervisor.producto.agregarProduc',compact('cts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nus = new Producto();
        $nus->nombre = $request->input('nombre');
        $nus->descripcion = $request->input('descripcion');
        $nus->precio = $request->input('precio');
        $nus->imagen =$request->input('imagen');
        $nus->stock =$request->input('stock');
        $nus->categoria_id = $request->input('ct');
        
        $nus->save();

        return redirect('productos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $Productos = DB::table('productos')->where('categoria_id',$id)->get();
        return view('cliente.producto.mostrarProductos',compact('Productos'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sl = Producto::find($id);
        $cts = Categoria::all();
        return view('CRUD_producto.editarP',compact('sl','cts'));
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
        $nus = Producto::find($id);
        $nus->namep = $request->input('name');
        $nus->price = $request->input('price');
        $nus->description = $request->input('description');
        $nus->categoria_id = $request->input('ct');
        $nus->save();

        return redirect('productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nus = Producto::find($id);
        $nus->delete();
        return redirect('productos');
    }

}