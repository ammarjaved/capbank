<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\site_visit_data;

class SitevisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sitevisitdata_form_func(Request $request)
    {
        // print_r($request->data);
        // $dsrc = DB::select("SELECT DISTINCT source_id, source_name
        // FROM space_tech.tbl_sources;");
        // return view('superadmin.Register', ['dsrc' => $dsrc]);
        $appid=$request->data;
        return view('sitevisitdata_form', ['appid' => $appid]);
    }
    public function store_sitevisitdata_form_func(Request $request)
    {
        // print_r($request->Mtr_verify_01);

        $svst_tbl = new site_visit_data();
        // customer_application_no, visit_date, meter_type, meter_verified, "pf_0.85", cap_ins, cap_func, customer_agree_ins, space, vehicle, install, warranty, vol_l1, vol_l2, vol_l3, cur_l1, cur_l2, cur_l3, pf_l1, pf_l2, pf_l3, rp_l1, rp_l2, rp_l3, mcb_size, img1_dbopen_01, img2_dbclose_01, img3_cbsize_01, img4_loccap_01, img5_capinst_01, img1_dbopen, img2_dbclose, img3_cbsize, img4_loccap, img5_capinst, xy, site_visit_status, date_created, created_by, load_profile, retail_verify_date, retail_verify_by, retail_rej_reason, es_verify_date, es_verify_by, es_rej_reason, quotation_amount, half_receipt_file, half_payment_amount, wo_gen_amount, wo_approved_file, rjo_gen_amount, rjo_approved_file, nti_dp_gen_amount, nti_dp_approved_file, acknowledgement_document, full_receipt_file, full_payment_amount, nti_ai_gen_amount, nti_ai_approved_file
        $svst_tbl->meter_type = $request->meter_type_select;
        $svst_tbl->meter_verified = $request->Mtr_verify_01;
        $svst_tbl->pf_0_85 = $request->pf_0_85_01;
        $svst_tbl->cap_ins = $request->cap_ins_01;
        $svst_tbl->cap_func =$request->cap_func_01;
        $svst_tbl->save();
        return back()->with('success', 'Admin has been Created succesfuly.');
    }
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
