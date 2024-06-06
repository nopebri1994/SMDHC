<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\keteranganIjinModel;
use Illuminate\Support\Facades\Validator;


class keteranganIjinController extends Controller
{
    public function index(){
       
        $data = [
            // 'dataTable' => keteranganIjinModel::paginate(5),
            'title'=>'Data Keterangan Ijin ',
        ];

 
        return view('keteranganIjin/v_keteranganIjin',$data);
    }

    function tabelData(Request $request){
        
        $data=[
            'dataTable'=>keteranganIjinModel::orderByDesc('id')->paginate(10),
        ];
        
        //pagination ajax
        if($request->ajax()){
            return view('keteranganIjin/tabelKeteranganIjin',$data);
        }
        return view('dataTable',$data);
        //end
    } 

    function insert(Request $request){
        
        //validasi
        // $this->validate($request,[
        //     'kode'=>'required|unique:keteranganijin',
        // ]);
        $validator = Validator::make($request->all(), 
        [
            'kode'=>'required|unique:keteranganijin',
        ],
        $messages = [
            'required' => 'Input data tidak boleh Kosong.',
            'unique'=>'Kode tidak Boleh sama',
        ])->validate();

  
        //ambilData
        keteranganIjinModel::create([
            'kode' => $request->kode,
            'status' =>$request->status,
            'keterangan'=>$request->keterangan,
        ]);

        $sendToView = array(
            'status' =>1,
        );
        echo json_encode($sendToView);
        
    }

}
