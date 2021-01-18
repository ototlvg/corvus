<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Result;
use App\Category;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('Admin.home');
        $admin = Auth::guard('admin')->user();
        $companyOfAdminId = $admin->company_id;
        // $users = User::where('company_id', $companyOfAdminId)->paginate(1);
        $users = User::where('company_id', $companyOfAdminId)->with('status')->paginate(1);
        // return $users;
        // dd($admin);
        // return $admin;
        // return $users;
        return view('Admin.home', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $companyid = 
        $admin = Auth::guard('admin')->user();
        $companyid = $admin->company_id;

        $user = User::where('company_id', $companyid)->find($id);

        $results = Result::where('survey_id', $companyid)->where('user_id', $id)->where('iteration',1)->with('question')->get();

        $tablaDePuntajes1 = [0,1,2,3,4];
        $tablaDePuntajes2 = [4,3,2,1,0];

        $valoresDeOpcionesDeRespuesta1 = $companyid==2 ? [18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33] : [1,  4,  23,  24,  25,  26, 27,  28,  30,  31, 32,  33,  34,  35,  36,  37,  38,  39,  40, 41,  42,  43,  44,  45,  46,  47,  48,  49, 50, 51, 52, 53, 55, 56, 57];
        $valoresDeOpcionesDeRespuesta2 = $companyid==2 ? [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 34, 35, 36, 37, 38, 39,40, 41, 42, 43, 44, 45, 46] : [2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,  16,  17,  18,  19,  20,  21,  22,  29, 54,  58,  59,  60,  61,  62,  63,  64,  65, 66, 67, 68, 69, 70, 71, 72];

        $resultsGrupo1 = [];
        $resultsGrupo2 = [];

        $resultsQuestionsAvailable = []; // Recuerda que el numero de preguntas a contestar cambia respecto a las preguntas de boss y clients, por lo que no siempre son las mismas

        foreach($results as $result){
            array_push($resultsQuestionsAvailable, $result->question->item);
        }

        // foreach($resultsQuestionsAvailable as $qa){
        //     $x = array_search($qa, $valoresDeOpcionesDeRespuesta1);
        //     $y = array_search($qa, $valoresDeOpcionesDeRespuesta2);

        //     // return is_bool($y) ? 'Es booleano' : $y;

        //     if(!is_bool($x)){
        //         array_push($resultsGrupo1, $results[$x]);
        //     }
            
        //     if(!is_bool($y)){
        //         array_push($resultsGrupo2, $results[$y]);
        //     }
        // }

        foreach($valoresDeOpcionesDeRespuesta1 as $r){
            $x = array_search($r, $resultsQuestionsAvailable);
            // return is_bool($y) ? 'Es booleano' : $y;
            if(!is_bool($x)){
                $object = (object) ['item' => $results[$x]->question->item, 'answer' => $results[$x]->answer_id];
                array_push($resultsGrupo1, $object);
            }
        }

        foreach($valoresDeOpcionesDeRespuesta2 as $r){
            $x = array_search($r, $resultsQuestionsAvailable);
            if(!is_bool($x)){
                // array_push($resultsGrupo2, $results[$x]);
                $object = (object) ['item' => $results[$x]->question->item, 'answer' => $results[$x]->answer_id];
                array_push($resultsGrupo2, $object);
            }
        }



        // return $resultsGrupo1;

        foreach($resultsGrupo1 as $rg1){
            $rg1->puntuacion = $tablaDePuntajes1[$rg1->answer-1];
        }

        foreach($resultsGrupo2 as $rg2){
            $rg2->puntuacion = $tablaDePuntajes2[$rg2->answer-1];
        }
        
        $items = array_merge($resultsGrupo1, $resultsGrupo2);

        $onlyItems = [];

        foreach ($items as $item) {
            array_push($onlyItems, $item->item);
        }

        // Categories Code

        $categories = $companyid==2 ? ['Ambiente de trabajo', 'Factores propios de la actividad', 'Organizacion del tiempo de trabajo', 'Liderazgo y relaciones en el trabajo'] : ['Ambiente de trabajo', 'Factores propios de la actividad', 'Organización del tiempo de trabajo', 'Liderazgo y relaciones en el trabajo', 'Entorno organizacional'];

        $itemsForCategories = $companyid==2 ? [ [2,1,3], [4,9,5,6,7,8,41,42,43,10,11,12,13,20,21,22,18,19,26,27], [14,15,16,17], [23,24,25,28,29,30,31,32,44,45,46,33,34,35,36,37,38,39,40] ] : [ [1,3,2,4,5], [6,12,7,8,9,10,11,65,66,67,68,13,14,15,16,25,26,27,28,23,24,29,30,35,36], [17, 18, 19, 20, 21, 22], [31,32,33,34,37,38,39,40,41,42,43,44,45,46,69,70,71,72,57,58,59,60,61,62,63,64], [47,48,49,50,51,52,55,56,53,54] ];

        $categoriesComplete = [];

        for ($i=0; $i < count($categories); $i++) { 
            $categoryname = $categories[$i];
            $obj = (object) ['category' => $categoryname, 'items' => $itemsForCategories[$i]];
            array_push($categoriesComplete, $obj);
        }
        // return $categoriesComplete;

        // Domains code
        $domains = $companyid==2 ? ['Condiciones en el ambiente de trabajo', 'Carga de trabajo', 'Falta de control sobre el trabajo', 'Jornada de trabajo', 'Interferencia en la relación trabajo-familia', 'Liderazgo', 'Relaciones en el trabajo', 'Violencia'] : ['Condiciones en el ambiente de trabajo', 'Carga de trabajo', 'Falta de control sobre el trabajo', 'Jornada de trabajo', 'Interferencia en la relación trabajo-familia','Liderazgo','Relaciones en el trabajo','Violencia','Reconocimiento del desempeño','Insuficiente sentido de pertenencia e, inestabilidad'];

        $itemsForDomains = $companyid==2 ? [ [2,1,3], [4, 9, 5, 6, 7, 8, 41, 42, 43, 10, 11,12,13], [20, 21, 22, 18, 19, 26, 27], [14,15], [16,17], [23, 24, 25, 28, 29], [30, 31, 32, 44, 45, 46], [33, 34, 35, 36,37, 38, 39, 40] ] : [ [1,3,2,4,5], [6,12,7,8,9,10,11,65,66,67,68,13,14,15,16], [25,26,27,28,23,24,29,30,35,36], [17,18], [19,20,21,22], [31,32,33,34,37,38,39,40,41], [42,43,44,45,46,69,70,71,72,69,70,71,72], [57,58,59,60,61,62,63,64], [47,48,9,50,51,52], [55,56,53,54] ];
        
        $domainsComplete = [];

        for ($i=0; $i < count($domains); $i++) { 
            $domainname = $domains[$i];
            $obj = (object) ['domain' => $domainname, 'items' => $itemsForDomains[$i]];
            array_push($domainsComplete, $obj);
        }

        // return $onlyItems;
        // return $items;
        // return $categoriesComplete;
        // return $domainsComplete;

        // $calificacionFinal = ''
        $puntuacionfinal = 0;
        foreach ($items as $item) {
            $puntuacionfinal += $item->puntuacion;
        }

        // Puntuacion por categiria
        foreach ($categoriesComplete as $category) {
            
            $sum = 0;
            foreach ($category->items as $itemOfCategory) {
                $index = array_search($itemOfCategory, $onlyItems);

                if(!is_bool($index)){
                    // return $items[$index]->puntuacion;
                    $sum += $items[$index]->puntuacion;
                }else{
                    return 'no lo encontro';
                }
                // return $itemOfCategory;
            }

            // if(){

            // }

            $category->puntuacion = $sum;
        }

        $sum = 0;

        // Puntuacion por dominio
        foreach ($domainsComplete as $domain) {
            
            $sum = 0;
            foreach ($domain->items as $itemOfDomain) {
                $index = array_search($itemOfDomain, $onlyItems);

                if(!is_bool($index)){
                    // return $items[$index]->puntuacion;
                    $sum += $items[$index]->puntuacion;
                }else{
                    return 'no lo encontro';
                }
                // return $itemOfCategory;
            }

            $domain->puntuacion = $sum;

        }

        // return $domains;
        // return $categories;
        // return $puntuacionfinal;
        // return $domainsComplete;
        // return $categoriesComplete;
        // return $domainsComplete;

        // Calificacion por categorias
        $labels = ['Nulo o despreciable', 'Bajo', 'Medio', 'Alto', 'Muy alto'];

        if($companyid == 2){
            $calificacionesCategoria = [
                [3,3,5,5,7,7,9,9],
                [10,10,20,20,30,30,40,40],
                [4,4,6,6,9,9,12,12],
                [10,10,18,18,28,28,38,38]
            ];
        }else{
            $calificacionesCategoria = [
                [5,5,9,9,11,11,14,14],
                [15,15,30,30,45,45,60,60],
                [5,5,7,7,10,10,13,13],
                [14,14,29,29,42,42,58,58],
                [10,10,14,14,18,18,23,23]
            ];
        }

        for ($i=0; $i < count($categoriesComplete); $i++) { 
            $category = $categoriesComplete[$i];
            $punt = $category->puntuacion;
            // return $categoryPunt;
            $cc = $calificacionesCategoria[$i];
            
            $evaluation = [ ($punt<$cc[0]), ($punt>= $cc[1] && $punt<$cc[2]), ($punt>=$cc[3] && $punt<$cc[4]), ($punt>=$cc[5] && $punt<$cc[6]), ($punt>=$cc[7]) ];
            
            $calificacion = $labels[array_search(true, $evaluation)];

            $category->calificacion = $calificacion;
            // return $calificacion;
        }

        // return $domainsComplete;
        // Calificacion dominio
        if($companyid == 2){
            $calificacionesDominio = [
                [3,3,5,5,7,7,9,9],
                [12,12,16,16,20,20,24,24],
                [5,5,8,8,11,11,14,14],
                [1,1,2,2,4,4,6,6],
                [1,1,2,2,4,4,6,6],
                [3,3,5,5,8,8,11,11],
                [5,5,8,8,11,11,14,14],
                [7,7,10,10,13,13,16,16]
            ];
        }else{
            $calificacionesDominio = [
                [5,5,9,9,11,11,14,14],
                [15,15,21,21,27,27,37,37],
                [11,11,16,16,21,21,25,25],
                [1,1,2,2,4,4,6,6],
                [4,4,6,6,8,8,10,10],
                [9,9,12,12,16,16,20,20],
                [10,10,13,13,17,17,21,21],
                [7,7,10,10,13,13,16,16],
                [6,6,10,10,14,14,18,18],
                [4,4,6,6,8,8,10,10]
            ];
        }

        for ($i=0; $i < count($domainsComplete); $i++) { 
            $domain = $domainsComplete[$i];
            $punt = $domain->puntuacion;
            // return $domainPunt;
            $cc = $calificacionesDominio[$i];
            
            $evaluation = [ ($punt<$cc[0]), ($punt>= $cc[1] && $punt<$cc[2]), ($punt>=$cc[3] && $punt<$cc[4]), ($punt>=$cc[5] && $punt<$cc[6]), ($punt>=$cc[7]) ];
            
            $calificacion = $labels[array_search(true, $evaluation)];

            $domain->calificacion = $calificacion;
            // return $calificacion;
        }

        return $domainsComplete;
        // return $categoriesComplete;
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
