<?php
/*
* Woocommerce
* @author Rodrigo Portillo
* @site https://velhobit.com.br
*/
//Adicione este script no functions.php, do seu tema, para o cliente receber e-mails de confirmação de pedido e cancelamento
//Add this script on functions.php on template to customer receive confirm, failed and canceled e-mails

add_action('woocommerce_order_status_changed', 'custom_send_email_notifications', 10, 4 );
function custom_send_email_notifications( $order_id, $old_status, $new_status, $order ){
    if ( $new_status == 'cancelled' || $new_status == 'failed' ){
        $wc_emails = WC()->mailer()->get_emails(); // Get all WC_emails objects instances
        $customer_email = $order->get_billing_email(); // The customer email
    }

    if ( $new_status == 'cancelled' ) {
        // change the recipient of this instance
        $wc_emails['WC_Email_Cancelled_Order']->recipient .= ',' . $customer_email;
        // Sending the email from this instance
        $wc_emails['WC_Email_Cancelled_Order']->trigger( $order_id );
    } 
    else if ( $new_status == 'failed' ) {
        // change the recipient of this instance
        $wc_emails['WC_Email_Failed_Order']->recipient .= ',' . $customer_email;
        // Sending the email from this instance
        $wc_emails['WC_Email_Failed_Order']->trigger( $order_id );
    } 
}

add_filter( 'woocommerce_email_recipient_cancelled_order', 'so_email_recipient', 10, 2 );
function so_email_recipient( $recipient, $order ){

   if( method_exists ( $order , 'get_billing_email' ) ){

        $recipient = $recipient . ',' . $order->get_billing_email() ;

    } else {

        $recipient = $recipient . ',' . $order->billing_email   ;

    }

    return $recipient;

}
?>