<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer= Customer::all();

        return view('customer', ['customer' => $customer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function scheduleDate(Request $request){
        $request->validate([
            'schedule_date'=> 'required',

        ]);
        $customer = Customer::updateOrCreate(['id' => $request->id], [
            'proposed_site_visit_date' => $request->schedule_date,
            'application_status' =>'site visit date set',
        ]);

        return response()->json(['code'=>200, 'message'=>'Application Created successfully','data' => $customer], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'       => 'required|max:255',
            'company_no' => 'required',
            'premise_type' => 'required',
            'house_no' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'district' => 'required',
            'state' => 'required',
            'email' => 'required',
            'contact_no' => 'required',
            'tnb_account_no' => 'required',
            'tnb_meter_no' => 'required',
            'equipment_examples' => 'required'
        ]);

       // echo $request->user()->name;
        $customer = Customer::updateOrCreate(['id' => $request->id], [
            'customer_name' => $request->customer_name,
            'company_no' => $request->company_no,
            'premise_type' => $request->premise_type,
            'house_no' => $request->house_no,
            'street' => $request->street,
            'postcode' => $request->postcode,
            'district' => $request->district,
            'state' => $request->state,
            'email' => $request->email,
            'contact_no' => $request->contact_no,
            'tnb_account_no' => $request->tnb_account_no,
            'tnb_meter_no' => $request->tnb_meter_no,
            'equipment_examples' => $request->equipment_examples,
            'address' => $request->street.' '.$request->house_no.' '.$request->postcode.' '.$request->district.' '.$request->state,
            'application_status' =>'pending',
            'created_by' => $request->user()->name
        ]);

        return response()->json(['code'=>200, 'message'=>'Application Created successfully','data' => $customer], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id)->delete();

        return response()->json(['success'=>'Application Deleted successfully']);
    }
}
