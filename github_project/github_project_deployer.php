<?php

require("../GithubDeployer.php");

//the valid hook checks two things: (1) that the user agent is really from github. And (2) that it contains payload POST data.
if(GithubDeployer::valid_hook("GitHub Hook"))
{
	$settings = array(
		"deploy_directory"   => realpath("[relative path to project folder]"), //where do you want it to deploy on your server?
		"remote"             => "[github remote]",
		"contributor_emails" => "[emails (comma delimited)]"
	);

	//turn the payload into a parsable array
	$payload = json_decode($_POST['payload'], true); //make payload as an array
	$deployer = new GithubDeployer($settings);
	$deployer->deploy($payload); //the deploy function will make sure it's the right branch
}

?>
