<?php

$lUserAgentString = "";
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $lUserAgentString = $_SERVER['HTTP_USER_AGENT'];
}// end if

switch ($_SESSION["security-level"]) {
    case "0": // This code is insecure
    case "1": // This code is insecure
        // DO NOTHING: This is equivalent to using client side security
        $lPHPVersion = "PHP Version: " . phpversion();
        break;

    case "2":
    case "3":
    case "4":
    case "5": // This code is fairly secure
        // encode the entire message following OWASP standards
        // this is HTML encoding because we are outputting data into HTML
        $lUserAgentString = $Encoder->encodeForHTML($lUserAgentString);
        $lPHPVersion = "PHP Version: Not Available (Secure mode doesn't reveal the server version)";
        break;
}// end switch
?>
<!-- End Content -->
</td>
</tr>
<tr class="main-table-frame-dark">
    <td colspan="2">
        <div class="container" style="margin-top: 30px">
            <div class="row">
                <div class="col-12">
                    Browser: <?php echo $lUserAgentString; ?>
                    <br/>
                    <?php echo $lPHPVersion; ?>
                </div>
                <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                    <div class="container" style="max-width: 600px">
                        <div class="row">
                            <div class="col-3">
                                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="hosted_button_id" value="45R3YEXENU97S">
                                    <input type="image"
                                           src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif"
                                           name="submit" alt="Donate Today!">
                                    <img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1"
                                         height="1">
                                </form>
                            </div>
                            <div class="col-3">
                                <a href="http://www.youtube.com/user/webpwnized" target="_blank">
                                    <img alt="Webpwnized YouTube Channel" src="./images/youtube-play-icon-40-40.png"/>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="https://twitter.com/webpwnized" target="_blank">
                                    <img alt="Webpwnized Twitter Channel" src="./images/twitter-bird-48-48.png"/>
                                </a>
                            </div>
                            <div class="col-3">
                                <a
                                        href="https://www.sans.org/reading-room/whitepapers/application/introduction-owasp-mutillidae-ii-web-pen-test-training-environment-34380"
                                        target="_blank"
                                        title="Whitepaper: Introduction to OWASP Mutillidae II Web Pen Test Training Environment"
                                >
                                    <img align="middle" alt="Webpwnized Twitter Channel"
                                         src="./images/pdf-icon-48-48.png"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>
</tr>
</table>
</body>
</html>