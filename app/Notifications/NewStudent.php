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
        //return ['mail', 'database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $data = $this->data;
        return (new MailMessage)->subject('Nová registrácia študenta - kurz ' . $data['coursename'])->markdown('mail.newstudent', ['coursename' => $data['coursename'], 'coursetype' => $data['coursetype'], 'academyname' => $data['academyname'], 'name' => $data['name'], 'lastname' => $data['lastname'], 'email' => $data['email'], 'date' => $data['date'], 'minimum' => $data['minimum']]);
    }

    public function toDatabase($notifiable)
    {
        return [
            'coursetype_id' => $this->data['id'],
            'application_id' => $this->data['application_id'],
            'student_id' => $this->data['student_id'],
            'message' => 'Do Vášho kurzu ' . $this->data['coursename'] . ' - ' .
                ($this->data['coursetype'] == 0 ? 'študentský' : 'inštruktorský') .
                ' sa prihlásil nový študent.',
            'minimum' => $this->data['minimum'],
            'admin' => false

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
