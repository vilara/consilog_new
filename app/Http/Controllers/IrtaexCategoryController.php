<?php

namespace App\Http\Controllers;

use App\irtaexCategory;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;
use Yajra\DataTables\DataTables;

class IrtaexCategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $category = irtaexCategory::all();
        if ($request->ajax()) {

            return DataTables::of($category)
            ->addColumn('action', function (irtaexCategory $category) {
                $c = "'Confirma a exlusão da categoria'";
                return 
                '<div class="row"  style="height: 25px;">'.
                '<div class="col-md-6 mx-auto" style="height: 25px;">'.
                ' <a href="/categories/'.$category->id.'/edit" style="color: inherit;" ><center><i class="fas fa-edit" title="Alterar Categoria"></i></center></a>'.
                '</div>'.
                '<div class="col-md-6">'.
                '<form class="form-group" method="delete" action="'. route('category_delete', $category->id) .'" >'.
                '<button class="btn form-control pt-0 " type="submit" onclick="alert('.$c.');"><i class="far fa-trash-alt"></i></button>'.            
                '</form>'.
                '</div>'.
                '</div>';

            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('irtaex.admin.categories.index');
    }


    public function create()
    {
        
        return view('irtaex.admin.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'categoria' => 'required',
            'armamento' => 'required',
        ];
        $messages = [
            'categoria.required' => 'Campo obrigatório.',
            'armamento.required' => 'Campo obrigatório',
        ];

        $this->validate($request, $rules, $messages);
       
        irtaexCategory::create($request->all());
        
        return redirect('categories');
    }

    public function edit(irtaexCategory $category)
    {
        
        return view('irtaex.admin.categories.edit', compact('category'));
    }

    public function update(Request $request, irtaexCategory $category)
    {
        $rules = [
            'categoria' => 'required',
            'armamento' => 'required',
        ];
        $messages = [
            'categoria.required' => 'Campo obrigatório.',
            'armamento.required' => 'Campo obrigatório',
        ];

        $atributes = $this->validate($request, $rules, $messages);
       
        $category->update($request->all());
        
        return redirect('categories');
    }

    public function destroy(irtaexCategory $category)
    {
        $category->delete();
        return redirect ( '/categories' )->with ( 'success', 'Categoria excluído com sucesso!' );
    }
}
