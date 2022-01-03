<div class="row careers-content">

    <div class="col-md-12">

        <?php if(Session::instance()->get('error')) {?>
            <div class="alert alert-danger">
               <strong>ERROR!</strong>
               <?php echo Session::instance()->get_once('error');?>
            </div>
        <?php } else if(Session::instance()->get('success')) { ?>
            <div class="alert alert-success">
               <strong>ERROR!</strong>
               <?php echo Session::instance()->get_once('success');?>
            </div>
        <?php } ?>
        <div class="why-Callitme">
            <h2>Why join Callitme?</h2>

            <p>
                You are more talented and gifted than we are. You can help our organization in executing its goals.
            </p>

        </div>

        <div id="available-jobs">

            <div class="job" id="jobThreeBox">
                <?php 
                    $job_title = 'College Representative';
                ?>

                <div class="job-header">
                    <h4><?php echo $job_title; ?></h4>

                    <a data-toggle="collapse" href="#jobThree">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    </a>
                </div>
                <div id="jobThree" class="collapse in job-content">
                    <div class="job-detail">
                        <p>
                            We are looking for college students to spread the word about Callitme in their college. 
                        </p>

                        <p>Candidate should have the following qualities:</p>

                        <ul>
                            <li>You have strong relationship with campus organizations</li>
                            <li>You organize or crash at most of the college parties</li>
                            <li>You can't resist yourself from either appreciating or hating a project</li>
                            <li>You have a love or hate relationship with social networks</li> 
                        </ul>
                        
                        <p>Requirements:</p>
                           <ul>
                            <li>You know why Callitme was born and its importance in college life</li>
                            <li>You must have at least one semester remaining in school</li>
                            <li>You must have time to create the Callitme wave in your school</li>
                        </ul>
                        
                        
                          <p>Why should you consider?:</p>
                           <ul>
                            <li>You will get an exposure to online and offline marketing</li>
                            <li>Performance based incentive</li>
                            <li>Potential intership or employement with Callitme in the future</li>
                        </ul>

                    </div>
                    <?php
                        $link = url::base()."careers/apply/".urlencode($job_title);
                    ?>
                    <a href="<?php echo $link;?>" type="button" class="btn btn-secondary btn-sm apply-btn">
                        <span class="glyphicon glyphicon-thumbs-up"></span> Apply Now
                    </a>
                </div>
            </div>

            <div class="job" id="jobOneBox">
                <?php 
                    $job_title = 'Mobile App Developer';
                ?>
                <div class="job-header">
                    <h4><?php echo $job_title; ?></h4>

                    <a data-toggle="collapse" href="#jobOne">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    </a>

                </div>
                <div id="jobOne" class="collapse in job-content">
                    <div class="job-detail">
                        <p>
                            We're looking for mobile apps developer to join team. Candidates for this position should have strong knowledge of mobile app development.
                        </p>

                        <p>Requirements:</p>

                        <ul>
                            <li>Very strong Javascript, SQL, HTML5 and CSS3 skills </li>
                            <li>Mobile app development experience</li>
                            <li>Experience with with web frameworks like Kohana will be helpful</li>
                        </ul>

                    </div>
                    <?php
                        $link = url::base()."careers/apply/".urlencode($job_title);
                    ?>
                    <a href="<?php echo $link;?>" type="button" class="btn btn-secondary btn-sm apply-btn">
                        <span class="glyphicon glyphicon-thumbs-up"></span> Apply Now
                    </a>
                </div>
            </div>

            <div class="job" id="jobTwoBox">
                <?php 
                    $job_title = 'PHP Developer';
                ?>
                <div class="job-header">
                    <h4><?php echo $job_title; ?></h4>

                    <a data-toggle="collapse" href="#jobTwo">
                        <span class="glyphicon glyphicon-minus-sign"></span>
                    </a>
                </div>
                <div id="jobTwo" class="collapse in job-content">
                    <div class="job-detail">
                        <p>
                           We are looking for PHP developers to join our team. 
                        </p>

                        <p>Requirements:</p>

                        <ul>
                            <li>Very strong Javascript and HTML5/CSS3 skills</li>
                            <li>Solid knowledge of PHP Kohana framework or a comparable framework</li>
                        </ul>

                    </div>
                    <?php
                        $link = url::base()."careers/apply/".urlencode($job_title);
                    ?>
                    <a href="<?php echo $link;?>" type="button" class="btn btn-secondary btn-sm apply-btn">
                        <span class="glyphicon glyphicon-thumbs-up"></span> Apply Now
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function(){
        $('.collapse').on('hide.bs.collapse', function () {
            $(this).closest('.job').find('.glyphicon-minus-sign').removeClass('glyphicon-minus-sign').addClass('glyphicon-plus-sign');
        })
        $('.collapse').on('show.bs.collapse', function () {
            $(this).closest('.job').find('.glyphicon-plus-sign').removeClass('glyphicon-plus-sign').addClass('glyphicon-minus-sign');
        })
    });
</script>