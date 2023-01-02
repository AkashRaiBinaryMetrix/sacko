<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $var_employee_id;


    public function __construct($configArr)
    {
        $this->configArr        = $configArr;
        $this->var_employee_id  = $configArr['employee_id'];


        //dd($configArr);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.forget_password')->subject('Forget Password | Saloo App')->from('noreply@manticoresoft.com','Saloo App (GHP)');
    }
}
