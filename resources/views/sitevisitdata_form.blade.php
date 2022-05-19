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
    <h2 style="margin-top: 12px;" class="alert alert-success">Add Site Visit Data
    </h2><br>
  
    

 <!-- Success message -->
 @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

<form  action="{{url('/store_sitevisitdata_form')}}" method="POST" enctype="multipart/form-data" name="userForm" class="form-horizontal">
    @csrf
    
    <input type="hidden" name="site_app_id1" id="site_app_id1" value="{{ $appid }}">
   
    
    <div class="form-group">
        <label for="name" class="col-sm-2">meter_type</label>
        <div class="col-sm-12">
            <select id="meter_type_select" name="meter_type_select" class = "form-control" required>
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
        <input class="form-control" id="Mtr_verify_01" name="Mtr_verify_01" placeholder="Mtr_verify_01 no" rows="4" cols="50" required>
            <span id="descriptionError" class="alert-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2">pf_0.85_01</label>
        <div class="col-sm-12">
            <input class="form-control" id="pf_0_85_01" name="pf_0_85_01" placeholder="pf_0.85_01" rows="4" cols="50" required>

            <span id="premise_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">cap_ins_01</label>
        <div class="col-sm-12">
            <input class="form-control" id="cap_ins_01" name="cap_ins_01" placeholder="cap_ins_01" rows="4" cols="50" required>

            <span id="house_no_typeError" class="alert-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2">cap_func_01</label>
        <div class="col-sm-12">
            <input class="form-control" id="cap_func_01" name="cap_func_01" placeholder="cap_func_01" rows="4" cols="50" required>

            <span id="street_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">cust_agree_ins_01</label>
        <div class="col-sm-12">
            <input class="form-control" id="cust_agree_ins_01" name="cust_agree_ins_01" placeholder="cust_agree_ins_01" rows="4" cols="50" required>

            <span id="postcode_typeError" class="alert-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2">space_01</label>
        <div class="col-sm-12">
            <input class="form-control" id="space_01" name="space_01" placeholder="space_01" rows="4" cols="50" required>

            <span id="district_typeError" class="alert-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2">vehicle_01</label>
        <div class="col-sm-12">
            <input class="form-control" id="vehicle_01" name="vehicle_01" placeholder="vehicle_01" rows="4" cols="50" required>

            <span id="state_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">Install</label>
        <div class="col-sm-12">
            <select id="install_select" name="install_select"  class = "form-control" required>
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
            <select id="warranty_12_select" name="warranty_12_select"  class = "form-control" required>
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
            <input class="form-control" id="Vol_L1" name="Vol_L1" placeholder="Vol_L1" rows="4" cols="50" required>

            <span id="Vol_L1_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">Vol_L2</label>
        <div class="col-sm-12">
            <input class="form-control" id="Vol_L2" name="Vol_L2" placeholder="Vol_L2" rows="4" cols="50" required>

            <span id="Vol_L2_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">Vol_L3</label>
        <div class="col-sm-12">
            <input class="form-control" id="Vol_L3" name="Vol_L3" placeholder="Vol_L3" rows="4" cols="50" required>

            <span id="Vol_L3_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">Cur_L1</label>
        <div class="col-sm-12">
            <input class="form-control" id="Cur_L1" name="Cur_L1" placeholder="Cur_L1" rows="4" cols="50" required>

            <span id="Cur_L1_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">Cur_L2</label>
        <div class="col-sm-12">
            <input class="form-control" id="Cur_L2" name="Cur_L2" placeholder="Cur_L2" rows="4" cols="50" required>

            <span id="Cur_L2_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">Cur_L3</label>
        <div class="col-sm-12">
            <input class="form-control" id="Cur_L3" name="Cur_L3" placeholder="Cur_L3" rows="4" cols="50" required>

            <span id="Cur_L3_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">pf_L1</label>
        <div class="col-sm-12">
            <input class="form-control" id="pf_L1" name="pf_L1" placeholder="pf_L1" rows="4" cols="50" required>

            <span id="pf_L1_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">pf_L2</label>
        <div class="col-sm-12">
            <input class="form-control" id="pf_L2" name="pf_L2" placeholder="pf_L2" rows="4" cols="50" required>

            <span id="pf_L2_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">pf_L3</label>
        <div class="col-sm-12">
            <input class="form-control" id="pf_L3" name="pf_L3" placeholder="pf_L3" rows="4" cols="50" required>

            <span id="pf_L3_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">rp_L1</label>
        <div class="col-sm-12">
            <input class="form-control" id="rp_L1" name="rp_L1" placeholder="rp_L1" rows="4" cols="50" required>

            <span id="rp_L1_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">rp_L2</label>
        <div class="col-sm-12">
            <input class="form-control" id="rp_L2" name="rp_L2" placeholder="rp_L2" rows="4" cols="50" required>

            <span id="rp_L2_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">rp_L3</label>
        <div class="col-sm-12">
            <input class="form-control" id="rp_L3" name="rp_L3" placeholder="rp_L3" rows="4" cols="50" required>

            <span id="rp_L3_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label for="name" class="col-sm-2">MCB_Size</label>
        <div class="col-sm-12">
            <select id="mcb_size_select" name="mcb_size_select"  class = "form-control" required>
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
            <input type="file" class="form-control" id="img1_dbopen_01" name="img1_dbopen_01" placeholder="img1_dbopen_01" rows="4" cols="50" required>

            <span id="img1_dbopen_01_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img2_dbclose_01</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img2_dbclose_01" name="img2_dbclose_01" placeholder="img2_dbclose_01" rows="4" cols="50" required>

            <span id="img2_dbclose_01_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img3_cbsize_01</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img3_cbsize_01" name="img3_cbsize_01" placeholder="img3_cbsize_01" rows="4" cols="50" required>

            <span id="img3_cbsize_01_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img4_loccap_01</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img4_loccap_01" name="img4_loccap_01" placeholder="img4_loccap_01" rows="4" cols="50" required>

            <span id="img4_loccap_01_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img5_capinst_01</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img5_capinst_01" name="img5_capinst_01" placeholder="img5_capinst_01" rows="4" cols="50" required>

            <span id="img5_capinst_01_typeError" class="alert-message"></span>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2">img1_dbopen</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img1_dbopen" name="img1_dbopen" placeholder="img1_dbopen" rows="4" cols="50" required>

            <span id="img1_dbopen_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img2_dbclose</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img2_dbclose" name="img2_dbclose" placeholder="img2_dbclose" rows="4" cols="50" required>

            <span id="img2_dbclose_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img3_cbsize</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img3_cbsize" name="img3_cbsize" placeholder="img3_cbsize" rows="4" cols="50" required>

            <span id="img3_cbsize_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img4_loccap</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img4_loccap" name="img4_loccap" placeholder="img4_loccap" rows="4" cols="50" required>

            <span id="img4_loccap_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2">img5_capinst</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="img5_capinst" name="img5_capinst" placeholder="img5_capinst" rows="4" cols="50" required>

            <span id="img5_capinst_typeError" class="alert-message"></span>
        </div>
    </div>
    <!-- <div class="form-group">
        <label class="col-sm-2">Elec_bill_6mo</label>
        <div class="col-sm-12">
            <input type="file" class="form-control" id="Elec_bill_6mo" name="Elec_bill_6mo" placeholder="Elec_bill_6mo" rows="4" cols="50" required>

            <span id="Elec_bill_6mo_typeError" class="alert-message"></span>
        </div>
    </div> -->
    <div class="form-group">
        <label class="col-sm-2">location(x,y)</label>
        <div class="col-sm-12">
            <input class="form-control" id="location_x_y" name="location_x_y" placeholder="location(x,y)" rows="4" cols="50" required>

            <span id="location_x_y_typeError" class="alert-message"></span>
        </div>
    </div>
    <div class="form-group">
    <button type="submit" class="btn btn-success pull-right btn-submit">Save</button>
   
    </div>
    
</form>
</div>    


</div>
</body>
</html>

<script>
   

</script>
