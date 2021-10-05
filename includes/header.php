<?php
    $lSecurityLevel = $_SESSION["security-level"];

    switch ($lSecurityLevel){
        case "0": // This code is insecure
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Hosed)";
            break;
        case "1": // This code is insecure
            // DO NOTHING: This is equivalent to using client side security
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Client-Side Security)";
            break;

        case "2":
        case "3":
        case "4":
        case "5": // This code is fairly secure
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Secure)";
            break;
    }// end switch

	if($_SESSION['loggedin'] == "True"){

	    switch ($lSecurityLevel){
	   		case "0": // This code is insecure
	   		case "1": // This code is insecure
	   			// DO NOTHING: This is equivalent to using client side security
				$logged_in_user = $_SESSION['logged_in_user'];
			break;

	   		case "2":
	   		case "3":
	   		case "4":
	   		case "5": // This code is fairly secure
	   			// encode the entire message following OWASP standards
	   			// this is HTML encoding because we are outputting data into HTML
				$logged_in_user = $Encoder->encodeForHTML($_SESSION['logged_in_user']);
			break;
	   	}// end switch

	   	$lUserID = $_SESSION['uid'];

	   	$lUserAuthorizationLevelText = 'User';

	   	if ($_SESSION['is_admin'] == 'TRUE'){
	   		$lUserAuthorizationLevelText = 'Admin';
	   	}// end if

		$lAuthenticationStatusMessage =
			'Logged In ' .
			$lUserAuthorizationLevelText . ": " .
			'<span class="logged-in-user">'.$logged_in_user.'</span>'.
			'<a href="index.php?page=edit-account-profile.php&uid='.$lUserID.'">'.
            '<img src="images/edit-icon-20-20.png" /></a>';
	} else {
		$logged_in_user = "anonymous";
		$lAuthenticationStatusMessage = "Not Logged In";
	}// end if($_SESSION['loggedin'] == "True")

	if ($_SESSION["EnforceSSL"] == "True"){
		$lEnforceSSLLabel = "Drop TLS";
	}else {
		$lEnforceSSLLabel = "Enforce TLS";
	}//end if

	$lHintsMessage = "Hints: ".$_SESSION["hints-enabled"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" type="text/css" href="styles/global-styles.css" />
	<link rel="stylesheet" type="text/css" href="styles/ddsmoothmenu/ddsmoothmenu.css" />
	<link rel="stylesheet" type="text/css" href="javascript/jQuery/colorbox/colorbox.css" />
	<link rel="stylesheet" type="text/css" href="styles/gritter/jquery.gritter.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
	<script src="javascript/jQuery/jquery.js"></script>
	<script src="javascript/jQuery/colorbox/jquery.colorbox-min.js"></script>
	<script src="javascript/ddsmoothmenu/ddsmoothmenu.js"></script>
	<script src="javascript/gritter/jquery.gritter.min.js"></script>
	<script src="javascript/hints/hints-menu.js"></script>
	<script src="javascript/inline-initializers/jquery-init.js"></script>
	<script src="javascript/inline-initializers/ddsmoothmenu-init.js"></script>
	<script src="javascript/inline-initializers/populate-web-storage.js"></script>
	<script src="javascript/inline-initializers/gritter-init.js"></script>
	<script src="javascript/inline-initializers/hints-menu-init.js"></script>
</head>
<body>
<table class="main-table-frame">
    <tr class="main-table-frame-dark">
        <td class="main-table-frame-first-bar" colspan="2">
            <div class="container" style="margin-top: 20px; margin-bottom: 20px">
                <div class="row">
                    <div class="col-9">
                        <img src="images/coykillericon-50-38.png"/>
                        OWASP Mutillidae II: Keep Calm and Pwn On
                    </div>
                    <div class="col-3" style="font-size: 16px">
                        <div class="col" style="display: flex">
                            <?php /* Note: $C_VERSION_STRING in index.php */
                            echo $C_VERSION_STRING;
                            ?>
                        </div>
                        <div class="col" style="display: flex">
                            <span><?php echo $lSecurityLevelMessage; ?></span>
                        </div>
                        <div class="col" style="display: flex">
                            <span><?php echo $lHintsMessage; ?></span>
                        </div>
                        <div class="col" style="display: flex">
                            <span><?php echo $lAuthenticationStatusMessage ?></span>
                        </div>
                    </div>
                </div>
        </td>
    </tr>
	<tr class="main-table-frame-menu-bar">
		<td class="main-table-frame-menu-bar" colspan="2">
            <div class="container" style="margin-top: 25px">
                <div class="row">
                    <div class="col" style="justify-content: center; display: flex">
                        <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group me-2" role="group" aria-label="First group">
                                <a class="btn btn-outline-secondary" style="border-color: white;"
                                   href="index.php?page=home.php&popUpNotificationCode=HPH0">Home</a>
                                <?php
                                if ($_SESSION['loggedin'] == 'True') {
                                    echo '<a class="btn btn-outline-secondary" style="border-color: white;" href="index.php?do=logout">Logout</a>';
                                } else {
                                    echo '<a class="btn btn-outline-secondary" style="border-color: white;" href="index.php?page=login.php">Login/Register</a>';
                                }// end if
                                ?>
                                <?php
                                if ($_SESSION['security-level'] == 0) {
                                    echo '<a class="btn btn-outline-secondary" style="border-color: white;" href="index.php?do=toggle-hints&page=' . $lPage . '">Toggle Hints</a>';
                                }// end if
                                ?>
                                <a class="btn btn-outline-secondary"
                                   style="border-color: white;"
                                   href="index.php?do=toggle-security&page=<?php echo $lPage ?>">Toggle Security</a>
                                <a class="btn btn-outline-secondary"
                                   style="border-color: white;"
                                   href="index.php?do=toggle-enforce-ssl&page=<?php echo $lPage ?>"><?php echo $lEnforceSSLLabel; ?></a>
                                <a class="btn btn-outline-secondary"
                                   style="border-color: white;" href="set-up-database.php">Reset DB</a>
                                <a class="btn btn-outline-secondary"
                                   style="border-color: white;"
                                   href="index.php?page=show-log.php">View Log</a>
                                <a class="btn btn-outline-secondary"
                                   style="border-color: white;"
                                   href="index.php?page=captured-data.php">View
                                    Captured Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
	</tr>
	<tr>
		<td class="main-table-frame-left">
			<?php require_once 'main-menu.php'; ?>
		</td>
		<td class="main-table-frame-right">
			<!-- Begin Content -->
