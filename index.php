<?php 
$navigation = (isset($_GET['navigation']) && $_GET['navigation'] != '') ? $_GET['navigation']: '';
//credits: john paul maja :D <3
include('config.php');

$login_button = '';

if(isset($_GET["code"])){
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error'])){
  $google_client->setAccessToken($token['access_token']);
  $_SESSION['access_token'] = $token['access_token'];
  $google_service = new Google_Service_Oauth2($google_client);
  $data = $google_service->userinfo->get();
  if(!empty($data['given_name'])){
   $_SESSION['user_first_name'] = $data['given_name'];
  }
  if(!empty($data['family_name'])){
   $_SESSION['user_last_name'] = $data['family_name'];
  }
  if(!empty($data['email'])){
   $_SESSION['user_email_address'] = $data['email'];
  }
  if(!empty($data['gender'])){
   $_SESSION['user_gender'] = $data['gender'];
  }
  if(!empty($data['picture'])){
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}
if(!isset($_SESSION['access_token'])){
 $login_button = '<br><a href="'.$google_client->createAuthUrl().'"><img style="" src="images/google.png" /></a>';
}
?>
<?php

//index.php

include('config2.php');

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 if(!empty($facebook_user_info['id']))
 {
  $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }

 if(!empty($facebook_user_info['name']))
 {
  $_SESSION['user_name'] = $facebook_user_info['name'];
 }

 if(!empty($facebook_user_info['email']))
 {
  $_SESSION['user_email_address'] = $facebook_user_info['email'];
 }
 
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions

    $facebook_login_url = $facebook_helper->getLoginUrl('https://maja-etact.herokuapp.com/', $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url.'"><img src="php-login-with-facebook.gif" /></a></div>';
}



?>



<html> 
    <head> <!-- credits: john paul maja :D <3 -->
      <title>Endterm Exam</title>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Fira+Sans|Mukta&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      
    </head>
    <body> <!-- credits: john paul maja :D <3 -->
      <div class="header">
      <a href="index.php"><img src="images/logo.png" style="width:300px;height:200px;"></a>
      </div>

      <div class="navbar">
        <a href="index.php">Home</a>
        <a href="index.php?navigation=product">Products</a>
        <a href="index.php?navigation=categories">Category</a>
        <a href="index.php?navigation=create">Create</a>
      </div>

        <div class="panel panel-default">
        <?php //<!-- credits: john paul maja :D <3 -->
        if($login_button == '')
        {
          switch($navigation){
            case 'product':
              require_once 'product.php';
              break;
            case 'categories':
              require_once 'categories.php';
              break;
            case 'create':
              require_once 'form_create.php';
              break;
            case 'details':
              require_once 'product-details.php';
              break;
            case 'update':
              require_once 'form_update.php';
              break;
            default:
              require_once 'home.php';
              break;
          }
        }
        else
        {
          echo '<div align="center">'.$login_button . '</div>';
        }
        ?>

<?php 
    if(isset($facebook_login_url))
    {
     echo $facebook_login_url;
    }
    else
    {
      switch($navigation){
        case 'product':
          require_once 'product.php';
          break;
        case 'categories':
          require_once 'categories.php';
          break;
        case 'create':
          require_once 'form_create.php';
          break;
        case 'details':
          require_once 'product-details.php';
          break;
        case 'update':
          require_once 'form_update.php';
          break;
        default:
          require_once 'home.php';
          break;
      }
    }
    ?>
              
        </div>
      <div class="footer">
        <h1>Maja | API</h2> <!-- credits: john paul maja :D <3 -->
      </div>
    </body><!-- credits: john paul maja :D <3 -->
</html>




