<?php

require("Deployer.php");

class GithubDeployer extends Deployer
{
	//default optional settings
	protected $branch = "master";
	protected $contributor_emails = false;
	// Additional settings available from Deployer class:
	// protected $deploy_directory (required in settings)
	// protected $remote (required in settings)

	//handles validating the correct branch
	public function deploy($payload = array())
	{
		if($payload["ref"] == "refs/heads/" . $this->branch)
			parent::deploy();
	}
}

?>
