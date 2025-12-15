<?php

function handle_error($errno, $errstr, $errfile, $errline)
{
  // Create error log file path based on the file where the error occurred
  $errorLog = dirname(__FILE__) . '/error_log.log'; // Error log file location within the project folder

  // Format error message with additional information
  $error_message = "[" . date("Y-m-d H:i:s") . "] Error [$errno]: $errstr in $errfile on line $errline" . PHP_EOL;

  // Attempt to open the error log file in append mode, creating it if it doesn't exist
  $file_handle = fopen($errorLog, 'a');
  if ($file_handle !== false) {
    // Write error message to the log file
    fwrite($file_handle, $error_message);
    // Close the file handle
    fclose($file_handle);
  }

  // Save error message in session
  $_SESSION['error_message'] = $error_message;

  // Redirect user back to the same page only if there is no error
  if (!isset($_SESSION['error_flag'])) {
    // Set error flag to prevent infinite redirection loop
    $_SESSION['error_flag'] = true;
    // Redirect user back to the same page
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit(); // Stop further execution
  }
}

function valid($conn, $value)
{
  $valid = htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $value))));
  return $valid;
}

function separateAlphaNumeric($string)
{
  $alpha = "";
  $numeric = "";
  // Mengiterasi setiap karakter dalam string
  for ($i = 0; $i < strlen($string); $i++) {
    // Memeriksa apakah karakter adalah huruf
    if (ctype_alpha($string[$i])) {
      $alpha .= $string[$i];
    }
    // Memeriksa apakah karakter adalah angka
    if (ctype_digit($string[$i])) {
      $numeric .= $string[$i];
    }
  }
  // Mengembalikan array yang berisi huruf dan angka terpisah
  return array(
    "alpha" => $alpha,
    "numeric" => $numeric
  );
}

function generateToken()
{
  // Generate a random 6-digit number
  $token = mt_rand(100000, 999999);
  return $token;
}

function compressImage($source, $destination, $quality)
{
  // mendapatkan info image
  $imgInfo = getimagesize($source);
  $mime = $imgInfo['mime'];
  // membuat image baru
  switch ($mime) {
    // proses kode memilih tipe tipe image 
    case 'image/jpeg':
      $image = imagecreatefromjpeg($source);
      break;
    case 'image/png':
      $image = imagecreatefrompng($source);
      break;
    default:
      $image = imagecreatefromjpeg($source);
  }

  // Menyimpan image dengan ukuran yang baru
  imagejpeg($image, $destination, $quality);

  // Return image
  return $destination;
}

function hapusFolderRecursively($folderPath)
{
  if (is_dir($folderPath)) {
    $files = glob($folderPath . '/*');
    foreach ($files as $file) {
      is_dir($file) ? hapusFolderRecursively($file) : unlink($file);
    }
    rmdir($folderPath);
  }
}

if (!isset($_SESSION["project_sistem_penerimaan_blt"]["users"])) {
  function register($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) > 0) {
        $message = "Maaf, email yang anda masukan sudah terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        if ($data['password'] !== $data['re_password']) {
          $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        } else {
          $password = password_hash($data['password'], PASSWORD_DEFAULT);
          $token = generateToken();
          $en_user = password_hash($token, PASSWORD_DEFAULT);
          $en_user = str_replace("$", "", $en_user);
          $en_user = str_replace("/", "", $en_user);
          $en_user = str_replace(".", "", $en_user);
          $to       = $data['email'];
          $subject  = "Account Verification - Sistem Penerimaan BLT";
          $message  = "<!doctype html>
          <html>
            <head>
                <meta name='viewport' content='width=device-width'>
                <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
                <title>Account Verification</title>
                <style>
                    @media only screen and (max-width: 620px) {
                        table[class='body'] h1 {
                            font-size: 28px !important;
                            margin-bottom: 10px !important;}
                        table[class='body'] p,
                        table[class='body'] ul,
                        table[class='body'] ol,
                        table[class='body'] td,
                        table[class='body'] span,
                        table[class='body'] a {
                            font-size: 16px !important;}
                        table[class='body'] .wrapper,
                        table[class='body'] .article {
                            padding: 10px !important;}
                        table[class='body'] .content {
                            padding: 0 !important;}
                        table[class='body'] .container {
                            padding: 0 !important;
                            width: 100% !important;}
                        table[class='body'] .main {
                            border-left-width: 0 !important;
                            border-radius: 0 !important;
                            border-right-width: 0 !important;}
                        table[class='body'] .btn table {
                            width: 100% !important;}
                        table[class='body'] .btn a {
                            width: 100% !important;}
                        table[class='body'] .img-responsive {
                            height: auto !important;
                            max-width: 100% !important;
                            width: auto !important;}}
                    @media all {
                        .ExternalClass {
                            width: 100%;}
                        .ExternalClass,
                        .ExternalClass p,
                        .ExternalClass span,
                        .ExternalClass font,
                        .ExternalClass td,
                        .ExternalClass div {
                            line-height: 100%;}
                        .apple-link a {
                            color: inherit !important;
                            font-family: inherit !important;
                            font-size: inherit !important;
                            font-weight: inherit !important;
                            line-height: inherit !important;
                            text-decoration: none !important;
                        .btn-primary table td:hover {
                            background-color: #d5075d !important;}
                        .btn-primary a:hover {
                            background-color: #000 !important;
                            border-color: #000 !important;
                            color: #fff !important;}}
                </style>
            </head>
            <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
                <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
                <tr>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                    <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                    <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
            
                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                                <tr>
                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $data['name'] . ",</p>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                    <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                    <tbody>
                                        <tr>
                                        <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                            <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                            <tbody>
                                                <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di Sistem Penerimaan BLT.</p>
                                    <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        
                        <!-- START FOOTER -->
                        <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                        <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                            <tr>
                            <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                            </td>
                            </tr>
                            <tr>
                            <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                                Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                            </td>
                            </tr>
                        </table>
                        </div>
                        <!-- END FOOTER -->
            
                    <!-- END CENTERED WHITE CONTAINER -->
                    </div>
                    </td>
                    <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                </tr>
                </table>
            </body>
          </html>";
          smtp_mail($to, $subject, $message, "", "", 0, 0, true);
          $_SESSION['data_auth'] = ['en_user' => $en_user];
          $sql = "INSERT INTO users(en_user,token,name,email,password) VALUES('$en_user','$token','$data[name]','$data[email]','$password')";
        }
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function re_verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $name = $row['name'];
        $email = $row['email'];
        $token = generateToken();
        $reen_user = password_hash($token, PASSWORD_DEFAULT);
        $reen_user = str_replace("$", "", $reen_user);
        $reen_user = str_replace("/", "", $reen_user);
        $reen_user = str_replace(".", "", $reen_user);
        $to       = $email;
        $subject  = "Account Verification - Sistem Penerimaan BLT";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Account Verification</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Selamat akun kamu sudah terdaftar, tinggal satu langkah lagi kamu sudah bisa menggunakan akun. Silakan salin kode token dibawah ini untuk memverifikasi akun kamu.</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center; font-weight: bold;' valign='top' bgcolor='#ffffff' align='center'>" . $token . "</td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Terima kasih telah mendaftar di Sistem Penerimaan BLT.</p>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $_SESSION['data_auth'] = ['en_user' => $reen_user];
        $sql = "UPDATE users SET en_user='$reen_user', token='$token', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function verifikasi($conn, $data, $action)
  {
    if ($action == "update") {
      $checkEN = "SELECT * FROM users WHERE en_user='$data[en_user]'";
      $checkEN = mysqli_query($conn, $checkEN);
      if (mysqli_num_rows($checkEN) == 0) {
        $message = "Maaf, sepertinya ada kesalahan saat mendaftar.";
        $message_type = "warning";
        alert($message, $message_type);
        return false;
      } else if (mysqli_num_rows($checkEN) > 0) {
        $row = mysqli_fetch_assoc($checkEN);
        $token_primary = $row['token'];
        $updated_at = strtotime($row['updated_at']);
        $current_time = time();
        if (($current_time - $updated_at) > (5 * 60)) {
          $message = "Maaf, waktu untuk verifikasi telah habis.";
          $message_type = "warning";
          alert($message, $message_type);
          $_SESSION["project_sistem_penerimaan_blt"] = [
            "message-warning" => "Maaf, waktu untuk verifikasi telah habis.",
            "time-message" => time()
          ];
          return false;
        }
        if ($data['token'] !== $token_primary) {
          $message = "Maaf, kode token yang anda masukan masih salah.";
          $message_type = "warning";
          alert($message, $message_type);
          return false;
        }
        $sql = "UPDATE users SET id_active='1', updated_at=current_timestamp WHERE en_user='$data[en_user]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function forgot_password($conn, $data, $action, $baseURL)
  {
    if ($action == "update") {
      $checkEmail = "SELECT * FROM users WHERE email='$data[email]'";
      $checkEmail = mysqli_query($conn, $checkEmail);
      if (mysqli_num_rows($checkEmail) === 0) {
        $message = "Maaf, email yang anda masukan belum terdaftar.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $row = mysqli_fetch_assoc($checkEmail);
        $name = valid($conn, $row['name']);
        $token = generateToken();
        $en_user = password_hash($token, PASSWORD_DEFAULT);
        $en_user = str_replace("$", "", $en_user);
        $en_user = str_replace("/", "", $en_user);
        $en_user = str_replace(".", "", $en_user);
        $to       = $data['email'];
        $subject  = "Reset password - Sistem Penerimaan BLT";
        $message  = "<!doctype html>
        <html>
          <head>
              <meta name='viewport' content='width=device-width'>
              <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
              <title>Reset password</title>
              <style>
                  @media only screen and (max-width: 620px) {
                      table[class='body'] h1 {
                          font-size: 28px !important;
                          margin-bottom: 10px !important;}
                      table[class='body'] p,
                      table[class='body'] ul,
                      table[class='body'] ol,
                      table[class='body'] td,
                      table[class='body'] span,
                      table[class='body'] a {
                          font-size: 16px !important;}
                      table[class='body'] .wrapper,
                      table[class='body'] .article {
                          padding: 10px !important;}
                      table[class='body'] .content {
                          padding: 0 !important;}
                      table[class='body'] .container {
                          padding: 0 !important;
                          width: 100% !important;}
                      table[class='body'] .main {
                          border-left-width: 0 !important;
                          border-radius: 0 !important;
                          border-right-width: 0 !important;}
                      table[class='body'] .btn table {
                          width: 100% !important;}
                      table[class='body'] .btn a {
                          width: 100% !important;}
                      table[class='body'] .img-responsive {
                          height: auto !important;
                          max-width: 100% !important;
                          width: auto !important;}}
                  @media all {
                      .ExternalClass {
                          width: 100%;}
                      .ExternalClass,
                      .ExternalClass p,
                      .ExternalClass span,
                      .ExternalClass font,
                      .ExternalClass td,
                      .ExternalClass div {
                          line-height: 100%;}
                      .apple-link a {
                          color: inherit !important;
                          font-family: inherit !important;
                          font-size: inherit !important;
                          font-weight: inherit !important;
                          line-height: inherit !important;
                          text-decoration: none !important;
                      .btn-primary table td:hover {
                          background-color: #d5075d !important;}
                      .btn-primary a:hover {
                          background-color: #000 !important;
                          border-color: #000 !important;
                          color: #fff !important;}}
              </style>
          </head>
          <body class style='background-color: #e1e3e5; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
              <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background-color: #e1e3e5; width: 100%;' width='100%' bgcolor='#e1e3e5'>
              <tr>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
                  <td class='container' style='font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; max-width: 580px; padding: 10px; width: 580px; margin: 0 auto;' width='580' valign='top'>
                  <div class='content' style='box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px;'>
          
                      <!-- START CENTERED WHITE CONTAINER -->
                      <table role='presentation' class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; background: #ffffff; border-radius: 3px; width: 100%;' width='100%'>
          
                      <!-- START MAIN CONTENT AREA -->
                      <tr>
                          <td class='wrapper' style='font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;' valign='top'>
                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                              <tr>
                              <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Hi " . $name . ",</p>
                                  <p style='font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; margin-bottom: 15px;'>Pesan ini secara otomatis dikirimkan kepada anda karena anda meminta untuk mereset kata sandi. Jika anda tidak sama sekali ingin mereset atau bukan anda yang ingin mereset abaikan saja. Klik tombol reset berikut untuk melanjutkan:</p>
                                  <table role='presentation' border='0' cellpadding='0' cellspacing='0' class='btn btn-primary' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; min-width: 100%; width: 100%;' width='100%'>
                                  <tbody>
                                      <tr>
                                      <td align='left' style='font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;' valign='top'>
                                          <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: auto; width: auto;'>
                                          <tbody>
                                              <tr>
                                                <td style='font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #ffffff; border-radius: 5px; text-align: center;' valign='top' bgcolor='#ffffff' align='center'>
                                                  <a href='" . $baseURL . "auth/new-password?en=" . $en_user . "' target='_blank' style='background-color: #ffffff; border: solid 1px #000; border-radius: 5px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-decoration: none; text-transform: capitalize; border-color: #000; color: #000;'>Atur Ulang Kata Sandi</a> 
                                                </td>
                                              </tr>
                                          </tbody>
                                          </table>
                                      </td>
                                      </tr>
                                  </tbody>
                                  </table>
                                  <small>Peringatan! Ini adalah pesan otomatis sehingga Anda tidak dapat membalas pesan ini.</small>
                              </td>
                              </tr>
                          </table>
                          </td>
                      </tr>
          
                      <!-- END MAIN CONTENT AREA -->
                      </table>
                      
                      <!-- START FOOTER -->
                      <div class='footer' style='clear: both; margin-top: 10px; text-align: center; width: 100%;'>
                      <table role='presentation' border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; width: 100%;' width='100%'>
                          <tr>
                          <td class='content-block' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              <span class='apple-link' style='color: #9a9ea6; font-size: 12px; text-align: center;'>Workarea Jln. S. K. Lerik, Kota Baru, Kupang, NTT, Indonesia. (0380) 8438423</span>
                          </td>
                          </tr>
                          <tr>
                          <td class='content-block powered-by' style='font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; color: #9a9ea6; font-size: 12px; text-align: center;' valign='top' align='center'>
                              Powered by <a href='https://www.netmedia-framecode.com' style='color: #9a9ea6; font-size: 12px; text-align: center; text-decoration: none;'>Netmedia Framecode</a>.
                          </td>
                          </tr>
                      </table>
                      </div>
                      <!-- END FOOTER -->
          
                  <!-- END CENTERED WHITE CONTAINER -->
                  </div>
                  </td>
                  <td style='font-family: sans-serif; font-size: 14px; vertical-align: top;' valign='top'>&nbsp;</td>
              </tr>
              </table>
          </body>
        </html>";
        smtp_mail($to, $subject, $message, "", "", 0, 0, true);
        $sql = "UPDATE users SET en_user='$en_user', token='$token', updated_at=current_timestamp WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function new_password($conn, $data, $action)
  {
    if ($action == "update") {
      $lenght = strlen($data['password']);
      if ($lenght < 8) {
        $message = "Maaf, password yang anda masukan harus 8 digit atau lebih.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else if ($data['password'] !== $data['re_password']) {
        $message = "Maaf, konfirmasi password yang anda masukan belum sama.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password='$password' WHERE email='$data[email]'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function login($conn, $data)
  {
    // check account
    $checkAccount = mysqli_query($conn, "SELECT * FROM users JOIN user_role ON users.id_role=user_role.id_role WHERE users.email='$data[email]'");
    if (mysqli_num_rows($checkAccount) == 0) {
      $message = "Maaf, akun yang anda masukan belum terdaftar.";
      $message_type = "danger";
      alert($message, $message_type);
      return false;
    } else if (mysqli_num_rows($checkAccount) > 0) {
      $row = mysqli_fetch_assoc($checkAccount);
      if (password_verify($data['password'], $row["password"])) {
        $_SESSION["project_sistem_penerimaan_blt"]["users"] = [
          "id" => $row["id_user"],
          "id_role" => $row["id_role"],
          "role" => $row["role"],
          "email" => $row["email"],
          "name" => $row["name"],
          "image" => $row["image"]
        ];
        return mysqli_affected_rows($conn);
      } else {
        $message = "Maaf, kata sandi yang anda masukan salah.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
    }
  }
}

if (isset($_SESSION["project_sistem_penerimaan_blt"]["users"])) {

  function profil($conn, $data, $action, $id_user)
  {
    if ($action == "update") {
      $path = "../assets/img/profil/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/profil/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        if ($remove_image != "default.svg") {
          unlink($path . $remove_image);
        }
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      if (!empty($data['password'])) {
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$data[name]', image='$image', password='$password' WHERE id_user='$id_user'";
      } else {
        $sql = "UPDATE users SET name='$data[name]', image='$image' WHERE id_user='$id_user'";
      }
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function setting($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/auth/";
      if (!empty($_FILES['image']["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["image"]["tmp_name"];
          move_uploaded_file($imageTemp, $imageUploadPath);
          $image = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['image']["name"])) {
        $unwanted_characters = "../assets/img/auth/";
        $remove_image = str_replace($unwanted_characters, "", $data['imageOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['image']["name"])) {
        $image = $data['imageOld'];
      }
      $sql = "UPDATE auth SET image='$image', bg='$data[bg]', model='$data[model]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function utilities($conn, $data, $action)
  {

    if ($action == "update") {
      $path = "../assets/img/";
      if (!empty($_FILES['logo']["name"])) {
        $fileName = basename($_FILES["logo"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["logo"]["tmp_name"];
          move_uploaded_file($imageTemp, $imageUploadPath);
          $logo = $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      if (!empty($_FILES['logo']["name"])) {
        $unwanted_characters = "../assets/img/";
        $remove_image = str_replace($unwanted_characters, "", $data['logoOld']);
        unlink($path . $remove_image);
      } else if (empty($_FILE['logo']["name"])) {
        $logo = $data['logoOld'];
      }
      $sql = "UPDATE utilities SET logo='$logo', name_web='$data[name_web]', keyword='$data[keyword]', description='$data[description]', author='$data[author]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function users($conn, $data, $action)
  {

    if ($action == "update") {
      $sql = "UPDATE users SET id_role='$data[id_role]', id_active='$data[id_active]' WHERE id_user='$data[id_user]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function role($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
      $checkRole = mysqli_query($conn, $checkRole);
      if (mysqli_num_rows($checkRole) > 0) {
        $message = "Maaf, role yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $sql = "INSERT INTO user_role(role) VALUES('$data[role]')";
      }
    }

    if ($action == "update") {
      if ($data['role'] !== $data['roleOld']) {
        $checkRole = "SELECT * FROM user_role WHERE role LIKE '%$data[role]%'";
        $checkRole = mysqli_query($conn, $checkRole);
        if (mysqli_num_rows($checkRole) > 0) {
          $message = "Maaf, role yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_role SET role='$data[role]' WHERE id_role='$data[id_role]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_role WHERE id_role='$data[id_role]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu($conn, $data, $action)
  {
    if ($action == "insert") {
      $namaFolder = strtolower($data['menu']);
      $namaFolder = str_replace(" ", "-", $namaFolder);
      $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
      $checkMenu = mysqli_query($conn, $checkMenu);
      if (mysqli_num_rows($checkMenu) > 0) {
        $message = "Maaf, menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $pathFolder = __DIR__ . '/../views/' . $namaFolder;
        if (!is_dir($pathFolder)) {
          mkdir($pathFolder, 0777, true);
          $file = fopen($pathFolder . '/redirect.php', "w");
          fwrite($file, '<?php if (!isset($_SESSION["project_sistem_penerimaan_blt"]["users"])) {
            header("Location: ../../auth/");
            exit;
          }
          ');
          fclose($file);

          $file_controller = fopen("../controller/" . $namaFolder . ".php", "w");
          fwrite($file_controller, '<?php
  
          require_once("../../config/Base.php");
          require_once("../../config/Auth.php");
          require_once("../../config/Alert.php");
          require_once("../../views/' . $namaFolder . '/redirect.php");
          ');
          fclose($file_controller);
        } else {
          $message = "Folder $namaFolder sudah ada!";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
        $sql = "INSERT INTO user_menu(icon,menu) VALUES('$data[icon]','$data[menu]')";
      }
    }

    if ($action == "update") {
      $menu_baru = strtolower(str_replace(' ', '-', $data['menu']));
      $menu_lama = strtolower(str_replace(' ', '-', $data['menuOld']));
      if ($menu_baru !== $menu_lama) {
        $checkMenu = "SELECT * FROM user_menu WHERE menu='$data[menu]'";
        $checkMenu = mysqli_query($conn, $checkMenu);
        if (mysqli_num_rows($checkMenu) > 0) {
          $message = "Maaf, menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
        $folder_lama = __DIR__ . '/../views/' . $menu_lama;
        $folder_baru = __DIR__ . '/../views/' . $menu_baru;
        if (is_dir($folder_lama)) {
          if ($menu_baru !== $menu_lama) {
            if (rename($folder_lama, $folder_baru)) {
            } else {
              $message = "Gagal mengubah nama folder.";
              $message_type = "danger";
              alert($message, $message_type);
              return false;
            }
          }
        } else {
          $message = "Folder lama tidak ditemukan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $sql = "UPDATE user_menu SET icon='$data[icon]', menu='$data[menu]' WHERE id_menu='$data[id_menu]'";
    }

    if ($action == "delete") {
      $menu = strtolower(str_replace(' ', '-', $data['menu']));
      $pathFolder = __DIR__ . '/../views/' . $menu;
      unlink("../controller/" . $menu . ".php");
      hapusFolderRecursively($pathFolder);
      $sql = "DELETE FROM user_menu WHERE id_menu='$data[id_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu($conn, $data, $action, $baseURL)
  {
    $url = strtolower($data['title']);
    $url = str_replace(" ", "-", $url);

    if ($action == "insert") {
      $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
      $checkSubMenu = mysqli_query($conn, $checkSubMenu);
      if (mysqli_num_rows($checkSubMenu) > 0) {
        $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      } else {
        $menu = "SELECT * FROM user_menu WHERE id_menu = '$data[id_menu]'";
        $view_menu = mysqli_query($conn, $menu);
        $data_menu = mysqli_fetch_assoc($view_menu);
        $menu = strtolower($data_menu['menu']);
        $menu = str_replace(" ", "-", $menu);

        $file_views = fopen("../views/" . $menu . "/" . $url . ".php", "w");
        fwrite($file_views, '<?php require_once("../../controller/' . $menu . '.php");
        $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "' . $data['title'] . '";
        require_once("../../templates/views_top.php"); ?>

        <div class="nxl-content" style="height: 100vh;">

          <!-- [ page-header ] start -->
          <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
              <div class="page-header-title">
                <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item">' . $data['title'] . '</li>
                <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></li>
              </ul>
            </div>
            <div class="page-header-right ms-auto">
              <div class="page-header-right-items">
                <div class="d-flex d-md-none">
                  <a href="javascript:void(0)" class="page-header-right-close-toggle">
                    <i class="feather-arrow-left me-2"></i>
                    <span>Back</span>
                  </a>
                </div>
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                  <a href="add-' . $url . '" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    <span>Tambah</span>
                  </a>
                </div>
              </div>
              <div class="d-md-none d-flex align-items-center">
                <a href="javascript:void(0)" class="page-header-right-open-toggle">
                  <i class="feather-align-right fs-20"></i>
                </a>
              </div>
            </div>
          </div>
          <!-- [ page-header ] end -->

          <!-- [ Main Content ] start -->
          <div class="main-content">
          </div>
          <!-- [ Main Content ] end -->

        </div>

        <?php require_once("../../templates/views_bottom.php") ?>
        ');
        fclose($file_views);

        $file_views_add = fopen("../views/" . $menu . "/add-" . $url . ".php", "w");
        fwrite($file_views_add, '<?php require_once("../../controller/' . $menu . '.php");
        $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Tambah ' . $data['title'] . '";
        require_once("../../templates/views_top.php"); ?>

        <div class="nxl-content" style="height: 100vh;">

          <!-- [ page-header ] start -->
          <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
              <div class="page-header-title">
                <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item">' . $data['title'] . '</li>
                <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></li>
              </ul>
            </div>
          </div>
          <!-- [ page-header ] end -->

          <!-- [ Main Content ] start -->
          <div class="main-content">
          </div>
          <!-- [ Main Content ] end -->

        </div>

        <?php require_once("../../templates/views_bottom.php") ?>
        ');
        fclose($file_views_add);

        $petik = "'";
        $file_views_edit = fopen("../views/" . $menu . "/edit-" . $url . ".php", "w");
        fwrite($file_views_edit, '<?php require_once("../../controller/' . $menu . '.php");
        if(!isset($_GET["p"])){
          header("Location: menu");
          exit();
        }else{
          $id = valid($conn, $_GET["p"]); 
          $pull_data = "SELECT * FROM  WHERE  = ' . $petik . '$id' . $petik . '";
          $store_data = mysqli_query($conn, $pull_data);
          $view_data = mysqli_fetch_assoc($store_data);
        $_SESSION["project_sistem_penerimaan_blt"]["name_page"] = "Ubah ' . $data['title'] . '";
        require_once("../../templates/views_top.php"); ?>

        <div class="nxl-content" style="height: 100vh;">

          <!-- [ page-header ] start -->
          <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
              <div class="page-header-title">
                <h5 class="m-b-10"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"] ?></h5>
              </div>
              <ul class="breadcrumb">
                <li class="breadcrumb-item">' . $data['title'] . '</li>
                <li class="breadcrumb-item"><?= $_SESSION["project_sistem_penerimaan_blt"]["name_page"].' . $petik . ' ' . $petik . '.$view_data[""]  ?></li>
              </ul>
            </div>
          </div>
          <!-- [ page-header ] end -->

          <!-- [ Main Content ] start -->
          <div class="main-content">
          </div>
          <!-- [ Main Content ] end -->

        </div>

        <?php }
        require_once("../../templates/views_bottom.php") ?>
        ');
        fclose($file_views_edit);

        $url_sub = $menu . "/" . $url;
        $sql = "INSERT INTO user_sub_menu(id_menu,id_active,title,url) VALUES('$data[id_menu]','$data[id_active]','$data[title]','$url_sub')";
      }
    }

    if ($action == "update") {
      if ($data['title'] !== $data['titleOld']) {
        $checkSubMenu = "SELECT * FROM user_sub_menu WHERE title='$data[title]'";
        $checkSubMenu = mysqli_query($conn, $checkSubMenu);
        if (mysqli_num_rows($checkSubMenu) > 0) {
          $message = "Maaf, nama sub menu yang anda masukan sudah ada.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      }
      $menu = "SELECT * FROM user_menu WHERE id_menu = '$data[id_menu]'";
      $view_menu = mysqli_query($conn, $menu);
      $data_menu = mysqli_fetch_assoc($view_menu);
      $menu = strtolower($data_menu['menu']);
      $menu = str_replace(" ", "-", $menu);
      rename($menu . '/' . $data['urlOld'] . '.php', $menu . '/' . $url . '.php');
      rename($menu . '/' . "add-" . $data['urlOld'] . '.php', $menu . '/' . "add-" . $url . '.php');
      rename($menu . '/' . "edit-" . $data['urlOld'] . '.php', $menu . '/' . "edit-" . $url . '.php');
      $sql = "UPDATE user_sub_menu SET id_menu='$data[id_menu]', id_active='$data[id_active]', title='$data[title]', url='$url' WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    if ($action == "delete") {
      unlink("../views/" . $data['menu'] . "/" . $url . ".php");
      unlink("../views/" . $data['menu'] . "/" . "add-" . $url . ".php");
      unlink("../views/" . $data['menu'] . "/" . "edit-" . $url . ".php");
      $sql = "DELETE FROM user_sub_menu WHERE id_sub_menu='$data[id_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_menu(id_role,id_menu) VALUES('$data[id_role]','$data[id_menu]')";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_menu WHERE id_access_menu='$data[id_access_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_menu_access($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO user_access_sub_menu(id_role,id_sub_menu) VALUES('$data[id_role]','$data[id_sub_menu]')";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM user_access_sub_menu WHERE id_access_sub_menu='$data[id_access_sub_menu]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function tentang($conn, $data, $action)
  {
    $path = "../../assets/img/";

    if ($action == "insert") {
      if (!empty($_FILES['gambar']["name"])) {
        $fileName = basename($_FILES["gambar"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . "tentang_" .  $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["gambar"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $gambar = "tentang_" .  $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else {
        $message = "Maaf, file gambar belum diupload.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO tentang(gambar,judul,deskripsi) VALUES('$gambar','$data[judul]','$data[deskripsi]')";
    }

    if ($action == "update") {
      if (!empty($_FILES['gambar']['name'])) {
        $fileName = basename($_FILES["gambar"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . "tentang_" .  $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["gambar"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $gambar = "tentang_" .  $fileName_encrypt . "." . $ekstensiGambar;
          if (!empty($data['gambar_lama']) && file_exists($path . $data['gambar_lama'])) {
            unlink($path . $data['gambar_lama']);
          }
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else {
        $gambar = $data['gambar_lama'];
      }
      $sql = "UPDATE tentang SET gambar='$gambar', judul='$data[judul]', deskripsi='$data[deskripsi]' WHERE id='$data[id]'";
    }

    if ($action == "delete") {
      if (!empty($data['gambar_lama']) && file_exists($path . $data['gambar_lama'])) {
        unlink($path . $data['gambar_lama']);
      }
      $sql = "DELETE FROM tentang WHERE id='$data[id]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function prosedur_seleksi($conn, $data, $action)
  {
    $path = "../../assets/img/";

    if ($action == "insert") {
      if (!empty($_FILES['gambar']["name"])) {
        $fileName = basename($_FILES["gambar"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . "prosedur_seleksi_" .  $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["gambar"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $gambar = "prosedur_seleksi_" .  $fileName_encrypt . "." . $ekstensiGambar;
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else {
        $message = "Maaf, file gambar belum diupload.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $sql = "INSERT INTO prosedur_seleksi(gambar,link_video,judul,deskripsi) VALUES('$gambar','$data[link_video]','$data[judul]','$data[deskripsi]')";
    }

    if ($action == "update") {
      if (!empty($_FILES['gambar']['name'])) {
        $fileName = basename($_FILES["gambar"]["name"]);
        $fileName = str_replace(" ", "-", $fileName);
        $fileName_encrypt = crc32($fileName);
        $ekstensiGambar = explode('.', $fileName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $imageUploadPath = $path . "prosedur_seleksi_" .  $fileName_encrypt . "." . $ekstensiGambar;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
          $imageTemp = $_FILES["gambar"]["tmp_name"];
          compressImage($imageTemp, $imageUploadPath, 75);
          $gambar = "prosedur_seleksi_" .  $fileName_encrypt . "." . $ekstensiGambar;
          if (!empty($data['gambar_lama']) && file_exists($path . $data['gambar_lama'])) {
            unlink($path . $data['gambar_lama']);
          }
        } else {
          $message = "Maaf, hanya file gambar JPG, JPEG, dan PNG yang diizinkan.";
          $message_type = "danger";
          alert($message, $message_type);
          return false;
        }
      } else {
        $gambar = $data['gambar_lama'];
      }
      $sql = "UPDATE prosedur_seleksi SET gambar='$gambar', link_video='$data[link_video]', judul='$data[judul]', deskripsi='$data[deskripsi]' WHERE id='$data[id]'";
    }

    if ($action == "delete") {
      if (!empty($data['gambar_lama']) && file_exists($path . $data['gambar_lama'])) {
        unlink($path . $data['gambar_lama']);
      }
      $sql = "DELETE FROM prosedur_seleksi WHERE id='$data[id]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kontak($conn, $data, $action)
  {
    if ($action == "delete") {
      $sql = "DELETE FROM kontak WHERE id='$data[id]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function periode($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO periode(nama_periode,tanggal_mulai,status,keterangan) VALUES('$data[nama_periode]','$data[tanggal_mulai]','$data[status]','$data[keterangan]')";
    }

    if ($action == "update") {
      $sql = "UPDATE periode SET nama_periode='$data[nama_periode]', tanggal_mulai='$data[tanggal_mulai]', status='$data[status]', keterangan='$data[keterangan]' WHERE id='$data[id]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM periode WHERE id='$data[id]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function kriteria($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkCode = mysqli_query($conn, "SELECT kode_kriteria FROM kriteria ORDER BY LENGTH(kode_kriteria) DESC, kode_kriteria DESC LIMIT 1");
      if (mysqli_num_rows($checkCode) > 0) {
        $row = mysqli_fetch_assoc($checkCode);
        $lastCode = $row['kode_kriteria'];
        $number = (int) substr($lastCode, 1);
        $nextNumber = $number + 1;
        $kode_kriteria = "C" . $nextNumber;
      } else {
        $kode_kriteria = "C1";
      }
      $sql = "INSERT INTO kriteria(kode_kriteria, nama_kriteria, jenis) VALUES('$kode_kriteria', '$data[nama_kriteria]', '$data[jenis]')";
    }

    if ($action == "update") {
      $sql = "UPDATE kriteria SET nama_kriteria='$data[nama_kriteria]', jenis='$data[jenis]' WHERE id='$data[id]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM kriteria WHERE id='$data[id]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function sub_kriteria($conn, $data, $action)
  {
    if ($action == "insert") {
      $sql = "INSERT INTO sub_kriteria(id_kriteria, nama_sub_kriteria, deskripsi, bobot) 
            VALUES('$data[id_kriteria]', '$data[nama_sub_kriteria]', '$data[deskripsi]', '$data[bobot]')";
    }

    if ($action == "update") {
      $sql = "UPDATE sub_kriteria SET 
            id_kriteria='$data[id_kriteria]', 
            nama_sub_kriteria='$data[nama_sub_kriteria]', 
            deskripsi='$data[deskripsi]', 
            bobot='$data[bobot]' 
            WHERE id='$data[id]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM sub_kriteria WHERE id='$data[id]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function metode_roc($conn, $data_prioritas)
  {
    // Memastikan data prioritas tidak kosong
    if (empty($data_prioritas)) {
      return false;
    }

    // A. SORTING
    // Mengurutkan array berdasarkan nilai prioritas (Ascending: 1, 2, 3...)
    // asort() menjaga "Key" (ID Kriteria) agar tidak hilang saat diurutkan
    asort($data_prioritas);

    // B. VARIABEL DASAR
    $total_kriteria = count($data_prioritas); // Nilai 'K'
    $urutan = 1; // Counter untuk ranking (k)
    $berhasil = 0; // Counter update sukses

    // C. LOOPING & HITUNG
    foreach ($data_prioritas as $id_kriteria => $input_val) {

      // --- RUMUS ROC ---
      // W_k = (1/K) * Sum(1/i)

      $sigma = 0;
      // Loop Sigma berjalan dari urutan saat ini ($urutan) sampai total ($total_kriteria)
      for ($i = $urutan; $i <= $total_kriteria; $i++) {
        $sigma += (1 / $i);
      }

      $bobot_roc = $sigma / $total_kriteria;
      // --- END RUMUS ---

      // D. UPDATE KE DATABASE
      // Gunakan $urutan (1,2,3) agar ranking di DB rapi berurutan
      $id = mysqli_real_escape_string($conn, $id_kriteria);

      $sql = "UPDATE kriteria SET 
                prioritas = '$urutan', 
                bobot_roc = '$bobot_roc' 
                WHERE id = '$id'";

      if (mysqli_query($conn, $sql)) {
        $berhasil++;
      }

      $urutan++; // Naik ke ranking berikutnya
    }

    return true;
  }

  function alternatif($conn, $data, $action)
  {
    if ($action == "insert") {
      $checkNIK = mysqli_query($conn, "SELECT nik FROM alternatif WHERE nik = '$data[nik]'");
      if (mysqli_num_rows($checkNIK) > 0) {
        $message = "Maaf, NIK $data[nik] sudah terdaftar dalam sistem.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $tgl_lahir = new DateTime($data['tgl_lahir']);
      $hari_ini = new DateTime();
      $umur = $hari_ini->diff($tgl_lahir)->y;
      $sql = "INSERT INTO alternatif(nik, no_kk, nama_lengkap, jenis_kelamin, tgl_lahir, umur, status_keluarga, pekerjaan) 
            VALUES('$data[nik]', '$data[no_kk]', '$data[nama_lengkap]', '$data[jenis_kelamin]', '$data[tgl_lahir]', '$umur', '$data[status_keluarga]', '$data[pekerjaan]')";
    }

    if ($action == "update") {
      $checkNIK = mysqli_query($conn, "SELECT nik FROM alternatif WHERE nik = '$data[nik]' AND id != '$data[id]'");
      if (mysqli_num_rows($checkNIK) > 0) {
        $message = "Maaf, NIK $data[nik] sudah digunakan oleh data lain.";
        $message_type = "danger";
        alert($message, $message_type);
        return false;
      }
      $tgl_lahir = new DateTime($data['tgl_lahir']);
      $hari_ini = new DateTime();
      $umur = $hari_ini->diff($tgl_lahir)->y;
      $sql = "UPDATE alternatif SET 
            nik='$data[nik]', 
            no_kk='$data[no_kk]', 
            nama_lengkap='$data[nama_lengkap]', 
            jenis_kelamin='$data[jenis_kelamin]', 
            tgl_lahir='$data[tgl_lahir]', 
            umur='$umur', 
            status_keluarga='$data[status_keluarga]', 
            pekerjaan='$data[pekerjaan]' 
            WHERE id='$data[id]'";
    }

    if ($action == "delete") {
      $sql = "DELETE FROM alternatif WHERE id='$data[id]'";
    }

    mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }

  function save_penilaian($conn, $data)
  {
    // 1. VALIDASI KEAMANAN (PENTING)
    // Cek apakah 'id_alternatif' dan 'nilai' benar-benar dikirim?
    if (!isset($data['id_alternatif']) || empty($data['id_alternatif'])) {
      // Jika tidak ada ID alternatif, hentikan proses (return false)
      return false;
    }

    if (!isset($data['nilai']) || !is_array($data['nilai'])) {
      return false;
    }

    // 2. AMBIL DATA SETELAH LOLOS VALIDASI
    $id_alternatif = $data['id_alternatif']; // Baris ini aman sekarang
    $id_periode = isset($data['id_periode']) ? $data['id_periode'] : 2;

    $inputs = $data['nilai'];

    foreach ($inputs as $id_kriteria => $id_sub_kriteria) {

      // Skip jika kosong
      if (empty($id_sub_kriteria)) continue;

      // Ambil Bobot
      $query_skor = mysqli_query($conn, "SELECT bobot FROM sub_kriteria WHERE id = '$id_sub_kriteria'");
      if (!$query_skor || mysqli_num_rows($query_skor) == 0) continue;

      $data_skor = mysqli_fetch_assoc($query_skor);
      $skor_nilai = $data_skor['bobot'];

      // Cek Update/Insert
      $check = mysqli_query($conn, "SELECT skor_alternatif.id 
                                      FROM skor_alternatif 
                                      JOIN sub_kriteria ON skor_alternatif.id_sub_kriteria = sub_kriteria.id
                                      WHERE skor_alternatif.id_alternatif = '$id_alternatif' 
                                      AND sub_kriteria.id_kriteria = '$id_kriteria'");

      if (mysqli_num_rows($check) > 0) {
        $row = mysqli_fetch_assoc($check);
        $sql = "UPDATE skor_alternatif SET id_sub_kriteria = '$id_sub_kriteria', skor = '$skor_nilai' WHERE id = '$row[id]'";
      } else {
        $sql = "INSERT INTO skor_alternatif (id_periode, id_alternatif, id_sub_kriteria, skor) VALUES ('$id_periode', '$id_alternatif', '$id_sub_kriteria', '$skor_nilai')";
      }

      mysqli_query($conn, $sql);
    }

    return true;
  }

  function hitung_ranking_saw($conn, $id_periode)
  {
    // 1. Ambil Data Kriteria & Bobot ROC
    $kriteria = [];
    $q_krit = mysqli_query($conn, "SELECT id, kode_kriteria, jenis, bobot_roc FROM kriteria");
    while ($row = mysqli_fetch_assoc($q_krit)) {
      $kriteria[$row['id']] = $row;
    }

    // 2. Ambil Data Nilai Mentah (Skor Alternatif) untuk Periode ini
    // Array Matrix: [id_alternatif][id_kriteria] = skor
    $matrix_nilai = [];
    $alternatif_info = []; // Simpan nama & nik biar tidak query ulang

    // Query join untuk mengambil skor sekaligus identitas orangnya
    $sql = "SELECT sa.id_alternatif, sa.id_sub_kriteria, sa.skor, 
                   a.nama_lengkap, a.nik,
                   sub.id_kriteria
            FROM skor_alternatif sa
            JOIN alternatif a ON sa.id_alternatif = a.id
            JOIN sub_kriteria sub ON sa.id_sub_kriteria = sub.id
            WHERE sa.id_periode = '$id_periode'";

    $q_nilai = mysqli_query($conn, $sql);

    if (mysqli_num_rows($q_nilai) == 0) {
      return []; // Kembalikan array kosong jika belum ada penilaian
    }

    while ($row = mysqli_fetch_assoc($q_nilai)) {
      $id_alt = $row['id_alternatif'];
      $id_krit = $row['id_kriteria'];

      $matrix_nilai[$id_alt][$id_krit] = $row['skor'];

      // Simpan info orangnya
      if (!isset($alternatif_info[$id_alt])) {
        $alternatif_info[$id_alt] = [
          'id' => $id_alt,
          'nik' => $row['nik'],
          'nama' => $row['nama_lengkap']
        ];
      }
    }

    // 3. Cari Nilai MAX dan MIN untuk setiap Kriteria (Untuk Rumus Normalisasi)
    $max_min = [];
    foreach ($kriteria as $id_krit => $data_k) {
      $temp_nilai = [];
      // Kumpulkan semua nilai di kriteria ini dari semua orang
      foreach ($matrix_nilai as $id_alt => $nilai_kriteria) {
        if (isset($nilai_kriteria[$id_krit])) {
          $temp_nilai[] = $nilai_kriteria[$id_krit];
        }
      }

      // Simpan Max/Min (Hindari error jika array kosong)
      if (!empty($temp_nilai)) {
        $max_min[$id_krit] = [
          'max' => max($temp_nilai),
          'min' => min($temp_nilai)
        ];
      } else {
        $max_min[$id_krit] = ['max' => 0, 'min' => 0];
      }
    }

    // 4. Hitung Normalisasi (R) & Nilai Preferensi (V)
    $hasil_akhir = [];

    foreach ($alternatif_info as $id_alt => $info) {
      $nilai_v = 0;

      foreach ($kriteria as $id_krit => $data_k) {
        $raw_skor = isset($matrix_nilai[$id_alt][$id_krit]) ? $matrix_nilai[$id_alt][$id_krit] : 0;
        $jenis = $data_k['jenis'];
        $bobot = $data_k['bobot_roc'];
        $r_normalisasi = 0;

        // RUMUS NORMALISASI SAW
        if ($max_min[$id_krit]['max'] > 0) { // Cek pembagi nol
          if ($jenis == 'Benefit' || $jenis == 'benefit') {
            // Benefit: Nilai / Max
            $r_normalisasi = $raw_skor / $max_min[$id_krit]['max'];
          } else {
            // Cost: Min / Nilai
            // Cek pembagi nol untuk cost
            $r_normalisasi = ($raw_skor > 0) ? ($max_min[$id_krit]['min'] / $raw_skor) : 0;
          }
        }

        // RUMUS PREFERENSI (V)
        // V = Sum(Normalisasi * Bobot)
        $nilai_v += ($r_normalisasi * $bobot);
      }

      // Masukkan ke array hasil
      $hasil_akhir[] = [
        'id_alternatif' => $id_alt,
        'nik' => $info['nik'],
        'nama' => $info['nama'],
        'nilai_akhir' => $nilai_v
      ];
    }

    // 5. Sorting Array (Ranking) dari Nilai Tertinggi ke Terendah
    usort($hasil_akhir, function ($a, $b) {
      return $b['nilai_akhir'] <=> $a['nilai_akhir'];
    });

    return $hasil_akhir;
  }

  function simpan_hasil_seleksi($conn, $id_periode, $data_ranking)
  {
    // 1. Validasi Data
    if (empty($data_ranking)) {
      return false;
    }

    // 2. Cek Validitas Periode (PENTING: Cegah Error Foreign Key)
    $cek_periode = mysqli_query($conn, "SELECT id FROM periode WHERE id = '$id_periode'");
    if (mysqli_num_rows($cek_periode) == 0) {
      die("Error: ID Periode '$id_periode' tidak ditemukan di database Master Data Periode.");
    }

    // 3. Bersihkan Data Lama (Reset periode ini)
    $sql_delete = "DELETE FROM hasil_akhir WHERE id_periode = '$id_periode'";
    if (!mysqli_query($conn, $sql_delete)) {
      die("Gagal menghapus data lama: " . mysqli_error($conn));
    }

    // 4. Looping Insert Data Baru
    $rank = 1;
    foreach ($data_ranking as $row) {
      $id_alternatif = $row['id_alternatif'];
      $skor_akhir    = (float) $row['nilai_akhir'];
      $peringkat     = (int) $rank;
      $sql = "INSERT INTO hasil_akhir (id_periode, id_alternatif, skor, peringkat) 
                VALUES ('$id_periode', '$id_alternatif', '$skor_akhir', '$peringkat')";
      if (!mysqli_query($conn, $sql)) {
        die("Gagal Menyimpan Ranking $rank (NIK: $row[nik]): " . mysqli_error($conn));
      }
      $rank++;
    }
    return true;
  }

  function __name($conn, $data, $action)
  {
    if ($action == "insert") {
    }

    if ($action == "update") {
    }

    if ($action == "delete") {
    }

    // mysqli_query($conn, $sql);
    return mysqli_affected_rows($conn);
  }
}
