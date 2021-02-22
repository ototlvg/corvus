<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserProfile;
use Illuminate\Support\Facades\Auth;

class InitialQuestionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkAccess');
        $this->middleware('checkAccessForInitialQuestion');
        // dd(auth()->user());
        
    }


    public function index($type){
        // dd(auth()->user()->id);
        // dd('dsad');

        $obj = (object) ['type' => 'empty', 'question' => 'empty'];
        $obj->type = $type;
        if($type == 'jefe'){
            // dd('contesta jefe');
            $obj->question = "En mi trabajo debo brindar servicio a clientes o usuarios";

        }elseif($type == 'clientes'){
            $obj->question = "Soy jefe de otros trabajadores";
            // dd('contesta clientes');
        }else{
            dd('dsds');
            return redirect()->route('home');
        }

        return view('Employee/soloQuestion', compact('type', 'obj'));
        // return redirect()->route('home', compact('obj'));
    }

    public function store(Request $request){
        $type = $request->post('type');

        // return $type;
        
        // return (int) $request->post('question');

        if($type == 'jefe' || $type == 'clientes'){

            // return auth()->user()->id;
            
            $user_profile = UserProfile::where('user_id', auth()->user()->id)->first();

            $typedb = $type == 'jefe' ? 'boss' : 'clients';

            $user_profile->$typedb = (int) $request->post('question');
            $user_profile->save();
            return redirect()->route('home');



        }else{ // Si alguien esta de chistosito y le cambia el tipo, pues esto solo lo regresa al home
            return redirect()->route('home');
        }
    }
}
