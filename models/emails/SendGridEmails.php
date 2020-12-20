<?php

class SendGridEmails {
    
    public function send($name, $email, $guests) {
        $sendgrid = new SendGrid('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');
        $emailWSG = new SendGrid\Mail\Mail();
        $emailWSG->addTo($email);
        $emailWSG->setFrom('im.amideb@gmail.com');
        $emailWSG->setSubject('Redskins Training Campus Pass');
        $emailWSG->addContent(
            "text/html", ((empty($guests)) ? self::guests_content($name) : self::main_content($name, $guests))
        );
        $sendgrid->send($emailWSG);
    }
    
    private function guests_content($name) {
        ob_start();
        include "templates/guests.phtml";
        return $ob_clean = ob_get_clean();
    }
    
    private function main_content($name, $guests) {
        $barcodes = "";
        $guests_cnt = count($guests);
        if ($guests_cnt == 1) :
            $barcodes .= '
                <tr>
                    <td colspan="75%" style="background-color:#FFFFFF;color:#000000;width:50%;padding-top:20px;">
                        <img alt="" src="https://drive.google.com/uc?export=view&id=19Xbcfvh2tL6RNzDr41u4qVf3HiDdW-9z" style="display: block;padding-left: 185px;padding-right: 10px;" />
                    </td>
                </tr>
            ';
        elseif ($guests_cnt > 1) :
                for ($i = 1; $i <= $guests_cnt/2; $i++) :
                    $barcodes .= '
                        <tr>
                            <td style="background-color:#FFFFFF;color:#000000;width:50%;padding-top:20px;">
                                <img alt="" src="https://drive.google.com/uc?export=view&id=19Xbcfvh2tL6RNzDr41u4qVf3HiDdW-9z" style="display: block;padding-left: 105px;padding-right: 10px;" />
                            </td>
                            <td style="background-color:#FFFFFF;color:#000000;width:50%;padding-top:20px;">
                                <img alt="" src="https://drive.google.com/uc?export=view&id=19Xbcfvh2tL6RNzDr41u4qVf3HiDdW-9z" style="display: block;padding-right: 100px;padding-left: 10px;" />
                            </td>
                        </tr>
                    ';
                endfor;
                if (is_float($guests_cnt/2)) :
                    $barcodes .= '
                        <tr>
                            <td colspan="75%" style="background-color:#FFFFFF;color:#000000;width:50%;padding-top:20px;">
                                <img alt="" src="https://drive.google.com/uc?export=view&id=19Xbcfvh2tL6RNzDr41u4qVf3HiDdW-9z" style="display: block;padding-left: 185px;padding-right: 10px;" />
                            </td>
                        </tr>
                    ';
                endif;
        else :
            self::guests_content($name);
        endif;
        ob_start();
        include_once "templates/main.phtml";
        return $ob_clean = ob_get_clean();
        return new SendGrid\Content("text/html", $ob_clean);
    }
    
}