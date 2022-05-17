<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_name', 'company_no','premise_type','house_no', 'street', 'postcode', 'district', 'state', 'email', 'contact_no', 'tnb_account_no',
        'tnb_meter_no', 'equipment_examples', 'address','application_status','created_by','proposed_site_visit_date'


    ];
}
