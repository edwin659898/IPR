<?php

namespace App\Http\Controllers;

use App\supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    //SUPPLIER
    public function supplier()
    {
        return view('supplier.Newsupplier');
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'company' => 'required',
            'box' => 'required',
            'contact' => 'required',
        ]);
        $iprs = supplier::Create([
            'company' => $request->company, 'box' => $request->box, 'code' => $request->code,
            'city' => $request->city, 'tel' => $request->tel, 'web' => $request->web, 'mail' => $request->mail,
            'contact' => $request->contact, 'nature' => $request->nature, 'location' => $request->location, 'account' => $request->account,
            'bank' => $request->bank, 'branch' => $request->branch, 'swift' => $request->swift, 'Scode' => $request->Scode,
            'number' => $request->number, 'till' => $request->till, 'bill' => $request->bill, 'Cduration' => $request->Cduration, 'Climit' => $request->Climit,
            'intro' => $request->intro, 'site' => $request->site, 'user_id' => auth()->id()
        ]);
        if ($request->hasfile('image')) {
            $filename = $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/images/', $filename);
            $iprs->update(['file' => $filename]);
        }

        Alert::success('All good', 'Supplier Saved Successfullly')->toToast();
        //mail
        return redirect()->back();
    }

    public function Mysuppliers()
    {
        $todos = supplier::where([
            ['user_id', '=', auth()->id()],
        ])
            ->get();
        return view('supplier.mysupplierT')->with(['todos' => $todos]);
    }

    public function showMySupplier($id)
    {
        $todos = supplier::find($id);
        return view('supplier.EditSupplier')->with(['todos' => $todos]);
    }

    public function updateMySupplier(Request $request, $id)
    {
        $iprs = supplier::findOrFail($id);
        abort_if($iprs->level == 'allowed', 403, 'Cannot Update');
        $iprs->update([
            'company' => $request->company, 'box' => $request->box, 'code' => $request->code,
            'city' => $request->city, 'tel' => $request->tel, 'web' => $request->web, 'mail' => $request->mail,
            'contact' => $request->contact, 'nature' => $request->nature, 'location' => $request->location, 'account' => $request->account,
            'bank' => $request->bank, 'branch' => $request->branch, 'swift' => $request->swift, 'Scode' => $request->Scode,
            'number' => $request->number, 'till' => $request->till, 'bill' => $request->bill, 'Cduration' => $request->Cduration, 'Climit' => $request->Climit,
            'intro' => $request->intro, 'site' => $request->site, 'user_id' => auth()->id(), 'level' => 'pending'
        ]);
        if ($request->hasfile('image')) {
            $filename = $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/images/', $filename);
            $iprs->update(['file' => $filename]);
        }

        Alert::success('All good', 'Supplier updated')->toToast();
        return redirect()->back();
    }

    public function viewSupplier()
    {
        abort_if(!auth()->user()->md,403,'Unauthorized access');
        $todos = supplier::where([
            ['level', '=', 'pending'],
        ])
            ->get();
        return view('supplier.supplierT')->with(['todos' => $todos]);
    }

    public function showSupplier($id)
    {
        $todos = supplier::find($id);
        return view('supplier.AuthSupplier')->with(['todos' => $todos]);
    }

    public function SupplierDoc($id)
    {
        $todos = supplier::find($id);
        $filename = $todos->file;
        $path = storage_path('app/public/images/' . $filename);
        return response()->file($path);
    }

    public function updateSupplier(Request $request, $id)
    {
        $iprs = supplier::find($id);
        switch ($request->input('action')) {
            case 'approve':
                $iprs->update(['level' => 'allowed']);
                break;
            case 'reject':
                $iprs->update(['level' => 'HOD declined']);
                break;
            }
        Alert::success('All good', 'Decision Updated Successfullly')->toToast();
        return redirect()->route('sup.viewSupplier');
    }

    public function approvedSupplier()
    {
        abort_if(!auth()->user()->op,403,'Unauthorized access');
        $todos = supplier::where([
            ['level', '=', 'allowed'],
        ])
            ->get();
        return view('supplier.printsupplierT')->with(['todos' => $todos]);
    }

    public function printSupplier($id)
    {
        $todos = supplier::find($id);
        return view('supplier.printsupplier')->with(['todos' => $todos]);
    }
}
