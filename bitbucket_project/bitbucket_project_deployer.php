<?php

require("../BitbucketDeployer.php");

//the valid hook checks two things: (1) that the user agent is really from bitbucket. And (2) that it contains payload POST data.
if(BitbucketDeployer::valid_hook("Bitbucket"))
{
	$options = array(
		"deploy_directory"   => realpath("[relative path to project folder]"), //where do you want it to deploy on your server?
		"remote"             => "[bitbucket remote]",
		"branch"             => "[desired branch]", //which branch would you like to use? leaving blank defaults to master
		"contributor_emails" => "[emails (comma delimited)]" //false turns emailing off
	);

	$payload = json_decode($_POST["payload"], true); //make payload as an array
	$payload = $payload["commits"][0]; //pulls the array to check branch

	$deployer = new BitbucketDeployer($options);
	$deployer->deploy($payload); //the deploy function will make sure it's the right branch
}

?>