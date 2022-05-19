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
        if ($request->hasFile('img1_dbopen')) {
        $fileName_img1_dbopen = $request->img1_dbopen->getClientOriginalName();
        $filePath_img1_dbopen = $request->img1_dbopen->move(public_path('uploads'), $fileName_img1_dbopen);
        $image_access_path_img1_dbopen = "uploads/".$fileName_img1_dbopen;
        }
        if ($request->hasFile('img1_dbopen_01')) {
        $fileName_img1_dbopen_01 = $request->img1_dbopen_01->getClientOriginalName();
        $filePath_img1_dbopen_01 = $request->img1_dbopen_01->move(public_path('uploads'), $fileName_img1_dbopen_01);
        $image_access_path_img1_dbopen_01 = "uploads/".$fileName_img1_dbopen_01;
        }

        if ($request->hasFile('img2_dbclose')) {
        $fileName_img2_dbclose = $request->img2_dbclose->getClientOriginalName();
        $filePath_img2_dbclose = $request->img2_dbclose->move(public_path('uploads'), $fileName_img2_dbclose);
        $image_access_path_img2_dbclose = "uploads/".$fileName_img2_dbclose;
        }
        if ($request->hasFile('img2_dbclose_01')) {
        $fileName_img2_dbclose_01 = $request->img2_dbclose_01->getClientOriginalName();
        $filePath_img2_dbclose_01 = $request->img2_dbclose_01->move(public_path('uploads'), $fileName_img2_dbclose_01);
        $image_access_path_img2_dbclose_01 = "uploads/".$fileName_img2_dbclose_01;
        }
        
        if ($request->hasFile('img3_cbsize')) {
        $fileName_img3_cbsize = $request->img3_cbsize->getClientOriginalName();
        $filePath_img3_cbsize = $request->img3_cbsize->move(public_path('uploads'), $fileName_img3_cbsize);
        $image_access_path_img3_cbsize = "uploads/".$fileName_img3_cbsize;
        }
        if ($request->hasFile('img3_cbsize_01')) {
        $fileName_img3_cbsize_01 = $request->img3_cbsize_01->getClientOriginalName();
        $filePath_img3_cbsize_01 = $request->img3_cbsize_01->move(public_path('uploads'), $fileName_img3_cbsize_01);
        $image_access_path_img3_cbsize_01 = "uploads/".$fileName_img3_cbsize_01;
        }
      

        if ($request->hasFile('img4_loccap')) {
        $fileName_img4_loccap = $request->img4_loccap->getClientOriginalName();
        $filePath_img4_loccap = $request->img4_loccap->move(public_path('uploads'), $fileName_img4_loccap);
        $image_access_path_img4_loccap = "uploads/".$fileName_img4_loccap;
        }
        
        if ($request->hasFile('img4_loccap_01')) {
        $fileName_img4_loccap_01 = $request->img4_loccap_01->getClientOriginalName();
        $filePath_img4_loccap_01 = $request->img4_loccap_01->move(public_path('uploads'), $fileName_img4_loccap_01);
        $image_access_path_img4_loccap_01 = "uploads/".$fileName_img4_loccap_01;
        }
        if ($request->hasFile('img5_capinst')) {
        $fileName_img5_capinst = $request->img5_capinst->getClientOriginalName();
        $filePath_img5_capinst = $request->img5_capinst->move(public_path('uploads'), $fileName_img5_capinst);
        $image_access_path_img5_capinst = "uploads/".$fileName_img5_capinst;
        }
        if ($request->hasFile('img5_capinst_01')) {
        $fileName_img5_capinst_01 = $request->img5_capinst_01->getClientOriginalName();
        $filePath_img5_capinst_01 = $request->img5_capinst_01->move(public_path('uploads'), $fileName_img5_capinst_01);
        $image_access_path_img5_capinst_01 = "uploads/".$fileName_img5_capinst_01;
        }

        

        

        // print_r($image_access_path);

        $svst_tbl = new site_visit_data();
        // customer_application_no, visit_date, meter_type, meter_verified, "pf_0.85", cap_ins, cap_func, customer_agree_ins, space, vehicle, install, warranty, 
        // vol_l1, vol_l2, vol_l3, cur_l1, cur_l2, cur_l3, pf_l1, pf_l2, pf_l3, rp_l1, rp_l2, rp_l3, 
        // mcb_size, img1_dbopen_01, img2_dbclose_01, img3_cbsize_01, img4_loccap_01, img5_capinst_01, img1_dbopen, img2_dbclose, img3_cbsize, img4_loccap, img5_capinst, xy, site_visit_status, date_created, created_by, load_profile, retail_verify_date, retail_verify_by, retail_rej_reason, es_verify_date, es_verify_by, es_rej_reason, quotation_amount, half_receipt_file, half_payment_amount, wo_gen_amount, wo_approved_file, rjo_gen_amount, rjo_approved_file, nti_dp_gen_amount, nti_dp_approved_file, acknowledgement_document, full_receipt_file, full_payment_amount, nti_ai_gen_amount, nti_ai_approved_file
        $svst_tbl->meter_type = $request->site_app_id1;
        $svst_tbl->meter_type = $request->meter_type_select;
        $svst_tbl->meter_verified = $request->Mtr_verify_01;
        $svst_tbl->pf_0_85 = $request->pf_0_85_01;
        $svst_tbl->cap_ins = $request->cap_ins_01;
        $svst_tbl->customer_agree_ins =$request->cust_agree_ins_01;
        $svst_tbl->space =$request->space_01;
        $svst_tbl->vehicle =$request->vehicle_01;
        $svst_tbl->install =$request->install_select;
        $svst_tbl->warranty =$request->warranty_12_select;
        $svst_tbl->vol_l1 =$request->Vol_L1;
        $svst_tbl->vol_l2 =$request->Vol_L2;
        $svst_tbl->vol_l3 =$request->Vol_L3;
        $svst_tbl->cur_l1 =$request->Cur_L1;
        $svst_tbl->cur_l2 =$request->Cur_L2;
        $svst_tbl->cur_l3 =$request->Cur_L3;
        $svst_tbl->pf_l1 =$request->pf_L1;
        $svst_tbl->pf_l2 =$request->pf_L2;
        $svst_tbl->pf_l3 =$request->pf_L3;
        $svst_tbl->rp_l1 =$request->rp_L1;
        $svst_tbl->rp_l2 =$request->rp_L2;
        $svst_tbl->rp_l3 =$request->rp_L3;
        $svst_tbl->mcb_size =$request->MCB_Size;
        if ($request->hasFile('img1_dbopen')) {
        $svst_tbl->img1_dbopen =$image_access_path_img1_dbopen;
        }
        if ($request->hasFile('img1_dbopen_01')) {
        $svst_tbl->img1_dbopen_01 =$image_access_path_img1_dbopen_01;
        }
        if ($request->hasFile('img2_dbclose')) {
            $svst_tbl->img2_dbclose =$image_access_path_img2_dbclose;
        }
        if ($request->hasFile('img2_dbclose_01')) {
            $svst_tbl->img2_dbclose_01 =$image_access_path_img2_dbclose_01;
        }
        if ($request->hasFile('img3_cbsize')) {
        $svst_tbl->img3_cbsize =$image_access_path_img3_cbsize;
        }
        if ($request->hasFile('img3_cbsize_01')) {
        $svst_tbl->img3_cbsize_01 =$image_access_path_img3_cbsize_01;
        }
        if ($request->hasFile('img4_loccap')) {
        $svst_tbl->img4_loccap =$image_access_path_img4_loccap;
        }
        if ($request->hasFile('img4_loccap_01')) {
        $svst_tbl->img4_loccap_01 =$image_access_path_img4_loccap_01;
        }
        if ($request->hasFile('img5_capinst')) {
            $svst_tbl->img5_capinst =$image_access_path_img5_capinst;
        }
        if ($request->hasFile('img5_capinst_01')) {
            $svst_tbl->img5_capinst_01 =$image_access_path_img5_capinst_01;
        }
        // $svst_tbl->Elec_bill_6mo =$request->Elec_bill_6mo;
        $svst_tbl->xy =$request->location_x_y;
        $svst_tbl->save();
        return back()->with('success', 'Site data has been Created succesfuly.');
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
