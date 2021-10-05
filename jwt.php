<?php

require_once(__ROOT__ . '/classes/JWT.php');

// attack requires user - if not logged in, just display message and return
if (!isset($_SESSION['uid']) || !is_numeric($_SESSION['uid'])) {
    echo '<p>Not logged in. Please <a href="index.php?page=login.php">login/register</a> first...</p>';
    return;
}

try {
    switch ($_SESSION["security-level"]) {
        case "0": // This code is insecure.
            $lEnableSignatureValidation = FALSE;
            $lKey = 'snowman';
            break;
        case "1": // This code is insecure.
            $lEnableSignatureValidation = TRUE;
            $lKey = 'snowman';
            break;
        case "2":
        case "3":
        case "4":
        case "5": // This code is fairly secure
            $lEnableSignatureValidation = TRUE;
            $lKey = 'MIIBPAIBAAJBANBs46xCKgSt8vSgpGlDH0C8znhqhtOZQQjFCaQzcseGCVlrbI';
            break;
    }// end switch
} catch (Exception $e) {
    echo $CustomErrorHandler->getExceptionMessage($e, "Error setting up configuration on page jwt.php");
}// end try

// generate a token with the current user info
$authToken = generate_token($lKey);

function generate_token($key)
{
    $payload = array(
        "iss" => "http://mutillidae.local",
        "aud" => "http://mutillidae.local",
        "iat" => time(),
        "exp" => time() + (30 * 60),
        "userid" => $_SESSION["uid"]
    );
    $jwt = JWT::encode($payload, $key);
    return $jwt;
}

?>

<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="col-12">
                <div class="row">
                    <div class="col-2">
                        <?php include_once(__ROOT__ . '/includes/back-button.inc'); ?>
                    </div>
                    <div class="col-8" style="margin-top: 10px;">
                        <div class="page-title">Current User Information</div>

                    </div>
                    <div class="col-2">
                        <?php include_once('./includes/help-button.inc'); ?>
                    </div>
                </div>
            </div>
            <div class="col-12" style="justify-content: center; display: flex; margin-bottom: 50px;">
                <div style="max-width: 400px">
                    <form class="row g-3">
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">CID</label>
                            <input type="email" class="form-control" id="inputCID" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">User Name</label>
                            <input type="email" class="form-control" id="inputUserEmail" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">First Name</label>
                            <input type="email" class="form-control" id="inputFirstName" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Last Name</label>
                            <input type="email" class="form-control" id="inputLastName" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Signature</label>
                            <input type="email" class="form-control" id="inputSignature" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Is Admin</label>
                            <input type="email" class="form-control" id="inputIsAdmin" disabled>
                        </div>
                        <div class="col-md-12">
                            <label for="inputEmail4" class="form-label">Password</label>
                            <input type="email" class="form-control" id="inputPassword" disabled>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div style=" width: 300px; overflow: hidden;">
                <?php include_once(__ROOT__ . '/includes/hints/hints-menu-wrapper.inc'); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var authToken = "<?php echo $authToken ?>";
    try {
        var lXMLHTTP;
        lXMLHTTP = new XMLHttpRequest();
        lXMLHTTP.onreadystatechange = function () {
            if (lXMLHTTP.readyState == 4 && lXMLHTTP.status == 200) {
                var lUserDetailsJSON = JSON.parse(lXMLHTTP.response);
                displayUserDetails(lUserDetailsJSON);
            }
        };
        lXMLHTTP.open("POST", "./ajax/jwt.php", true);
        lXMLHTTP.setRequestHeader("AuthToken", authToken);
        lXMLHTTP.send();
    } catch (e) {
        alert("Error trying execute AJAX call: " + e.message);
    }//end try

    var displayUserDetails = function (pUserInfoJSON) {
        try {
            var laInfo = pUserInfoJSON;
            if (laInfo) {
                document.getElementById("inputCID").value = pUserInfoJSON['cid'];
                document.getElementById("inputUserEmail").value = pUserInfoJSON['username'];
                document.getElementById("inputFirstName").value = pUserInfoJSON['firstname'];
                document.getElementById("inputLastName").value = pUserInfoJSON['lastname'];
                document.getElementById("inputSignature").value = pUserInfoJSON['mysignature'];
                document.getElementById("inputIsAdmin").value = pUserInfoJSON['is_admin'];
                document.getElementById("inputPassword").value = "*********";
            }
        } catch (/*Exception*/ e) {
            alert("Error trying to parse JSON: " + e.message);
        }// end try
    };// end function

    var addRow = function (pFieldName, pFieldValue) {
        var lTBody = document.getElementById("idDisplayTableBody");
        var row = lTBody.insertRow();
        var newcell1 = row.insertCell(0);
        var newcell2 = row.insertCell(1);
        newcell1.innerText = pFieldName;
        newcell1.setAttribute("class", "sub-header");
        newcell2.innerText = pFieldValue;
        newcell2.setAttribute("class", "sub-body");
        newcell2.setAttribute("style", "text-align:left");
    }

</script>
