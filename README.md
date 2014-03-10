Deployer
========

This is a deployer meant for both Bitbucket and Github hooks implementing Git. Modified from Brandon Summers post found here: http://brandonsummers.name/blog/2012/02/10/using-bitbucket-for-automated-deployments/.

How do I use this?
------------------

I tried to make it as intuitive to set up as possible. Heres how you can set it up on your own system:

1. Clone the repo.
2. Choose either the Github or Bitbucket project folder as a base for your project.
3. Change the appropriate settings (found in the $settings = array() of the project file).
4. You should be good to go!

The final step is optional

*note: this requires Git to be installed on the server where the deployer is placed. Also makes use of the exec() php functions.*
