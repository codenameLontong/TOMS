<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait
use Carbon\Carbon;

class Overtime extends Model
{
    use HasFactory, SoftDeletes; // Add the SoftDeletes trait

    protected $table = 'overtime';

    protected $fillable = [
        'pegawai_id',
        'state',
        'seq',
        'order_by',
        'order_at',
        'modified_at',
        'is_back_date',
        'is_holiday',
        'doc_number',
        'request_date',
        'start_time',
        'end_time',
        'overtime_reason_order_id',
        'todo_list',
        'is_special_request',
        'special_request_reason',
        'note',
        'status',
        'cancel_reason',
        'period_to',
        'period_from',
        'ot_weekend',
        'ot_weekday',
        'leave_compensation',
        'approved_by',
        'approved_at',
        'approved_note',
        'approved_date',
        'approved_start_time',
        'approved_end_time',
        'escalation_approved_by',
        'escalation_approved_at',
        'escalation_approved_note',
        'escalation_approved_date',
        'escalation_approved_start_time',
        'escalation_approved_end_time',
        'confirmed_by',
        'confirmed_at',
        'confirmed_note',
        'confirmed_date',
        'confirmed_start_time',
        'confirmed_end_time',
        'officer_confirmed_by',
        'officer_confirmed_at',
        'officer_confirmed_note',
        'officer_confirmed_date',
        'officer_confirmed_start_time',
        'officer_confirmed_end_time',
        'hc_head_confirmed_by',
        'hc_head_confirmed_at',
        'hc_head_confirmed_note',
        'hc_head_confirmed_date',
        'hc_head_confirmed_start_time',
        'hc_head_confirmed_end_time',
        'actual_start_time',
        'actual_end_time',
        'informed_by',
        'informed_at',
        'is_agree',
        'informed_note',
        'convert_as',
        'is_over',
        'is_convert_as_salary',
        'is_convert_as_leave_balance',
        'is_more_than_max_order_time',
        'is_more_than_certain_order_time',
        'is_back_date_same_day_order',
        'rejected_at',
        'rejected_by',
        'rejected_note',
        'reference',
        'pm_act_type',
        'customer_name',
        'shift_id',
        'request_end_date',
        'approved_end_date',
        'escalation_approved_end_date',
        'confirmed_end_date',
        'officer_confirmed_end_date',
        'hc_head_confirmed_end_date',
        'actual_end_date',
        'deleted_by', // Add deleted_by to fillable
    ];

    // Specify the name of the deleted_at column if it's not the default
    protected $dates = ['deleted_at'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
    public function overtimeReason() {
        return $this->belongsTo(OvertimeReasonOrder::class, 'overtime_reason_order_id');
    }
}
