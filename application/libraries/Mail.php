<?php
 
class Mail {

    public function send_mail($to_email,$subject,$message) {
        try{
            $CI =& get_instance();
            $config = Array(
                'protocol' => 'smtp',
                'smtp_host' => 'tcp://smtp.googlemail.com',
                'smtp_port' => 587 ,
                'smtp_crypto' => 'tls',
                'smtp_user' => EMAIL,
                'smtp_pass' => EMAIL_PASSWORD,
                'mailtype'  => 'html', 
                'charset'   => 'utf-8'
            );
            $CI->load->library('email');
            $CI->email->initialize($config);
            $CI->email->set_newline("\r\n");   
            $CI->email->from("noreply"); 
            $CI->email->to($to_email);
            $CI->email->subject($subject); 
            $CI->email->message($message); 
            if ( ! $CI->email->send() )
            {
                return array( 'success' => false,'message' => $CI->email->print_debugger(array('headers')));
            }else{
                return array( 'success' => true,'message' => "");
            }                   
        }
        catch(exception $e){
            return array( 'success' => false,'message' => $e);
        }
    }
}
 
?>
