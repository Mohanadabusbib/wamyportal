<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ticketcallcenter;
use Illuminate\Support\Facades\Auth;

class CallcenterTickets extends Notification
{
    use Queueable;
    private $ticketcallcenter;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ticketcallcenter $ticketcallcenter)
    {
        $this->ticketcallcenter = $ticketcallcenter;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        /* $url = "http://127.0.0.1:8000/proceticket/2"; */
        $url = "http://srv.wamy.org/wamyportal/public/ticketdetails/". $this->ticketcallcenter->id;
        return (new MailMessage)
            
            ->line('The introduction to the notification.')
            ->action('Notification Action', $url)
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->ticketcallcenter->id,
            'empid' => Auth::user()->empid,
            'title'=> 'معاملة محولة من مركز الإتصال',
            'user' => Auth::user()->name,
        ];
    }
}
