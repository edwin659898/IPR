<?php

namespace App\Http\Controllers;

use App\todo;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ApprovedController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    //FINAL
    public function final()
    {
        abort_if(!auth()->user()->op,403,'Unauthorized access');
        $todos = todo::where(['status' =>'MD approved'])
            ->orWhere(['status' => 'MD approved-Building IPR'])
            ->orWhere(['status' => 'DFO approved'])
            ->orWhere(['status' => 'DFO approved-Building IPR'])
            ->orderBy('mdD', 'DESC')
            ->get();
        return view('approved.finalT')->with(['todos' => $todos]);
    }

    public function showFinal($id)
    {
        $user = auth()->user();
        $todos = todo::find($id);
        return view('approved.showFinal')->with(['todos' => $todos, 'user' => $user]);
    }

    public function attachment($id)
    {
        $todos = todo::find($id);
        return view('approved.imageFinal')->with(['todos' => $todos]);
    }

    public function complete(Request $request, $id)
    {
        $todos = todo::find($id);
        $todos->update(['printed' => true]);
        Alert::success('Done', 'Marked Printed')->toToast();
        return redirect()->back();
    }

    public function incomplete(Request $request, $id)
    {
        $todos = todo::find($id);
        $todos->update(['printed' => false]);
        return redirect()->back()->with('message', 'Marked unprinted');
    }
}
