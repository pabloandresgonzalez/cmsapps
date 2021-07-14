<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isadmin');
    }

    public function getHome($module)
    {
        $cats = Category::where('module', $module)->orderBy('name', 'Asc')->get();
        $data = ['cats' => $cats];
        return view('admin.categories.home', $data);
    }

    public function postCategoryAdd(Request $request)
    {
        //  Reglas de validacion
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];

        $messages = [

            'name.required' => 'Es necesario nombre de categoria.',
            'icon.required' => 'Es necesario un icono de categoria.'
        ];

        $aValue = Validator::make($request->all(), $rules, $messages);

        //Validacion del formulario
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Por favor verifica los campos!!')->with('typealert', 'danger');
        else:
            $c = new Category;
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            $c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c-> save()):
                return back()->with('message', 'Cambios guardados con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryEdit($id)
    {
        $cat = Category::find($id);
        $data = ['cat' => $cat];
        return view('admin.categories.edit', $data);
    }

    public function postCategoryEdit(Request $request, $id)
    {
        //  Reglas de validacion
        $rules = [
            'name' => 'required',
            'icon' => 'required'
        ];

        $messages = [

            'name.required' => 'Es necesario nombre de categoria.',
            'icon.required' => 'Es necesario un icono de categoria.'
        ];

        //$aValue = Validator::make($request->all(), $rules, $messages);

        //Validacion del formulario
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()):
            return back()->withErrors($validator)->with('message', 'Por favor verifica los campos!!')->with('typealert', 'danger');
        else:
            $c = Category::find($id);
            $c->module = $request->input('module');
            $c->name = e($request->input('name'));
            //$c->slug = Str::slug($request->input('name'));
            $c->icono = e($request->input('icon'));
            if($c->save()):
                return back()->with('message', 'Cambios guardados con éxito.')->with('typealert', 'success');
            endif;
        endif;
    }

    public function getCategoryDelete($id)
    {
        $c = Category::find($id);
            if($c->delete()):
                return back()->with('message', 'Registro borrado con éxito.')->with('typealert', 'success');
            endif;
    }
}
