<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>
</head>
<style>
    .alert-message {
        color: red;
    }
</style>
<body>
<div id="app">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/customer') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            </div>

{{--            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
{{--                <span class="navbar-toggler-icon"></span>--}}
{{--            </button>--}}
            <div class="dropdown" style="margin-top: 5px;float: right;">
                @if(@isset(Auth::user()->name))
                <button class="btn  dropdown-toggle"  type="button" data-toggle="dropdown">{{ Auth::user()->name }}
                    <span class="caret"></span></button>
                @else
                    <script>window.location = "/login";</script>                @endif
                <ul class="dropdown-menu">
                    <li> <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>


        </div>
    </nav>
<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Customer Application Creation
    </h2><br>
    <div class="row">
        <div class="col-12 text-right">
            <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post" onclick="addPost()">Add Post</a>
        </div>
    </div>
    <div class="row" style="clear: both;margin-top: 18px;width: 100%;overflow: scroll;">
        <div class="col-12">
            <table id="customer_app" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Application Number</th>
                    <th>Customer Name</th>
                    <th>Company Name</th>
                    <th>Premise Type</th>
                    <th>house_no</th>
                    <th>street</th>
                    <th>postcode</th>
                    <th>district</th>
                    <th>state</th>
                    <th>email</th>
                    <th>contact_no</th>
                    <th>tnb_meter_no</th>
                    <th>equipment_examples</th>
                    <th>address</th>
                    <th>Application Status</th>
                    <th>Proposed Site Visit Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Schedule site vist</th>

                </tr>
                </thead>
                <tbody>
                @foreach($customer as $post)
                    <tr id="row_{{$post->id}}">
                        <td>{{ $post->id  }}</td>
                        <td>{{ $post->application_no }}</td>
                        <td>{{ $post->customer_name }}</td>
                        <td>{{ $post->company_no }}</td>
                        <td>{{ $post->premise_type }}</td>
                        <td>{{ $post->house_no }}</td>
                        <td>{{ $post->street }}</td>
                        <td>{{ $post->postcode }}</td>
                        <td>{{ $post->district }}</td>
                        <td>{{ $post->state }}</td>
                        <td>{{ $post->email }}</td>
                        <td>{{ $post->contact_no }}</td>
                        <td>{{ $post->tnb_meter_no }}</td>
                        <td>{{ $post->equipment_examples }}</td>
                        <td>{{ $post->address }}</td>
                        <td>{{ $post->application_status }}</td>
                        <td>{{ $post->proposed_site_visit_date }}</td>



                        <td><a href="javascript:void(0)" data-id="{{ $post->id }}" onclick="editPost(event.target)" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a>
                        </td>
                        <td>
                            <a href="javascript:void(0)" data-id="{{ $post->id }}" class="btn btn-warning" onclick="addScheduleSiteVist(event.target)">Schedule/Redchedule site Vist</a>
                        </td>
                        <td>
                            <a href="{{ url('/sitevisitdata_form/'.$post->application_no )}}" data-id="{{ $post->id }}" class="btn btn-primary">Add Site Visited Data</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="post-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form name="userForm" class="form-horizontal">
                    <input type="hidden" name="app_id" id="app_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2">customer_name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="customer name">
                            <span id="titleError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">company_no</label>
                        <div class="col-sm-12">
                        <input class="form-control" id="company_no" name="company_no" placeholder="company no" rows="4" cols="50">

                            <span id="descriptionError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">premise_type</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="premise_type" name="premise_type" placeholder="premise type" rows="4" cols="50">

                            <span id="premise_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">house_no</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="house_no" name="house_no" placeholder="house no" rows="4" cols="50">

                            <span id="house_no_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">street</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="street" name="street" placeholder="street" rows="4" cols="50">

                            <span id="street_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">postcode</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="postcode" name="postcode" placeholder="postcode" rows="4" cols="50">

                            <span id="postcode_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">district</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="district" name="district" placeholder="district" rows="4" cols="50">

                            <span id="district_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">state</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="state" name="state" placeholder="postcode" rows="4" cols="50">

                            <span id="state_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">email</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="email" name="email" placeholder="email" rows="4" cols="50">

                            <span id="email_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">contact_no</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="contact_no" name="contact_no" placeholder="contact_no" rows="4" cols="50">

                            <span id="contact_no_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">tnb_account_no</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="tnb_account_no" name="tnb_account_no" placeholder="tnb_account_no" rows="4" cols="50">

                            <span id="tnb_account_no_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">tnb_meter_no</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="tnb_meter_no" name="tnb_meter_no" placeholder="tnb_meter_no" rows="4" cols="50">

                            <span id="tnb_meter_no_typeError" class="alert-message"></span>
                        </div>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label class="col-sm-2">address</label>--}}
{{--                        <div class="col-sm-12">--}}
{{--                            <input class="form-control" id="address" name="address" placeholder="address" rows="4" cols="50">--}}

{{--                            <span id="address_typeError" class="alert-message"></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <label class="col-sm-2">equipment_examples</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="equipment_examples" name="equipment_examples" placeholder="equipment_examples" rows="4" cols="50">

                            <span id="equipment_examples_typeError" class="alert-message"></span>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="createPost()">Save</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="visit_site_post_data_model" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form name="userForm" class="form-horizontal">
                    <input type="hidden" name="site_app_id1" id="site_app_id1">
                    <div class="form-group">
                        <label for="name" class="col-sm-2">meter_type</label>
                        <div class="col-sm-12">
                            <select id="meter_type_select" name="meter_type_select" class = "form-control">
                                <option value="" disabled="" selected="">-- Select Meter Type --</option>
                                <option value="smart_meter">Smart Meter</option>
                                <option value="normal_meter">Normal Meter</option>
                            </select>
                            <span id="titleError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Mtr_verify_01</label>
                        <div class="col-sm-12">
                        <input class="form-control" id="Mtr_verify_01" name="Mtr_verify_01" placeholder="Mtr_verify_01 no" rows="4" cols="50">
                            <span id="descriptionError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">pf_0.85_01</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="pf_0.85_01" name="pf_0.85_01" placeholder="pf_0.85_01" rows="4" cols="50">

                            <span id="premise_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">cap_ins_01</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="cap_ins_01" name="cap_ins_01" placeholder="cap_ins_01" rows="4" cols="50">

                            <span id="house_no_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">cap_func_01</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="cap_func_01" name="cap_func_01" placeholder="cap_func_01" rows="4" cols="50">

                            <span id="street_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">cust_agree_ins_01</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="cust_agree_ins_01" name="cust_agree_ins_01" placeholder="cust_agree_ins_01" rows="4" cols="50">

                            <span id="postcode_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">space_01</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="space_01" name="space_01" placeholder="space_01" rows="4" cols="50">

                            <span id="district_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">vehicle_01</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="vehicle_01" name="vehicle_01" placeholder="vehicle_01" rows="4" cols="50">

                            <span id="state_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2">Install</label>
                        <div class="col-sm-12">
                            <select id="install_select" name="install_select" class = "form-control">
                                <option value="" disabled="" selected="">-- Select Install Type --</option>
                                <option value="indoor">Indoor</option>
                                <option value="outdoor">Outdoor</option>
                            </select>
                            <span id="titleError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2">warranty_12</label>
                        <div class="col-sm-12">
                            <select id="warranty_12_select" name="warranty_12_select" class = "form-control">
                                <option value="" disabled="" selected="">-- Select warranty Type --</option>
                                <option value="1_year">1 Year</option>
                                <option value="2_year">2 Year</option>
                            </select>
                            <span id="warranty_12_select_Error" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Vol_L1</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="Vol_L1" name="Vol_L1" placeholder="Vol_L1" rows="4" cols="50">

                            <span id="Vol_L1_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Vol_L2</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="Vol_L2" name="Vol_L2" placeholder="Vol_L2" rows="4" cols="50">

                            <span id="Vol_L2_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Vol_L3</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="Vol_L3" name="Vol_L3" placeholder="Vol_L3" rows="4" cols="50">

                            <span id="Vol_L3_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Cur_L1</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="Cur_L1" name="Cur_L1" placeholder="Cur_L1" rows="4" cols="50">

                            <span id="Cur_L1_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Cur_L2</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="Cur_L2" name="Cur_L2" placeholder="Cur_L2" rows="4" cols="50">

                            <span id="Cur_L2_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Cur_L3</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="Cur_L3" name="Cur_L3" placeholder="Cur_L3" rows="4" cols="50">

                            <span id="Cur_L3_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">pf_L1</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="pf_L1" name="pf_L1" placeholder="pf_L1" rows="4" cols="50">

                            <span id="pf_L1_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">pf_L2</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="pf_L2" name="pf_L2" placeholder="pf_L2" rows="4" cols="50">

                            <span id="pf_L2_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">pf_L3</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="pf_L3" name="pf_L3" placeholder="pf_L3" rows="4" cols="50">

                            <span id="pf_L3_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">rp_L1</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="rp_L1" name="rp_L1" placeholder="rp_L1" rows="4" cols="50">

                            <span id="rp_L1_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">rp_L2</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="rp_L2" name="rp_L2" placeholder="rp_L2" rows="4" cols="50">

                            <span id="rp_L2_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">rp_L3</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="rp_L3" name="rp_L3" placeholder="rp_L3" rows="4" cols="50">

                            <span id="rp_L3_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2">MCB_Size</label>
                        <div class="col-sm-12">
                            <select id="mcb_size_select" name="mcb_size_select" class = "form-control">
                                <option value="" disabled="" selected="">-- Select mcb_size --</option>
                                <option value="40">40</option>
                                <option value="60">60</option>
                                <option value="63">63</option>
                                <option value="100">100</option>
                                <option value="300">300</option>
                                <option value="other">Other</option>
                            </select>
                            <span id="warranty_12_select_Error" class="alert-message"></span>
                        </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-sm-2">img1_dbopen_01</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img1_dbopen_01" name="img1_dbopen_01" placeholder="img1_dbopen_01" rows="4" cols="50">

                            <span id="img1_dbopen_01_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img2_dbclose_01</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img2_dbclose_01" name="img2_dbclose_01" placeholder="img2_dbclose_01" rows="4" cols="50">

                            <span id="img2_dbclose_01_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img3_cbsize_01</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img3_cbsize_01" name="img3_cbsize_01" placeholder="img3_cbsize_01" rows="4" cols="50">

                            <span id="img3_cbsize_01_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img4_loccap_01</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img4_loccap_01" name="img4_loccap_01" placeholder="img4_loccap_01" rows="4" cols="50">

                            <span id="img4_loccap_01_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img5_capinst_01</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img5_capinst_01" name="img5_capinst_01" placeholder="img5_capinst_01" rows="4" cols="50">

                            <span id="img5_capinst_01_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">img1_dbopen</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img1_dbopen" name="img1_dbopen" placeholder="img1_dbopen" rows="4" cols="50">

                            <span id="img1_dbopen_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img2_dbclose</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img2_dbclose" name="img2_dbclose" placeholder="img2_dbclose" rows="4" cols="50">

                            <span id="img2_dbclose_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img3_cbsize</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img3_cbsize" name="img3_cbsize" placeholder="img3_cbsize" rows="4" cols="50">

                            <span id="img3_cbsize_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img4_loccap</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img4_loccap" name="img4_loccap" placeholder="img4_loccap" rows="4" cols="50">

                            <span id="img4_loccap_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">img5_capinst</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="img5_capinst" name="img5_capinst" placeholder="img5_capinst" rows="4" cols="50">

                            <span id="img5_capinst_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">Elec_bill_6mo</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="Elec_bill_6mo" name="Elec_bill_6mo" placeholder="Elec_bill_6mo" rows="4" cols="50">

                            <span id="Elec_bill_6mo_typeError" class="alert-message"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2">location(x,y)</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="location_x_y" name="location_x_y" placeholder="location(x,y)" rows="4" cols="50">

                            <span id="location_x_y_typeError" class="alert-message"></span>
                        </div>
                    </div>

                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="createPost()">Save</button>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="post-modal1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form name="userForm" class="form-horizontal">
                        <input type="hidden" name="app_id" id="app_id1">
                        <div class="form-group">
                            <label for="name" class="col-sm-2">customer_name</label>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" id="schedule_date" name="schedule_date" placeholder="schedule_date">
                                <span id="schedule_dateError" class="alert-message"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="scheduleSiteVist(event.target)">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<script>
    $('#customer_app').DataTable();

    function addPost() {
        $("#app_id").val('');
        $('#post-modal').modal('show');
    }
    function addScheduleSiteVist(event) {
        var id  = $(event).data("id");
        $("#app_id1").val(id);
        $('#post-modal1').modal('show');
    }



    function sitevisitdataform(event) {
        var id  = $(event).data("id");
        let _url = `/sitevisitdata_form/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: id,
                _token: _token
            },
            success: function(response) {
                if(response.code == 200) {
                    
                }
            },
            error: function(response){
                
            }
        });
        // var id  = $(event).data("id");
        // $("#site_app_id1").val(id);
        // $('#visit_site_post_data_model').modal('show');
    }

    function editPost(event) {
        var id  = $(event).data("id");
        let _url = `/customer/${id}`;
        $('#titleError').text('');
        $('#descriptionError').text('');
        $('#premise_typeError').text('');

        $.ajax({
            url: _url,
            type: "GET",
            success: function(response) {
                if(response) {
                    $("#app_id").val(response.id);
                    $("#customer_name").val(response.customer_name);
                    $("#company_no").val(response.company_no);
                    $("#premise_type").val(response.premise_type);
                    $('#house_no').val(response.house_no)
                    $('#street').val(response.street);
                    $('#postcode').val(response.postcode)
                    $('#district').val(response.district)
                    $('#state').val(response.state);
                    $('#email').val(response.email);
                    $('#contact_no').val(response.contact_no);
                    $('#tnb_account_no').val(response.tnb_account_no);
                    $('#tnb_meter_no').val(response.tnb_meter_no);
                    $('#equipment_examples').val(response.equipment_examples);
                    $('#post-modal').modal('show');
                }
            }
        });
    }

    function scheduleSiteVist(event) {

        $('#post-modal1').modal('hide');
        var id=$("#app_id1").val();
        var schedule_date = $('#schedule_date').val();

         let _url     = `/scheduledate/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: id,
                schedule_date: schedule_date,
                _token: _token
            },
            success: function(response) {
                if(response.code == 200) {
                    $('#post-modal1').modal('hide');
                }
            },
            error: function(response){
                $('#schedule_dateError').text(response.responseJSON.errors.proposed_site_visit_date);
            }
        });
    }

    function createPost() {
        var customer_name = $('#customer_name').val();
        var company_no = $('#company_no').val();
        var premise_type = $('#premise_type').val();

        var house_no = $('#house_no').val();
        var street = $('#street').val();
        var postcode = $('#postcode').val();

        var district = $('#district').val();
        var state = $('#state').val();
        var email = $('#email').val();

        var contact_no = $('#contact_no').val();
        var tnb_account_no = $('#tnb_account_no').val();
        var tnb_meter_no = $('#tnb_meter_no').val();

        var equipment_examples = $('#equipment_examples').val();



        var id = $('#app_id').val();

        let _url     = `/customer`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                id: id,
                customer_name: customer_name,
                company_no: company_no,
                premise_type: premise_type,
                house_no: house_no,
                street: street,
                postcode: postcode,
                district: district,
                state: state,
                email: email,
                contact_no: contact_no,
                tnb_account_no: tnb_account_no,
                tnb_meter_no: tnb_meter_no,
                equipment_examples: equipment_examples,
                _token: _token
            },
            success: function(response) {
                if(response.code == 200) {
                    if(id != ""){
                        $("#row_"+id+" td:nth-child(2)").html(response.data.customer_name);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.company_no);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.premise_type);

                        $("#row_"+id+" td:nth-child(2)").html(response.data.house_no);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.street);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.postcode);

                        $("#row_"+id+" td:nth-child(2)").html(response.data.district);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.state);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.email);

                        $("#row_"+id+" td:nth-child(2)").html(response.data.contact_no);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.tnb_account_no);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.tnb_meter_no);
                        $("#row_"+id+" td:nth-child(3)").html(response.data.equipment_examples);

                    } else {
                        $('table tbody').prepend('<tr id="row_'+response.data.id+'"><td>'+response.data.id+'</td><td>'+response.data.customer_name+
                            '</td><td>'+response.data.company_no+ '</td>' +
                            '<td>'+response.data.house_no+'</td>' +
                            '<td>'+response.data.postcode+'</td>' +
                            '<td>'+response.data.district+'</td>' +
                            '<td>'+response.data.state+'</td>' +
                            '<td>'+response.data.email+'</td>' +

                            '<td>'+response.data.contact_no+'</td>' +
                            '<td>'+response.data.tnb_account_no+'</td>' +
                            '<td>'+response.data.tnb_meter_no+'</td>' +
                            '<td>'+response.data.equipment_examples+'</td>' +


                            '<td><a href="javascript:void(0)" data-id="'+response.data.id+'" onclick="editPost(event.target)" class="btn btn-info">Edit</a></td><td><a href="javascript:void(0)" data-id="'+response.data.id+'" class="btn btn-danger" onclick="deletePost(event.target)">Delete</a></td></tr>');
                    }

                    $('#customer_name').val('');
                    $('#company_no').val('');
                    $('#premise_type').val('');

                    $('#house_no').val('');
                    $('#street').val('');
                    $('#postcode').val('');

                    $('#district').val('');
                    $('#state').val('');
                    $('#email').val('');

                    $('#contact_no').val('');
                    $('#tnb_account_no').val('');
                    $('#tnb_meter_no').val('');
                    $('#equipment_examples').val('');



                    $('#post-modal').modal('hide');
                }
            },
            error: function(response){

                $('#titleError').text(response.responseJSON.errors.customer_name);
                $('#descriptionError').text(response.responseJSON.errors.company_no);
                $('#premise_typeError').text(response.responseJSON.errors.premise_type);
                $('#house_no_typeError').text(response.responseJSON.errors.house_no);
                $('#street_typeError').text(response.responseJSON.errors.street);
                $('#postcode_typeError').text(response.responseJSON.errors.postcode);
                $('#district_typeError').text(response.responseJSON.errors.district);
                $('#state_typeError').text(response.responseJSON.errors.state);
                $('#email_typeError').text(response.responseJSON.errors.email);
                $('#contact_no_typeError').text(response.responseJSON.errors.contact_no);
                $('#tnb_account_no_typeError').text(response.responseJSON.errors.tnb_account_no);
                $('#tnb_meter_no_typeError').text(response.responseJSON.errors.tnb_meter_no);
                $('#equipment_examples_typeError').text(response.responseJSON.errors.equipment_examples);



    }
        });
    }

    function deletePost(event) {
        var id  = $(event).data("id");
        let _url = `/customer/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
                _token: _token
            },
            success: function(response) {
                $("#row_"+id).remove();
            }
        });
    }

</script>
