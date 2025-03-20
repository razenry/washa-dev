<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Guard
        if(Auth::user()->role != "Officer") return redirect()->route('dashboard.index');

        return view("admin.customer.index", [
            'transactionCount' => Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Guard
        if(Auth::user()->role != "Officer") return redirect()->route('dashboard.index');
        return view("admin.customer.create", [
            'transactionCount' => Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        // Guard
        if(Auth::user()->role != "Officer") return redirect()->route('dashboard.index');
        $transactionCount = Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count();
        return view("admin.customer.show", compact("customer", "transactionCount"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        // // Guard
        // if(Auth::user()->role != "Officer") return redirect()->route('dashboard.index');
        // return view("admin.customer.edit", compact("customer"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
