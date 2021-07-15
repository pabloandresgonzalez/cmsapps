<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;


class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getHome()
    {
        return view('admin.products.home');
    }

    public function getProductAdd()
    {
        $cats =Category::where('module', '0')->pluck('name', 'id');
        $data = ['cats' => $cats];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(Request $request)
    {
        $rules = [
            'name' => 'required',
            'img' => 'required|image',
            'price' => 'required',
            'content' => 'required'
        ];

        $messages = [

            'name.required' => 'Es necesario nombre del producto.',
            'img.required' => 'Es necesario una imagen del producto.',
            'img.image' => 'El archivo no es una imagen.',
            'price.required' => 'Es necesario un precio para el producto.',
            'content.required' => 'Es necesario una descripcion del producto.'
        ];

        //Validacion del formulario
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Por favor verifica los campos!!')->with('typealert', 'danger')->withInput();
        else:
            $product = new Product;
            $product->status = '0';
            $product->name = e($request->input('name'));
            $product->slug = Str::slug($request->input('name'));
            $product->category_id =$request->input('category');
            $product->image ="image.png";
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = e($request->input('content'));

            //Subir la imagen
            $image_path = $request->file('img');

            //Poner nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();

            //Guardarla en la carpeta storage (storage/app/activos)
            Storage::disk('uploads')->put($image_path_name, File::get($image_path));

            //Seteo el nombre de la imagen en el objeto
            $product->image = $image_path_name;

            if($product-> save()):
                /*
                $nameimg = $image_path_name;
                $minfile = $nameimg;
                $img = Image::make($minfile);
                $img->resize(320, 240);
                $img->save('public/'.$image_path_name);
                */

                /* para guardar la foto en public/im/products
                $fileExt = trim($request->file('img')->getClientOriginalExtension());
                $request->img->move( public_path('img/products'), time().'.'.$fileExt);
                */

                /*
                $file = Storage::disk('uploads')->get($image_path_name);
                $img = Image::make($file);
                $img->fit(256, 256, function($constraint) {
                    $constraint->upsize();
                });
                $img->save(Storage::disk('uploads')->put($image_path_name, File::get($image_path)));
                */

                return redirect('/admin/products')->with('message', 'Cambios guardados con éxito.')->with('typealert', 'success');

            endif;
         endif;
    }


}
