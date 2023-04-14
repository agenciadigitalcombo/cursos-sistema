<!DOCTYPE html>


<head>
    <title>
        <?php echo get_phrase('live_class'); ?>
    </title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.6.0/css/bootstrap.css" />
    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/2.6.0/css/react-select.css" />

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

</head>

<body>
    <style>
        body {
            padding-top: 50px;
        }

        .course_info {
            color: #999999;
            font-size: 11px;
            padding-bottom: 10px;
        }

        .btn-finish {
            background-color: #656565;
            border-color: #222222;
            color: #cacaca;
        }

        .btn-finish:hover,
        .btn-finish:focus,
        .btn-finish:active,
        .btn-finish.active,
        .open .dropdown-toggle.btn-finish {
            color: #cacaca;
        }

        .course_user_info {
            color: #989898;
            font-size: 12px;
            margin-right: 20px;
        }
        .nav_header_custom_css {
            padding: 0px !important;
        }
        .nav_c {
            top:690px;
        }
        .xmlns {
            enable-background:new 0 0 512 512; margin-top: 5px;
        }
        .svc {
            height:20px; vertical-align: middle;
        }

    </style>



    <script src="https://source.zoom.us/2.6.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="<?php echo base_url('assets/backend/js/jquery-3.3.1.min.js'); ?>"></script>
    <script src="https://source.zoom.us/2.6.0/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-2.6.0.min.js"></script>



    <script>

"use strict"; 

        function stop_zoom() {
            var r = confirm("<?php echo get_phrase('do_you_want_to_leave_the_live_video_class'); ?> ? <?php echo get_phrase('you_can_join_them_later_if_the_video_class_remains_ive'); ?>");
            if (r == true) {
                ZoomMtg.leaveMeeting();
            }

        }

        $(document).ready(function() {
            start_zoom();
        });

        function start_zoom() {

            ZoomMtg.preLoadWasm();
            ZoomMtg.prepareJssdk();

            var API_KEY = "<?php echo $live_class_details['zoom_api_key'] ?>";
            var API_SECRET = "<?php echo $live_class_details['zoom_secret_key'] ?>";
            var USER_NAME = "<?php echo $logged_user_details['first_name'] . " " . $logged_user_details['last_name']; ?>";
            var MEETING_NUMBER = "<?php echo $live_class_details['zoom_meeting_id'] ?>";
            var PASSWORD = "<?php echo $live_class_details['zoom_meeting_password'] ?>";

           var  testTool = window.testTool;


            var meetConfig = {
                apiKey: API_KEY,
                apiSecret: API_SECRET,
                meetingNumber: MEETING_NUMBER,
                userName: USER_NAME,
                passWord: PASSWORD,
                leaveUrl: "<?php echo site_url('addons/tutor_booking/tutor_schedule_list_by_booking_id/'.$booking_details['id']) ?>",
                role: 1
            };



            var signature = ZoomMtg.generateSignature({
                meetingNumber: meetConfig.meetingNumber,
                apiKey: meetConfig.apiKey,
                apiSecret: meetConfig.apiSecret,
                role: meetConfig.role,
                success: function(res) {
                    console.log(res.result);
                }
            });

            ZoomMtg.init({
                leaveUrl: "<?php echo site_url('addons/tutor_booking/tutor_schedule_list_by_booking_id/'.$booking_details['id']) ?>",
                isSupportAV: true,
                success: function() {
                    ZoomMtg.join({
                        meetingNumber: meetConfig.meetingNumber,
                        userName: meetConfig.userName,
                        signature: signature,
                        apiKey: meetConfig.apiKey,
                        passWord: meetConfig.passWord,
                        success: function(res) {
                            console.log('join meeting success');
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    });
                },
                error: function(res) {
                    console.log(res);
                }
            });
        }
    </script>
</body>

</html>
