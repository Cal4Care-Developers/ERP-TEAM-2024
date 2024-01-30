<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class BillingParent extends Model
{
    // Define the table name explicitly
    protected $table = 'billingparent';

    // Define the primary key if it's different from the default (id)
    protected $primaryKey = 'billId';

    // Rest of your model code...
}


?>
