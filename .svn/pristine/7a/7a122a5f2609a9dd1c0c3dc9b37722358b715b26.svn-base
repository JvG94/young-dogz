<?php

class Mailer {

    private $mailer, $message, $data, $body;
    private $from = EMAIL_FROM;
    private $fromName = EMAIL_FROM_NAME;

    /**
     * Set the correct SMTP settings for the mailing.
     */
    public function __construct() {
        require_once (ROOT . DS . 'library' . DS . 'swift' . DS . 'swift_required.php');

        $transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT, SMTP_SECURITY);
        $transport->setUsername(SMTP_USERNAME);
        $transport->setPassword(SMTP_PASSWORD);

        $this->mailer = Swift_Mailer::newInstance($transport);
        $this->message = Swift_Message::newInstance();
    }

    /**
     * Set an variable for the data.
     */
    public function set() {
        $args = func_get_args();
        $argsCount = func_num_args();
        if ($argsCount == 1) {
            if (is_array($args[0])) {
                foreach ($args[0] as $key => $value) {
                    if ($key) {
                        $this->data[$key] = $value;
                    }
                    else {
                        $this->data[$value] = $value;
                    }
                }
            }
        }
        elseif ($argsCount == 2) {
            $this->data[$args[0]] = $args[1];
        }
    }

    /**
     * Set the subject.
     * @param string $subject
     */
    public function setSubject($subject) {
        $this->message->setSubject($subject);
    }

    /**
     * Set the body.
     * @param string $body
     */
    public function setBody($body) {
        $this->body = $body;
    }

    /**
     * Set the body. This gets the body from an file. This is located in the ROOT/application/views/emails/ folder.
     * Outputs the data so it can be used in the view. The view is then saved into an variable and set as the body.
     * @param string $path
     */
    public function setPath($path) {
        $pathToEmail = ROOT . DS . 'application' . DS . 'views' . DS . 'emails' . DS . $path . DEFAULT_VIEW_EXTENSION;

        if (file_exists($pathToEmail)) {
            if (isset($this->data)) {
                foreach ($this->data as $key => $value) {
                    $$key = $value;
                }
            }
            ob_start();
            include ($pathToEmail);
            $this->body = ob_get_contents();
            ob_end_clean();
        }
    }

    /**
     * Sets the receivers. If the first parameter is a string the second parameter will be used for the name. 
     * When the first parameter is an array it must be an associative array.
     * @param mixed $addresses
     */
    public function setTo($addresses, $name = null) {
        $this->message->setTo($addresses, $name);
    }

    /**
     * Sets the receivers. If the first parameter is a string the second parameter will be used for the name. 
     * When the first parameter is an array it must be an associative array.
     * @param mixed $addresses
     */
    public function setFrom($addresses, $name = null) {
        $this->from = $addresses;
        $this->fromName = $name;
    }

    /**
     * Add an attachment to the email.
     * @param string $path
     */
    public function addAttachment($path) {
        if (file_exists($path)) {
            $this->message->attach(Swift_Attachment::fromPath($path));
        }
    }

    /**
     * Sends the email to the receivers. Also sets the correct body.
     * @return bool
     */
    public function send() {
        if (isset($this->body)) {
            $this->message->setBody($this->body);
        }
        $this->message->setFrom($this->from);
        return (bool) $this->mailer->send($this->message);
    }

}