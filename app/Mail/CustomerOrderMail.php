<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public  $name;

    public $email;

    public $phone;

    public $zip;

    public $city;

    public  $burger;
    public function __construct($name,$email,$phone,$zip,$city,$burger)
    {
        $this->name  = $name;
        $this->email  =  $email;
        $this->phone = $phone;
        $this->zip =  $zip;
        $this->city = $city;
        $this->burger = $burger;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_customer_admin_email')
                    ->from('alex.joe.lytle@gmail.com', "Bob's Burger Builder")
                    ->subject( $this->name .' thanks for the order');
    }
}
