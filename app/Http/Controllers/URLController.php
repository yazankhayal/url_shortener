<?php

namespace App\Http\Controllers;

use App\URLView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\URL;

class URLController extends Controller
{
    public function url_post(Request $request){

        //Check if any found
        if(URL::count() == 0){
            $search_num = parent::CheckCodeSearch("1111");
            $code  = "aardvark";
        }
        else{
            $las_item = URL::orderby("id","desc")->first();
            $search_num = parent::CheckCodeSearch($las_item->num);
            $code = parent::GetCode($search_num);
        }

        $validator = Validator::make($request->all(),$this->rules($request->url));
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $eventaddress = new URL();
        $eventaddress->link = $request->url;
        $eventaddress->desc = $request->desc;
        $eventaddress->code = $code;
        $eventaddress->num = $search_num;
        $eventaddress->user_id = Auth::user()->id;
        $eventaddress->save();

        return redirect()->route('index')->with('info','Created Successfully');
    }


    private function rules($url){
        $x= [
            'url' => 'required|url|max:191|string|unique:url,link,'.$url,
            'desc' => 'nullable|max:140|string',
        ];
        return $x;
    }

    public function url_view($code = null){
        $item = URL::where("code",$code)->first();
        if($item == null){
            return redirect()->route('index');
        }

        //Save Count IP
        $check = URLView::where([
            'url_id' => $item->id,
            'ip' =>parent::IP_Address(),
        ])->first();

        if($check == null){
            $save = new URLView();
            $save->url_id = $item->id;
            $save->ip = parent::IP_Address();
            $save->save();
        }

        return redirect()->to($item->link);
    }

}
