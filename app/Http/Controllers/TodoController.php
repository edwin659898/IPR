<?php

namespace App\Http\Controllers;

use App\todo;
use App\step;
use App\User;
use App\image;
use App\supplier;
use App\Notifications\IPR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;





class TodoController extends Controller
{
  public function __construct()
  {
    $this->middleware(['auth', 'verified']);
  }
 
  //TRACEIPR
  public function trace()
  {
    abort_if(!auth()->user()->slm,403,'Unauthorized Access');
    $todos = todo::all();
    return view('op.traceT')->with(['todos' => $todos]);
  }

  //DESTROYIPR
  public function destroy($id)
  {
    $todo = todo::findOrFail($id);
    $todo->image()->delete();
    $todo->step()->delete();
    $todo->delete();
    return back()->with('message', 'Deleted');
  }

 
  //FILE
  public function file($id)
  {
    $todos = image::findOrFail($id);
    $filename = $todos->image;
    $path = storage_path('app/public/images/' . $filename);
    return response()->file($path);
  }

  //FILEDESTROY
  public function fileDestroy($id)
  {
    abort_if(!auth()->user()->op, 404, 'Unauthorized action');

    $todos = image::findOrFail($id);
    $filename = $todos->image;
    $path = storage_path('app/public/images/' . $filename);
    if ($path) {
      unlink($path);
    }
    $todos->delete();
    Alert::success('All good', 'Item Deleted');
    return back();
  }

}
