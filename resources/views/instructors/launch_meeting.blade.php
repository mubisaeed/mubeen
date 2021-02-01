<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.5/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.8.5/css/react-select.css" />

</head>
<body>
<div style="margin:50px; " id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="ReactModalPortal"></div>
    <div class="global-pop-up-box"></div>
    <div class="sharer-controlbar-container sharer-controlbar-container--hidden"></div>
  

    <!-- import ZoomMtg dependencies -->
    <script src="https://source.zoom.us/1.7.5/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.8.5/lib/vendor/lodash.min.js"></script>

    <!-- import ZoomMtg -->
    <script src="https://source.zoom.us/zoom-meeting-1.8.5.min.js"></script>
    
    <!-- import local .js file -->

      <?php
header("Set-Cookie: key=value; path=/; domain=example.org; HttpOnly; SameSite=Lax");

        $name = Auth::user()->name;
        $password = Auth::user()->password;
        if(Auth::user()->role_id == '4')
        {
          $role = 1;
        }
        elseif(Auth::user()->role_id == '5') 
        {
          $role = 0;
        }
      ?>
    <script type="text/javascript">
        ZoomMtg.setZoomJSLib('https://source.zoom.us/1.8.5/lib', '/av'); 
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();
        const zoomMeeting = document.getElementById("zmmtg-root");
  ZoomMtg.init({
      leaveUrl: 'www.google.com',
      isSupportChat: false,
      isSupportQA: false,
      isLockBottom: false,
      debug: true,
      success: (success) => {
        ZoomMtg.join({
          signature: "{!! $a !!}",
          meetingNumber: 87285812918,
          userName: "Firstname Lastname",
          apiKey: "qrmEqiqIS7C244YKZoJyMw",
          userEmail: "mubeensaeed07@gmail.com",
          passWord: "123456789",
          role: 1,
          success: (success) => {
            console.log(success)
          },
          error: (error) => {
            console.log(error)
          }
        });
      }
    });
        

    </script>
</body>
</html>