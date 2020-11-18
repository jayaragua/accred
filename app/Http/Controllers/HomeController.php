<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\program;
use App\area;
use App\finding;
// use App\Http\Controllers\DB;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    var $area;
    
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

   public function getProg(){
        return program::orderBy('id', 'DESC')->get();
    }

    public function getArea(){
        return area::orderBy('id', 'asc')->get();
    }

    public function getFindingbyArea(Request $request, $id){


             $area=$id;
             
          
            return \DB::table('finding')
                ->where('area_id', '=', $area)
                ->get();
    }
    public function getFindingbyProg(Request $request, $prog_id, $area_id){
            // return response()->json([
            //     'msg'=>$this->area,
            //     ], 401);
              
            if($area_id==1 || $area_id==4 || $area_id==10 ){
                $result = \DB::table('finding')
                       ->where('area_id', '=', $area_id)
                       ->where(function ($query) use ($prog_id) {
                           $query->where('prog_id', $prog_id)
                                 ->orWhere('prog_id', 1);
                       })
                       ->get();
                return $result; 
              } 


              elseif($area_id==2 || $area_id==3 || $area_id==5  || $area_id==6  || $area_id==7  || $area_id==8  || $area_id==9){
                $result = \DB::table('finding')
                       ->where('area_id', '=', $area_id)
                       ->where(function ($query) use ($prog_id) {
                           $query->where('prog_id', $prog_id);
                       })
                       ->get();
                return $result; 
              } 

            }

            
            

            // if($area_id!=1 || $area_id!=4 || $area_id!=10 ){
            //     $result = \DB::table('finding')
            //            ->where('area_id', '=', $area_id)
            //            ->where(function ($query) use ($prog_id) {
            //                $query->where('prog_id', $prog_id);
            //            })
            //            ->get();
            //     return $result; 
            //   } 
            // }






                //  return \DB::table('finding')
                // ->where('area_id', '=', $area_id)
                // ->andWhere('b', '=', 1);
                // ->andwhere('prog_id', '=', $prog_id)
                // ->orderby('tab_num', 'asc')
                // ->orderby('id', 'asc')
                // ->get();

                // finding::where('area_id', $area_id)
                //   ->where(function($q) {
                //       $q->->where('prog_id', $prog_id)
                //           ->orWhere('prog_id', 'ALL');
                //   })
                //   ->get();

                // finding::where('area_id', $area_id)
                //   ->whereIn('prog_id', $cabIds)
                //   ->get();

                  // return finding::where('area_id', $area_id)
                  //           ->Where(function($query) {
                  //           $query->where('prog_id', $prog_id)
                  //           ->orwhere('prog_id', 'ALL');
                  //   })->get();

                
                // return response()->json([
                // 'msg'=>$prog_id,
                // ], 401);


                // return  \DB::table('finding')
                //     ->where('area_id', '=', $area_id)
                //     ->Where(function ($query) {
                //         $query->where('prog_id', '=', $prog_id)
                //               ->orwhere('prog_id', '=', 1);
                //     })
                //     ->get();


                //  return \DB::table('finding')
                // ->where('area_id', '=', $area_id)
                // ->orwhere('prog_id', '=', $prog_id)
                // ->orderby('tab_num', 'asc')
                // ->orderby('id', 'asc')
                // ->get();

               


                // $results = DB::select('select * from users where id = ?', [1]);
          
        
    //        


    public function getFinding(){
        return finding::orderBy('id','desc')->get();
    }

}



