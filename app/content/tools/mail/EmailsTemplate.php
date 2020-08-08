<?php
/**
 * The templates emails functionality of the theme.
 *
 * @link https://lordblaster.com.ve/
 * @since 1.0.0
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 */

class Email
{
    public function init()
    {
        add_filter( 'wp_mail_from', array( $this, "wpbSenderEmail" ) );
	    add_filter( 'wp_mail_from_name', array( $this, "wpbSenderName" ) );    
    }
	
	/**
	 * SendEmail.
	 *
	 * @see Email::SendEmail()
	 * @since 1.0.0
	 *
	 * @access public
	 * @return bool
	 */
	public function SendEmail( $mailTo, $nombre, $correo, $monto, $banco, $ci, $curso, $deposito )
	{
	    $headers = array('Content-Type: text/html; charset=UTF-8');
	    
        add_filter( 'wp_mail_content_type', function () {
            return "text/html";
        });
		
		$content_email = $this->TmplNewUser( $nombre, $correo, $monto, $banco, $ci, $curso, $deposito );
		$content_email_reply = $this->TmplNewUserReply( $nombre, $correo, $monto, $banco, $ci, $curso, $deposito );

		return wp_mail( $mailTo, '¡Nueva inscripción!', $content_email , $headers ) && wp_mail( $correo, '¡Nueva inscripción!', $content_email_reply , $headers );
		
		remove_filter( 'wp_mail_content_type', function () {
            return "text/html";
        });
	}

	/**
	 * TmplNewUser.
	 *
	 * @see Email::TmplNewUser()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return string
	 */
	private function TmplNewUser( $findname, $correo, $monto, $banco, $ci, $curso, $deposito )
	{
		ob_start();
		
		// Header
		include( locate_template( 'app/content/tools/mail/EmailHeader.php' ) );
		
		// Content
		include( locate_template( 'app/content/tools/mail/ApplyUser.php' ) );

		// Footer
		include( locate_template( 'app/content/tools/mail/EmailFooter.php' ) );
		
		return ob_get_clean();
	}

	/**
	 * TmplNewUserReply.
	 *
	 * @see Email::TmplNewUserReply()
	 * @since 1.0.0
	 *
	 * @access private
	 * @return string
	 */
	private function TmplNewUserReply( $findname, $correo, $monto, $banco, $ci, $curso, $deposito )
	{
		ob_start();
		
		// Header
		include( locate_template( 'app/content/tools/mail/EmailHeader.php' ) );
		
		// Content
		include( locate_template( 'app/content/tools/mail/ApplyReplyUser.php' ) );
		
	    // Footer
		include( locate_template( 'app/content/tools/mail/EmailFooter.php' ) );
		
		return ob_get_clean();
	}
		
	/**
     * Provides the functoinality to get the From email name
     * @return string returns the from name for the email
     */
	private function getFromName()
	{
		return get_bloginfo( "name" );
	}
        
    /**
     * Functioanlity to fetch the from email from database
	 * 
     * @return string returns from email
     */
	public function wpbSenderName()
	{
		return $this->getFromName();
	}
        
    /**
     *
     * @return string Returns from email address.
     */
    private function getFromEmail()
    {
        $fromEmail =  of_get_option( 'mail_academy' );
        if( $fromEmail == false ):
            $fromEmail = of_get_option( 'mail_academy' );
        endif;
        return $fromEmail;
    }
        
    /**
     * Functioanlity to fetch the from email from database
	 * 
     * @return string returns from email
     */
	public function wpbSenderEmail()
	{
		return $this->getFromEmail();
	}
}