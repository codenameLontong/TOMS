<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('overtime', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pegawai_id');
            $table->string('state')->nullable();
            $table->integer('seq')->nullable();
            $table->integer('order_by')->nullable();
            $table->timestamp('order_at')->nullable();
            $table->timestamp('modified_at')->nullable();
            $table->boolean('is_back_date')->default(false);
            $table->boolean('is_holiday')->default(false);
            $table->string('doc_number')->nullable();
            $table->date('request_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->unsignedBigInteger('overtime_reason_order_id')->nullable();
            $table->text('todo_list')->nullable();
            $table->boolean('is_special_request')->default(false);
            $table->text('special_request_reason')->nullable();
            $table->text('note')->nullable();
            $table->string('status')->nullable();
            $table->text('cancel_reason')->nullable();
            $table->date('period_to')->nullable();
            $table->date('period_from')->nullable();
            $table->boolean('ot_weekend')->default(false);
            $table->boolean('ot_weekday')->default(false);
            $table->boolean('leave_compensation')->default(false);
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->text('approved_note')->nullable();
            $table->date('approved_date')->nullable();
            $table->time('approved_start_time')->nullable();
            $table->time('approved_end_time')->nullable();
            $table->unsignedBigInteger('escalation_approved_by')->nullable();
            $table->timestamp('escalation_approved_at')->nullable();
            $table->text('escalation_approved_note')->nullable();
            $table->date('escalation_approved_date')->nullable();
            $table->time('escalation_approved_start_time')->nullable();
            $table->time('escalation_approved_end_time')->nullable();
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->text('confirmed_note')->nullable();
            $table->date('confirmed_date')->nullable();
            $table->time('confirmed_start_time')->nullable();
            $table->time('confirmed_end_time')->nullable();
            $table->unsignedBigInteger('officer_confirmed_by')->nullable();
            $table->timestamp('officer_confirmed_at')->nullable();
            $table->text('officer_confirmed_note')->nullable();
            $table->date('officer_confirmed_date')->nullable();
            $table->time('officer_confirmed_start_time')->nullable();
            $table->time('officer_confirmed_end_time')->nullable();
            $table->unsignedBigInteger('hc_head_confirmed_by')->nullable();
            $table->timestamp('hc_head_confirmed_at')->nullable();
            $table->text('hc_head_confirmed_note')->nullable();
            $table->date('hc_head_confirmed_date')->nullable();
            $table->time('hc_head_confirmed_start_time')->nullable();
            $table->time('hc_head_confirmed_end_time')->nullable();
            $table->time('actual_start_time')->nullable();
            $table->time('actual_end_time')->nullable();
            $table->unsignedBigInteger('informed_by')->nullable();
            $table->timestamp('informed_at')->nullable();
            $table->boolean('is_agree')->default(false);
            $table->text('informed_note')->nullable();
            $table->boolean('convert_as')->default(false);
            $table->boolean('is_over')->default(false);
            $table->boolean('is_convert_as_salary')->default(false);
            $table->boolean('is_convert_as_leave_balance')->default(false);
            $table->boolean('is_more_than_max_order_time')->default(false);
            $table->boolean('is_more_than_certain_order_time')->default(false);
            $table->boolean('is_back_date_same_day_order')->default(false);
            $table->timestamp('rejected_at')->nullable();
            $table->unsignedBigInteger('rejected_by')->nullable();
            $table->text('rejected_note')->nullable();
            $table->string('reference')->nullable();
            $table->string('pm_act_type')->nullable();
            $table->string('customer_name')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->date('request_end_date')->nullable();
            $table->date('approved_end_date')->nullable();
            $table->date('escalation_approved_end_date')->nullable();
            $table->date('confirmed_end_date')->nullable();
            $table->date('officer_confirmed_end_date')->nullable();
            $table->date('hc_head_confirmed_end_date')->nullable();
            $table->date('actual_end_date')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtime');
    }
};
