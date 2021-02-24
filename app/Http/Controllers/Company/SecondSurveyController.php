<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;
use App\Result;
use App\Category;
use App\Company;

class SecondSurveyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:company');
        $this->middleware('CheckIfCompanyCanSeeResult');
    }

    public function index($id){
        // dd('xxxss');
        // $id es el usuario_id
        // return $id;
        // $companytype = 
        $userid = $id;
        $company = Auth::guard('company')->user();

        // $company = Company::find($admin->company_id);
        
        $companytype = $company->type;

        $user = User::where('company_id', $company->id)->find($userid);

        // return $user;

        $results = Result::where('survey_id', $companytype)->where('user_id', $userid)->where('iteration',1)->with('question')->get();

        $tablaDePuntajes1 = [0,1,2,3,4];
        $tablaDePuntajes2 = [4,3,2,1,0];

        $valoresDeOpcionesDeRespuesta1 = $companytype==2 ? [18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33] : [1,  4,  23,  24,  25,  26, 27,  28,  30,  31, 32,  33,  34,  35,  36,  37,  38,  39,  40, 41,  42,  43,  44,  45,  46,  47,  48,  49, 50, 51, 52, 53, 55, 56, 57];
        $valoresDeOpcionesDeRespuesta2 = $companytype==2 ? [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 34, 35, 36, 37, 38, 39,40, 41, 42, 43, 44, 45, 46] : [2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15,  16,  17,  18,  19,  20,  21,  22,  29, 54,  58,  59,  60,  61,  62,  63,  64,  65, 66, 67, 68, 69, 70, 71, 72];

        $resultsGrupo1 = [];
        $resultsGrupo2 = [];

        $resultsQuestionsAvailable = []; // Recuerda que el numero de preguntas a contestar para el empleado cambia respecto a las preguntas de boss y clients, por lo que no siempre son las misma cantidad de preguntas que se tendran en esta variable

        foreach($results as $result){
            array_push($resultsQuestionsAvailable, $result->question->item);
        }

        // return $resultsQuestionsAvailable;

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

        // return $items;

        $onlyItems = [];

        foreach ($items as $item) {
            array_push($onlyItems, $item->item);
        }

        // Categories Code

        $categories = $companytype==2 ? ['Ambiente de trabajo', 'Factores propios de la actividad', 'Organizacion del tiempo de trabajo', 'Liderazgo y relaciones en el trabajo'] : ['Ambiente de trabajo', 'Factores propios de la actividad', 'Organización del tiempo de trabajo', 'Liderazgo y relaciones en el trabajo', 'Entorno organizacional'];

        $itemsForCategories = $companytype==2 ? [ [2,1,3], [4,9,5,6,7,8,41,42,43,10,11,12,13,20,21,22,18,19,26,27], [14,15,16,17], [23,24,25,28,29,30,31,32,44,45,46,33,34,35,36,37,38,39,40] ] : [ [1,3,2,4,5], [6,12,7,8,9,10,11,65,66,67,68,13,14,15,16,25,26,27,28,23,24,29,30,35,36], [17, 18, 19, 20, 21, 22], [31,32,33,34,37,38,39,40,41,42,43,44,45,46,69,70,71,72,57,58,59,60,61,62,63,64], [47,48,49,50,51,52,55,56,53,54] ];

        $categoriesComplete = [];

        for ($i=0; $i < count($categories); $i++) { 
            $categoryname = $categories[$i];
            $obj = (object) ['category' => $categoryname, 'items' => $itemsForCategories[$i]];
            array_push($categoriesComplete, $obj);
        }
        // return $categoriesComplete;

        // Domains code
        $domains = $companytype==2 ? ['Condiciones en el ambiente de trabajo', 'Carga de trabajo', 'Falta de control sobre el trabajo', 'Jornada de trabajo', 'Interferencia en la relación trabajo-familia', 'Liderazgo', 'Relaciones en el trabajo', 'Violencia'] : ['Condiciones en el ambiente de trabajo', 'Carga de trabajo', 'Falta de control sobre el trabajo', 'Jornada de trabajo', 'Interferencia en la relación trabajo-familia','Liderazgo','Relaciones en el trabajo','Violencia','Reconocimiento del desempeño','Insuficiente sentido de pertenencia e, inestabilidad'];

        $itemsForDomains = $companytype==2 ? [ [2,1,3], [4, 9, 5, 6, 7, 8, 41, 42, 43, 10, 11,12,13], [20, 21, 22, 18, 19, 26, 27], [14,15], [16,17], [23, 24, 25, 28, 29], [30, 31, 32, 44, 45, 46], [33, 34, 35, 36,37, 38, 39, 40] ] : [ [1,3,2,4,5], [6,12,7,8,9,10,11,65,66,67,68,13,14,15,16], [25,26,27,28,23,24,29,30,35,36], [17,18], [19,20,21,22], [31,32,33,34,37,38,39,40,41], [42,43,44,45,46,69,70,71,72,69,70,71,72], [57,58,59,60,61,62,63,64], [47,48,9,50,51,52], [55,56,53,54] ];
        
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

        $labels = ['Nulo o despreciable', 'Bajo', 'Medio', 'Alto', 'Muy alto'];
        $criterios = [
            'El riesgo resulta despreciable por lo que no se requiere medidas adicionales.',
            'Es necesario una mayor difusión de la política de prevención de riesgos psicosociales y programas para: la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral.',
            'Se requiere revisar la política de prevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacional favorable y la prevención de la violencia laboral, así como reforzar su aplicación y difusión, mediante un Programa de intervención.',
            'Se requiere realizar un análisis de cada categoría y dominio, de manera quese puedan determinar las acciones de intervención apropiadas a través de un Programa de intervención, que podrá incluir una evaluación específica1y deberá incluir una campaña de sensibilización, revisar la política deprevención de riesgos psicosociales y programas para la prevención de los factores de riesgo psicosocial, la promoción de un entorno organizacionalfavorable y la prevención de la violencia laboral, así como reforzar suaplicación y difusión.',
            'Se requiere realizar el análisis de cada categoría y dominio para establecerlas acciones de intervención apropiadas, mediante un Programa de intervención que deberá incluir evaluaciones específicas, y contemplarcampañas de sensibilización, revisar la política de prevención de riesgospsicosociales y programas para la prevención de los factores de riesgopsicosocial, la promoción de un entorno organizacional favorable y laprevención de la violencia laboral, así como reforzar su aplicación y difusión.'
        ];

        // calificacionFinal
        
        if($companytype == 2){
            $calificacionesFinal = [20,20,45,45,70,70,90,90];
        }else{
            $calificacionesFinal = [50,50,75,75,99,99,140,140];
        }

        $puntuacionfinal = 0;
        foreach ($items as $item) {
            $puntuacionfinal += $item->puntuacion;
        }
        $cf = $calificacionesFinal;
        $evaluation = [ ($puntuacionfinal<$cf[0]), ($puntuacionfinal>= $cf[1] && $puntuacionfinal<$cf[2]), ($puntuacionfinal>=$cf[3] && $puntuacionfinal<$cf[4]), ($puntuacionfinal>=$cf[5] && $puntuacionfinal<$cf[6]), ($puntuacionfinal>=$cf[7]) ];
        
        $buscar = array_search(true, $evaluation);
        
        $calificacion = $labels[$buscar];
        $criterio = $criterios[$buscar];

        $finalobj = (object) ['puntuacion' => $puntuacionfinal, 'calificacion' => $calificacion, 'criterio' => $criterio, 'criterioflag' => $buscar];
        // return [$finalobj];


        // return $onlyItems;
        // return $categoriesComplete;
        // Puntuacion por categiria
        foreach ($categoriesComplete as $category) {
            
            $sum = 0;
            foreach ($category->items as $itemOfCategory) {
                $index = array_search($itemOfCategory, $onlyItems);

                if(!is_bool($index)){
                    // return $items[$index]->puntuacion;
                    $sum += $items[$index]->puntuacion;
                }else{
                    // #L1XC
                    // return $itemOfCategory;
                    // return 'esto no es un error, recuerda que dependiendo de la preguntas boss y clients vamos a tener menos de 46 preguntas (el cuestionario se compone de 46 preguntas, pero pueden ser menos de acuerdo a lo contestado en clients y boss), el array $onlyItems es un listado de las preguntas que contesto, pueden ser mas o menos de 46, si la pregunta no se contesta, pues no se hace la suma';
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
                    // #L1XC
                    // return 'no lo encontro 2'; misma logica de arriba
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
        


        if($companytype == 2){
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
            
            $buscar = array_search(true, $evaluation);
            
            $calificacion = $labels[$buscar];
            $criterio = $criterios[$buscar];
            
            $category->criterioflag = $buscar;
            $category->criterio = $criterio;
            $category->calificacion = $calificacion;
            // return $calificacion;
        }

        // return $categoriesComplete;
        // return $domainsComplete;
        // Calificacion dominio
        if($companytype == 2){
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

        for ($i=0; $i < count($domainsComplete); $i++){
            $domain = $domainsComplete[$i];
            $punt = $domain->puntuacion;
            // return $domainPunt;
            $cc = $calificacionesDominio[$i];
            
            $evaluation = [ ($punt<$cc[0]), ($punt>= $cc[1] && $punt<$cc[2]), ($punt>=$cc[3] && $punt<$cc[4]), ($punt>=$cc[5] && $punt<$cc[6]), ($punt>=$cc[7]) ];
            
            $buscar = array_search(true, $evaluation);

            $calificacion = $labels[$buscar];

            $criterio = $criterios[$buscar];

            $domain->criterio = $criterio;
            $domain->criterioflag = $buscar;
            $domain->calificacion = $calificacion;
            // return $calificacion;
        }



        // return $categoriesComplete;
        // return $user;
        $obj =  [$finalobj, $categoriesComplete, $domainsComplete];

        $categories = $categoriesComplete;
        $domains = $domainsComplete;
        $final = $finalobj;
        // return [$user];
        // return [$final];
        // return $categories;
        return view('Company.rpsic', compact('final', 'categories', 'domains', 'user'));
    }
}
