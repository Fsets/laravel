<?php

use Illuminate\Support\Facades\Route;
use App\Articulo; //importa la clase articulo
use App\Cliente;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get("/","MiCotrolador@index");
Route::get("/crear","MiCotrolador@create");
Route::get("/mostrar","MiCotrolador@show");
Route::get("/articulos","MiCotrolador@store");
Route::get("/contacto", "MiCotrolador@contactar");
Route::get("/galeria", "MiCotrolador@galeria");

/*Route:: get("/leer", function(){
    $articulos=Articulo::all(); //almacena en un array todo los valores de la tabla con el .all()
    foreach($articulos as $articulo){
        echo "Nombre: " . $articulo->Nombre_articulo . " Precio: " . $articulo->Precio . "<br>";
    }
    
});*/
/*
Route:: get("/leer", function(){
    $articulos= Articulo::where("seccion", "CERAMICA")->orderBy("Nombre_articulo") ->get();
    return $articulos;
});*/

Route:: get("/insertar", function(){
    $articulos = new Articulo;
    $articulos-> Nombre_articulo="Pantalones";
    $articulos-> Precio=60;
    $articulos-> pais_origen="España";
    $articulos-> observaciones="Lavados a la piedra";
    $articulos-> seccion="Ropa";
    
    $articulos->save();
});
/*
Route:: get("/actualizar", function(){
    $articulos = Articulo::find(7);
    $articulos-> Nombre_articulo="Pantalones";
    $articulos-> Precio=90;
    $articulos-> pais_origen="España";
    $articulos-> observaciones="Lavados a la piedra";
    $articulos-> seccion="Ropa";
    
    $articulos->save();
});*/

Route:: get("/actualizar", function(){
    Articulo::where("seccion", "Menaje") ->where("pais_origen", "ESPAÑA")-> update(["Precio" => 90]);
});

Route:: get("/borrar", function(){
    /*
    $articulo= Articulo::find(7);
    $articulo->delete();
    */
    Articulo::where("seccion", "FERRETERIA")->delete();
});

Route:: get("/insercionVarios", function(){
   Articulo::create(["Nombre_articulo" => "IMPRESORA", "Precio" => 50, "pais_origen" => "COLOMBIA", "observaciones" => "nada que decir", "seccion" => "INFORMATICA"]);
});
 

Route:: get("/softdelete", function(){
   Articulo::find(4)->delete();
});

Route:: get("/harddelete", function(){
   $articulos= Articulo::withTrashed()
        ->where('id', 4)
        ->forceDelete();
});

Route:: get("/leer", function(){
   $articulos= Articulo::withTrashed()
        ->where('id', 4)
        ->restore();
    //return $articulos;
});

//tablas relacionadas one to one 
Route:: get("/cliente/{id}/articulo", function($id){
   return Cliente::find($id)->articulo;
});


Route:: get("/articulo/{id}/cliente", function($id){
   return Articulo::find($id)->cliente->Nombre;
});

//TABLAS RELACIONADAS UNO A VARIOS
Route:: get("/articulos", function(){
    $articulos = Cliente::find(3)->articulos->where("pais_origen", "JAPON");
 
    foreach ($articulos as $articulo) { //for each pq nos devuelve mas de un valor
    //
        echo $articulo->Nombre_articulo . "<br/>";
    }
    
});
//tablas relacionadas varios a varios
Route:: get("/cliente/{id}/perfil", function($id){
    $cliente= Cliente::find($id);
    foreach($cliente->perfils as $perfil){
        return $perfil->Nombre;
    }
    
});


/*RAW SQL
Route::get("/insertar", function(){
    DB::insert("INSERT INTO articulos (Nombre_articulo, Precio, pais_origen, seccion, observaciones) VALUES(?,?,?,?,?)", 
              ["NAVAJA", 15.00, "SUIZA", "FERRETERIA", "MULTIUSOS"]);
    
});

Route::get("/leer", function(){
    $resultados=DB::select("SELECT * FROM articulos WHERE ID=?", [1]);
    foreach($resultados as $articulo){
        return $articulo-> Nombre_articulo;
    }
    
});

Route::get("/actualiza", function(){
    DB::update("UPDATE articulos SET seccion='DECORACION' WHERE ID=?", [1]);
    
});

Route::get("/borrar", function(){
    DB::update("DELETE FROM articulos WHERE ID=?", [1]);
    
});
*/ 