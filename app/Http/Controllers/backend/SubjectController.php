<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SubjectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SubjectController extends Controller
{
    public function subject_list(){
        $data['getRecord'] = SubjectModel::getRecord(Auth::user()->id, Auth::user()->is_admin);
        $data['meta_title'] = "subject List";
        return view('backend.subject.list', $data);
    }
    
    public function subject_create(){
        $data['meta_title'] = "subject Create";
        return view('backend.subject.create', $data);
    }

    public function subject_insert(Request $request){
      
        $save = new SubjectModel;
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
        $save->created_by_id = Auth::user()->id;
        $save->save();

      

        return redirect('panel/subject')->with('success','subject successifuly created');
    }

    public function subject_edit($id){
        $data['getRecord'] = SubjectModel::getSingle($id);
        $data['meta_title'] = "subject Edit";
        return view('backend.subject.edit', $data);
    }

    public function subject_update($id,Request $request){
       
        $save = SubjectModel::getSingle($id);
        $save->name = trim($request->name);
        $save->type = trim($request->type);
        $save->status = trim($request->status);
       
        $save->save();

       

        return redirect('panel/subject')->with('success','subject successifuly updated');
    }

    public function subject_delete($id){
        $save = SubjectModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();

        return redirect('panel/subject')->with('error','subject successifuly deleted');
    }
}
