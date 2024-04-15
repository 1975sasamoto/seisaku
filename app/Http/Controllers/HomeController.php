<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $items=null;
        if($request->id){
            $items=Item::where("type",$request->id)
                ->orderbydesc("created_at")->limit(5)->get();
            
        }
        
        return view('home.index',compact('items'));
    }
}
