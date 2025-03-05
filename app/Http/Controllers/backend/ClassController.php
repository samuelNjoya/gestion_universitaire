<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClassController extends Controller
{
    public function class_list(){
        $data['getRecord'] = ClassModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "class List";
        return view('backend.class.list', $data);
    }
    
    public function class_create(){
        $data['meta_title'] = "class Create";
        return view('backend.class.create', $data);
    }

    public function class_insert(Request $request){
      
        $save = new ClassModel;
        $save->name = trim($request->name);
        $save->status = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

      

        return redirect('panel/class')->with('success','class successifuly created');
    }

    public function class_edit($id){
        $data['getRecord'] = ClassModel::getSingle($id);
        $data['meta_title'] = "class Edit";
        return view('backend.class.edit', $data);
    }

    public function class_update($id,Request $request){
       
        $save = ClassModel::getSingle($id);
        $save->name = trim($request->name);
        $save->status = trim($request->status);
       
        $save->save();

       

        return redirect('panel/class')->with('success','class successifuly updated');
    }

    public function class_delete($id){
        $save = ClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/class')->with('error','class successifuly deleted');
    }
}
