<?php

namespace App\Http\Controllers;

use App\irtaexCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\IrtaexEfetivo;
use App\Postograd;
use phpDocumentor\Reflection\Types\Integer as TypesInteger;
use PhpParser\Node\Expr\Cast\Int_;
use Ramsey\Uuid\Type\Integer;

class IrtaexEfetivoController extends Controller
{

    public function index(Request $request)
    {

        //dd($request);
        // $cat = $request->categoria;
   
        $categoria = irtaexCategory::all();
        if ($request->ajax()) {
          
            $h ='teste';
            $efetivo = IrtaexEfetivo::where('irtaexcategory_id', $request->categoria)->get();

            return DataTables::of($efetivo)
            ->addColumn('action', function (IrtaexEfetivo $efetivo) {
                $c = "'Confirma a exlusão do efetivo?'";
                return 
                '<div class="row"  style="height: 25px;">'.
                '<div class="col-md-6 mx-auto" style="height: 25px;">'.
                ' <a href="/efetivos/'.$efetivo->id.'/edit" style="color: inherit;" ><center><i class="fas fa-edit" title="Alterar efetivo"></i></center></a>'.
                '</div>'.
                '<div class="col-md-6">'.
                '<form class="form-group" method="delete" action="'. route('efetivo_delete', $efetivo->id) .'" >'.
                '<button class="btn form-control pt-0 " type="submit" onclick="alert('.$c.');"><i class="far fa-trash-alt"></i></button>'.            
                '</form>'.
                '</div>'.
                '</div>';

            })
            ->addColumn('posto',function($efetivo){
              return $efetivo->postograd->siglaPg;
            })
            
          
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('irtaex.admin.efetivos.index', compact('categoria'));
    }

    public function create(Int $categoria){

        $category = irtaexCategory::find($categoria);
        $posto = Postograd::all();
        
       // dd($category);
        return view('irtaex.admin.efetivos.create', compact('category','posto'));
    }
    

    public function store(Request $request)
    {

      //  dd($request);
        $rules = [
            'circulo' => 'required',
            'pessoal' => 'required',
            'postograd_id' => 'required',
        ];
        $messages = [
            'circulo.required' => 'Campo obrigatório.',
            'pessoal.required' => 'Campo obrigatório',
            'postograd_id.required' => 'Campo obrigatório',
        ];

       $this->validate($request, $rules, $messages);
       
        IrtaexEfetivo::create($request->all());
        
        return redirect('efetivos');
    }


}
