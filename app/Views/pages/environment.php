<?=$this->extend('layouts/coreLayout') ?>
<?=$this->section('content') ?>
<section class="inner-header divider parallax layer-overlay overlay-dark-5"
    data-bg-img="assets/images/slider/eventImg.jpg">
    <div class="container pt-100 pb-100">
        <!-- Section Content -->
        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-white text-center"><?=$page['title'] ?></h2>
                    <ol class="breadcrumb text-left text-black mt-10">
                        <li><a class="text-white" href="<?=base_url()?>">Home</a></li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <h2>OUR SCHOOL ENVIRONMENT</h2>
                <p class="mb-10">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis porro nam debitis modi possimus
                    alias, optio illum unde soluta dolor excepturi dolore at enim tenetur eius dolores maxime iure
                    libero quae. Itaque explicabo sit nihil officia facilis cumque! Enim ea amet consectetur perferendis
                    harum? At, facere sit, architecto asperiores sapiente tenetur, nihil quidem error a dolores nesciunt
                    placeat porro. A.
                </p>

            </div>
            <div class="col-md-12">
                <?=$this->include('components/photoGrid') ?>
            </div>


            <!-- </div> -->
        </div>
        <br>


        <div class="row">



            <div class="col-md-12">
                <h2>TITLE</h2>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sapiente deserunt voluptatibus illo
                    excepturi quasi, aspernatur delectus fuga ipsa non expedita quo id temporibus molestiae iste culpa
                    consectetur, accusantium unde ullam, inventore tempora rerum commodi dignissimos iusto! Alias quia
                    tempore mollitia exercitationem adipisci, aliquid sapiente!
                </p>

            </div>

            <div class="col-md-4  wow fadeInRight" data-wow-duration="2s" data-wow-delay="0.5s">
                <img class="aboutImage" src="images/sports/team7.jpg" alt="">
            </div>
            <div class="col-md-4">
                <img class="aboutImage" src="images/sports/team6.jpg" alt="">
            </div>
            <div class="col-md-4">
                <img class="aboutImage" src="images/sports/team4.jpg" alt="">
            </div>

        </div>
    </div>
</section>
<?=$this->endSection() ?>