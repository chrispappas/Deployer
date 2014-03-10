<?php
/*
 * Title : deployer.class.php
 * Author: Micah Iriye
 * Date  : March 7th, 2014
 * Note  : This class does not handle validating the branch sent by the payload. That is handled by the Deployer's children (those extending it)
 */
class Deployer
{
	protected $deploy_directory = ""; // REQUIRED in settings | wrap in realpath("[relative path]")
	protected $remote = ""; // REQUIRED in settings
	protected $branch = "";
	protected $contributor_emails = ""; // takes a string fomatted based on RFC 2822 standards (example: http://us2.php.net/manual/en/function.mail.php) 

	public function __construct($settings = array())
	{
		//if the settings are passed in, then they will be used by the Deployer
		foreach($settings as $setting => $value)
	    	{
            		$this->{$setting} = $value;
			echo $setting . ": " . $value . "\n";
	    	}
	}

	public function deploy()
	{
		try {
			//move from current directory to the deployment directory
			chdir($this->deploy_directory);
			$message = "Changing directory: " . getcwd() . "\n";		
			
			//clean up the repo
			exec("git reset --hard HEAD", $output);
			$message .= "Attempting git reset --hard HEAD\n";
			
			//pull the changes from the selected branch
			exec("git pull " . $this->remote . " " . $this->branch, $output);
			$message .= "Attempting git pull from " . $this->remote . ": " . $this->branch . "\n";

			//secure the .git directory
			exec("chmod -R og-rx .git");
			$message .= "Locking .git folder down\n";

			$this->email("Deployment to " . $this->deploy_directory  . " - SUCCESSFUL", $message);
		}
		catch(Exception $error)
		{
			$this->email("Deployment to " . $this->deploy_direoctry . " - FAILED", $error);
		}
	}

	public function email($subject , $message)
	{
		if($this->email)
		{
			$to = $this->contributor_emails;
			$subject = $subject;
			$message = wordwrap($message, 70, "\r\n");
			$headers = "From: deployer@micahiriye.com"; // change this if you'd like it to not say it's from my website ; )
			mail($to, $subject, $message, $headers);
		}
	}

	public static function valid_hook($user_agent)
	{
		return strpos($_SERVER["HTTP_USER_AGENT"], $user_agent) !== false && isset($_POST["payload"]);
	}
}

?>
