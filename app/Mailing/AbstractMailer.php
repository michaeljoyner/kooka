<?php
/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 8/31/16
 * Time: 9:25 PM
 */

namespace App\Mailing;


use Illuminate\Contracts\Mail\Mailer;

abstract class AbstractMailer
{
    /**
     * @var LaravelMailer
     */
    private $laravelMailer;
    public function __construct(Mailer $laravelMailer)
    {
        $this->laravelMailer = $laravelMailer;
    }
    protected function sendTo($to, $from, $subject, $view, $data, $attachments = [])
    {
        $this->laravelMailer->send($view, $data, function ($message) use ($to, $from, $subject, $attachments) {
            $message->to($to)->subject($subject);
            foreach ($attachments as $filename) {
                $message->attach($filename);
            }
            if ($from !== '') {
                $message->from($from);
            }
        });
    }
}