<?php

require("Deployer.php");

class BitbucketDeployer extends Deployer
{
	//default optional settings
	protected $branch = "master";
	protected $contributor_emails = false;
	// Additional settings available from Deployer class:
	// protected $deploy_directory (required in settings)
	// protected $remote (required in settings)

	public function deploy($payload = array())
	{
		if($payload["branch"] == $this->branch)
			parent::deploy();
	}

}

?>
