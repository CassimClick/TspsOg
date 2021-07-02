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



        <h2>OUR SCHOOL ENVIRONMENT</h2>
        <div class="col-md-12">
            <p> Trust St. Patrick Schools have invested heavily in the creation and maintenance of modern
                facilities
                to make our school the most conducive for learning.
                <br>
            </p>
        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="card text-white bg-primary">
                    <img class="card-img-top" src="<?=base_url()?>/assets/images/sps/pre.jpg" alt=""
                        style="height:300px">
                    <div class="card-body" style="height:auto">
                        <h4 class="card-title">Classrooms</h4>
                        <p class="card-text"> Every room has proper lighting and ventilation. Walls are ﬁlled
                            with whiteboards, drawings,
                            diagrams, maps, notices, and other teaching aids.</p>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card text-white bg-primary">
                    <img class="card-img-top" src="<?=base_url()?>/assets/images/sps/lab.jpg" alt=""
                        style="height:300px">
                    <div class="card-body" style="height:auto">
                        <h4 class="card-title">Laboratories</h4>
                        <p class="card-text">
                            Our three science labs for B iology, Chemistry, and Physics are ﬁtted with all the
                            modern equipment required by the regulatory ministry (NECTA).
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-md-6">
                <div class="card text-white bg-primary">
                    <img class="card-img-top" src="<?=base_url()?>/assets/images/sps/kimbweta.jpg" alt=""
                        style="height:300px">
                    <div class="card-body" style="height:auto">
                        <h4 class="card-title">Outdoor Discussion Benches (Vimbweta)</h4>
                        <p class="card-text">
                            The outdoor learning environment includes permanent tables and benches under shaded
                            trees, perfect for independent study and group work. Separate are an each hold 5-10
                            students, to ensure adequate space for focus. Teachers Er sometimes conduct class
                            activities here for students to enjoy the fresh air and peaceful beauty of the
                            natural area.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-primary">
                    <img class="card-img-top" src="<?=base_url()?>/assets/images/sps/computer.jpg" alt=""
                        style="height:300px">
                    <div class="card-body" style="height:auto">
                        <h4 class="card-title">Computer Lab</h4>
                        <p class="card-text">
                            To prepare students for the challenges and opportunities of our globalized work we take
                            special care of our computer lab. Modern computers and excellent technicians make this
                            learning environment very efﬁcient and effective.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<?=$this->endSection() ?>