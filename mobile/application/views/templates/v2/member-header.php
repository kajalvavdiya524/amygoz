<?php $session_user = Auth::instance()->get_user(); ?>
<div class="nav-bottom">
    <div class="container">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="me-tab" href="<?php echo url::base();?>">
                    <img class="memberlogo visible-xs" alt="Callitme logo" src="<?php echo url::base() . 'img/amygoz-mobile-logo.png'; ?>" />
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link active" id="search-tab" href="<?php echo url::base();?>search_member">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="22"
                        height="22"
                        viewBox="0 0 22 22"
                    >
                        <path
                        id="Search"
                        d="M19.913,21.643,15.771,17.5A9.788,9.788,0,1,1,17.5,15.771l4.144,4.143a1.223,1.223,0,0,1-1.729,1.729ZM2.444,9.778A7.334,7.334,0,1,0,9.778,2.444,7.342,7.342,0,0,0,2.444,9.778Z"
                        fill="#8991a0"
                        />
                    </svg>
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="user-tab" href="<?php echo url::base();?>friends/requests">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18.5"
                        height="18"
                        viewBox="0 0 18.5 18"
                    >
                        <g
                        id="Icon_Users"
                        data-name="Icon Users"
                        transform="translate(0.25)"
                        >
                        <rect
                            id="Bounds"
                            width="18"
                            height="18"
                            fill="none"
                            opacity="0"
                        />
                        <g id="Group" transform="translate(0.75 2.25)">
                            <path
                            id="Shape"
                            d="M12,4.5V3A3,3,0,0,0,9,0H3A3,3,0,0,0,0,3V4.5"
                            transform="translate(0 9)"
                            fill="none"
                            stroke="#8991a0"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-miterlimit="10"
                            stroke-width="2"
                            />
                            <circle
                            id="Oval"
                            cx="3"
                            cy="3"
                            r="3"
                            stroke-width="2"
                            transform="translate(3)"
                            stroke="#8991a0"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-miterlimit="10"
                            fill="none"
                            />
                            <path
                            id="Shape-2"
                            data-name="Shape"
                            d="M2.25,4.4V2.9A3,3,0,0,0,0,0"
                            transform="translate(14.25 9.097)"
                            fill="none"
                            stroke="#8991a0"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-miterlimit="10"
                            stroke-width="2"
                            />
                            <path
                            id="Shape-3"
                            data-name="Shape"
                            d="M0,0A3,3,0,0,1,2.256,2.906,3,3,0,0,1,0,5.813"
                            transform="translate(11.25 0.097)"
                            fill="none"
                            stroke="#8991a0"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-miterlimit="10"
                            stroke-width="2"
                            />
                        </g>
                        </g>
                    </svg>
                </a>
            </li>
            
            <li class="nav-item">
                <a
                class="nav-link"
                id="add-tab"
                data-toggle="pill"
                href="<?php echo url::base();?>"
                role="tab"
                aria-controls="pills-add"
                aria-selected="false"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="17.799"
                        height="17.799"
                        viewBox="0 0 17.799 17.799"
                    >
                        <path
                        id="Plus"
                        d="M.343,12.242a1.175,1.175,0,0,0,1.66,0L6.293,7.953l4.289,4.289a1.174,1.174,0,1,0,1.66-1.66L7.953,6.293,12.242,2a1.174,1.174,0,1,0-1.66-1.66L6.293,4.633,2,.343A1.174,1.174,0,0,0,.343,2L4.633,6.293.343,10.582A1.175,1.175,0,0,0,.343,12.242Z"
                        transform="translate(8.899) rotate(45)"
                        fill="#fff"
                        />
                    </svg>
                </a>
            </li>
          
            <li class="nav-item">
                <a
                class="nav-link"
                id="notification-tab"
                href="<?php echo url::base();?>activity_notification"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24"
                        height="24.148"
                        viewBox="0 0 24 24.148"
                    >
                        <g id="Group" transform="translate(1 1)">
                        <path
                            id="Shape"
                            d="M11.064,22.148a2.221,2.221,0,0,1-1.915-1.1h3.832A2.222,2.222,0,0,1,11.064,22.148ZM22,16.614H0a3.328,3.328,0,0,0,3.312-3.323V7.753a7.753,7.753,0,0,1,15.506,0v5.538A3.314,3.314,0,0,0,22,16.611Z"
                            transform="translate(0 0)"
                            fill="#fff"
                            stroke="#8991a0"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-miterlimit="10"
                            stroke-width="2"
                        />
                        </g>
                    </svg>
                </a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" id="message-tab" href="<?php echo url::base();?>chat">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="22.75"
                        height="22.75"
                        viewBox="0 0 22.75 22.75"
                    >
                        <g
                        id="Group_447"
                        data-name="Group 447"
                        transform="translate(-13.25 -31.25)"
                        >
                        <path
                            id="Union_4"
                            data-name="Union 4"
                            d="M.542,17.6A.945.945,0,0,1,0,16.751V3A3,3,0,0,1,3,0H14.375a3,3,0,0,1,3,3v8.25a3,3,0,0,1-3,3H5.4L1.538,17.472a.94.94,0,0,1-.6.217A.98.98,0,0,1,.542,17.6ZM1.875,3V14.75l2.587-2.156a.93.93,0,0,1,.6-.219h9.312A1.127,1.127,0,0,0,15.5,11.25V3a1.127,1.127,0,0,0-1.125-1.125H3A1.127,1.127,0,0,0,1.875,3Z"
                            transform="translate(13.75 31.75)"
                            fill="#8991a0"
                            stroke="rgba(0,0,0,0)"
                            stroke-width="1"
                        />
                        <path
                            id="Path_152"
                            data-name="Path 152"
                            d="M35.313,54a.69.69,0,0,1-.43-.15l-3.25-2.6H22.25A2.752,2.752,0,0,1,19.5,48.5v-.687a.688.688,0,1,1,1.375,0V48.5a1.376,1.376,0,0,0,1.375,1.375h9.625a.7.7,0,0,1,.429.15l2.321,1.858V40.25a1.376,1.376,0,0,0-1.375-1.375.688.688,0,0,1,0-1.375A2.752,2.752,0,0,1,36,40.25V53.313a.69.69,0,0,1-.687.687Z"
                            transform="translate(-0.25 -0.25)"
                            fill="#8991a0"
                            stroke="#8991a0"
                            stroke-miterlimit="10"
                            stroke-width="0.5"
                        />
                        </g>
                    </svg>
                </a>
            </li>
          
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" href="<?php echo url::base().$session_user->username;?>">
                    <img
                        src="<?php echo url::base() . "upload/" . $session_user->photo->profile_pic_s ?>"
                        class="img-fluid"
                        alt=""
                        width="30px"
                    />
                </a>
            </li>
        </ul>
    </div>
    <div class="nav-line"></div>
</div>
   
<script>
    const tabs = document.querySelector(".profile-tabs");

    console.log(tabs);
    tabs.addEventListener("click", function (event) {
        const active = document.querySelectorAll(".active");

        for (var i = 0; i < active.length; i++) {
            active[i].classList.remove("active");
        }
        event.preventDefault();
        event.target.classList.add("active");
        var getId = event.target.href.split("#")[1];
        document.getElementById(getId).classList.add("active");
    });
</script>