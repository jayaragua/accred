<?php

namespace App\Http\Controllers;
use App\finding;
use App\program;
use App\area;
use App\uploadmulti;
use Illuminate\Http\Request;

class findingController extends Controller
{


	 public function addFinding(Request $request){
    	//validate request
    	$this->validate($request,[
            
    		'prog_id'=>'required',
    		'area_id'=>'required',
    		'title'=>'required',
    		'deliverable'=>'required',
    		'deli_data'=>'required',
            'tab_num'=>'required'
    		
    		

    	]);
    	return finding::create([
    		'prog_id'=> $request->prog_id,
    		'area_id'=> $request->area_id,
    		'title'=> $request->title,
    		'deliverable'=> $request->deliverable,
    		'deli_data'=> $request->deli_data,
            'tab_num'=> $request->tab_num
    		
    	]);
    }



    public function editFinding(Request $request){
    	//validate request
    	$this->validate($request,[
    		'prog_id'=>'required',
    		'area_id'=>'required',
    		'title'=>'required',
    		'deliverable'=>'required',
    		'deli_data'=>'required',
    		'id'=>'required',
            'tab_num'=>'required'
    	]);
    	return finding::where('id', $request->id)->update([
    		'prog_id'=> $request->prog_id,
    		'area_id'=> $request->area_id,
    		'title'=> $request->title,
    		'deliverable'=> $request->deliverable,
    		'deli_data'=> $request->deli_data,
            'tab_num'=> $request->tab_num
    	]);
    		
    }


    public function deleteFinding(Request $request, $id){
    	// 	$this->validate($request,[
    	// 	'id'=>'required',
    	// ]);
            // return response()->json([
            //     'msg'=>$request->id,s
            //     ], 401);
    		return finding::where('id', $id)->delete();


    }
    

    public function getFinding(){
    	// return $finding->program()::orderBy('id', 'desc')->get();
    	// $finding = finding::join('program', 'finding.prog_id', '=', 'program.id')
     //            ->get(['finding.*', 'program.*']);


    	return \DB::table('finding')
            ->join('program', 'finding.prog_id', '=', 'program.id')
            ->select('finding.*', 'program.progName')
            ->orderBy('id', 'desc')
            ->get();

    }






        //uploading all documents    
  
     public function getUploads(){

        // return uploadmulti::orderBy('id', 'desc')->get();

            return \DB::table('uploadmulti')
            ->join('program', 'uploadmulti.prog_id', '=', 'program.id')
            ->select('uploadmulti.*', 'program.progName')
            ->orderBy('id', 'desc')
            ->get();

    }


    public function deleteUpload(Request $request, $id){

            return uploadmulti::where('id', $id)->delete();
    }
	



    public function uploadMulti(Request $request){
            $this->validate($request,[
                'file'=>'required|mimes:pdf'
            ]);

         $deliverable = $request->file->getClientOriginalName();
         $request->file->move(public_path('uploads_all'),  $deliverable );
         return  $deliverable;
    }




    public function addMultiUpload(Request $request , $file, $area_id, $prog_id){
        // $this->validate($request,[
        //     'prog_id'=>'required',
        //     'area_id'=>'required',
        //     'deli_data'=>'required',

        // ]);

        $path = '/uploads_all/';
        // return uploadmulti::create([
            
        //     'deli_data'=> $path.''.$file,
        //     'title'=> $file,
        //     'prog_id'=> $prog_id,
        //     'area_id'=> $area_id,

        // ]);
        // $data[]=[
        //     'deli_data' => $path.''.$file,
        //     'title' => $file,
        //     'prog_id' => $prog_id,
        //     'area_id' => $area_id
        //     ]; 


        // // if($file{
        // //     DB::table('uploadmulti')->where("title", $file)
        // //     ->where('area_id', '=', $area)
        // //     ->where('prog_id', '=', $prog_id)
        // //     ->update($data);
        // //  }else {
        // //     DB::table('uploadmulti')->insert($data);
        // //  }


        //     // $input = $request->all();

        //     //check input value if exists or not in db...

        //      $b_exists = uploadmulti::where('title','=',$data['title'])->exists();

        //      if($b_exists){
        //      c
        //      }
        //      else{
        //      //
        //      // ....new data inserted 
        //     }







        $uploads = uploadmulti::where('title', '=', $file)
            ->where('area_id', '=', $area_id)
            ->where('prog_id', '=', $prog_id)
            ->first();
            if ($uploads === null) {
              $path = '/uploads_all/';
                return uploadmulti::create([
                    
                    'deli_data'=> $path.''.$file,
                    'title'=> $file,
                    'prog_id'=> $prog_id,
                    'area_id'=> $area_id,

                ]);
            } else {
              return response()->json([
                'msg'=>"Deliverable already exist!",
                ], 401);

            }

    }


     public function getProg_multi(){
        return program::where('id', '!=', '1')
        ->orderBy('id', 'ASC')
        ->get();

        
    }





    

    public function getUploadbyArea(Request $request, $id){


             $area=$id;
             
          
            // return \DB::table('uploadmulti')
            //     ->where('area_id', '=', $area)
            //     ->get();

            return \DB::table('uploadmulti')
            ->join('program', 'uploadmulti.prog_id', '=', 'program.id')
            ->select('uploadmulti.*', 'program.progName')
            ->where('area_id', '=', $area)
            ->orderBy('id', 'desc')
            ->get();



    }


     public function getUploadbyProg(Request $request, $prog_id, $area_id){
              
                $result = \DB::table('uploadmulti')
                        ->join('program', 'uploadmulti.prog_id', '=', 'program.id')
                        ->select('uploadmulti.*', 'program.progName')
                       ->where('area_id', '=', $area_id)
                       ->where(function ($query) use ($prog_id) {
                           $query->where('prog_id', $prog_id);
                       })
                       ->get();
                return $result; 
    } 

            







    //end




    public function upload(Request $request){
	    	$this->validate($request,[
	    		'file'=>'required|mimes:pdf'
	    	]);

    	 $deliverable = $request->file->getClientOriginalName();
    	 $request->file->move(public_path('uploads'),  $deliverable );
    	 return  $deliverable;
    }




    public function getProg(){
    	return program::orderBy('id', 'ASC')->get();
    }


   

    

    public function getArea(){
    	return area::orderBy('id', 'asc')->get();
    }

    

}
