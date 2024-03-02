<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewStudent extends Notification
{
    use Queueable;

    private $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $data = $this->data;
        return (new MailMessage)->subject('Nová registrácia študenta - kurz ' . $data['coursename'])->markdown('mail.newstudent',['coursename' => $data['coursename'], 'coursetype' =>$data['coursetype'], 'academyname' => $data['academyname'] , 'name' => $data['name'], 'lastname' => $data['lastname'], 'email' => $data['email'] , 'date' => $data['date']]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'course_id' => $this->data['id'],
            'course_name' => $this->data['coursename'],
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
