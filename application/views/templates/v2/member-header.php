<?php $session_user = Auth::instance()->get_user(); ?>
<div class="nav-bottom">
    <div class="container">
        <ul class="nav nav-pills" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="me-tab" href="<?php echo url::base();?>">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="22"
                        height="22"
                        viewBox="0 0 22 22"
                    >
                        <defs>
                        <pattern
                            id="pattern"
                            preserveAspectRatio="xMidYMid slice"
                            width="100%"
                            height="100%"
                            viewBox="0 0 567 567"
                        >
                            <image
                            width="567"
                            height="567"
                            xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAjcAAAI3CAYAAABnKHquAAAACXBIWXMAADEPAAAxDwG3Fpn/AAAFHGlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4gPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDUgNzkuMTYzNDk5LCAyMDE4LzA4LzEzLTE2OjQwOjIyICAgICAgICAiPiA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDE5LTAzLTEwVDEwOjI0OjAzKzA1OjQ1IiB4bXA6TW9kaWZ5RGF0ZT0iMjAxOS0wMy0xMFQxOTo1ODowNyswNTo0NSIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAxOS0wMy0xMFQxOTo1ODowNyswNTo0NSIgZGM6Zm9ybWF0PSJpbWFnZS9wbmciIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0NjU0YjJhNy1kZTNi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"
                            />
                        </pattern>
                        </defs>
                        <path
                        id="icon-red-background"
                        d="M11,0A11,11,0,1,1,0,11,11,11,0,0,1,11,0Z"
                        fill="url(#pattern)"
                        />
                    </svg>
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
                href="#pills-add"
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