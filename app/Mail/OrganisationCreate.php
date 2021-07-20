<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrganisationCreate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string $organisationName
     */
    public $organisationName;

    /**
     * @var string $organisationTrialEnd
     */
    public $organisationTrialEnd;

    /**
     * @var string $userName
     */
    public $userName;

    /**
     * OrganisationCreate constructor.
     * @param string $organisationName
     * @param string $organisationTrialEnd
     * @param string $userName
     */
    public function __construct(string $organisationName, string $organisationTrialEnd, string $userName)
    {
        $this->organisationName = $organisationName;
        $this->organisationTrialEnd = $organisationTrialEnd;
        $this->userName = $userName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('test@test.com')->view('emails.organisation_create');
    }
}
