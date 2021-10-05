<style>
	a{
		font-weight: bold;
	}
</style>

<?php
	/* Check if required software is installed. Issue warning if not. */
 
	if (!$RequiredSoftwareHandler->isPHPCurlIsInstalled()){
		echo $RequiredSoftwareHandler->getNoCurlAdviceBasedOnOperatingSystem();
	}// end if

	if (!$RequiredSoftwareHandler->isPHPJSONIsInstalled()){
		echo $RequiredSoftwareHandler->getNoJSONAdviceBasedOnOperatingSystem();
	}// end if
?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="container" style="margin-bottom: 30px;">
                <div class="row">
                    <div class="col-6" style="margin-top: 20px; margin-bottom: 20px;">
                        <a title="Usage Instructions" href="./index.php?page=documentation/usage-instructions.php">
                            <img alt="What Should I Do?" align="middle" src="./images/question-mark-40-61.png" />
                            What Should I Do?
                        </a>
                    </div>
                    <div class="col-6" style="margin-top: 20px; margin-bottom: 20px;">
                        <a href="./index.php?page=./documentation/vulnerabilities.php">
                            <img alt="Help" align="middle" src="./images/siren-48-48.png" />
                            Listing of vulnerabilities
                        </a>
                    </div>
                    <div class="col-6" style="margin-top: 20px; margin-bottom: 20px;">
                        <a href="https://twitter.com/webpwnized" target="_blank">
                            <img align="middle" alt="Webpwnized Twitter Channel" src="./images/twitter-bird-48-48.png" />
                            Release Announcements
                        </a>
                    </div>
                    <div class="col-6" style="margin-top: 20px; margin-bottom: 20px;">
                        <a href="http://www.youtube.com/user/webpwnized" target="_blank">
                            <img align="middle" alt="Webpwnized YouTube Channel" src="./images/youtube-play-icon-40-40.png" />
                            Video Tutorials
                        </a>
                    </div>
                    <div class="col-6" style="margin-top: 20px; margin-bottom: 20px;">
                        <img alt="Latest Version" align="middle" src="./images/installation-icon-48-48.png" />
                        <a title="Latest Version" href="https://github.com/webpwnized/mutillidae" target="_blank">Latest Version</a>
                    </div>
                    <div class="col-6" style="margin-top: 20px; margin-bottom: 20px;">
                        <a href="documentation/mutillidae-test-scripts.txt" target="_blank">
                            <img alt="Helpful hints and scripts" align="middle" src="./images/help-icon-48-48.png" />
                            Helpful hints and scripts
                        </a>
                    </div>
                    <div class="col-6" style="margin-top: 20px; margin-bottom: 20px;">
                        <a href="configuration/openldap/mutillidae.ldif" target="_blank">
                            <img align="middle" alt="Mutillidae LDIF File" src="./images/ldap-server-48-59.png" />
                            Mutillidae LDIF File
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div style=" width: 300px; overflow: hidden;">
                <?php include_once (__ROOT__.'/includes/hints/hints-menu-wrapper.inc'); ?>
            </div>
        </div>
    </div>
</div>
