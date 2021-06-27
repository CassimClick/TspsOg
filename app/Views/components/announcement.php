<section class="bg-theme-colored">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <article class="post pb-30">
                    <h3 class="text-white">WELCOME TO TRUST ST. PATRICK SCHOOLS</h3>
                    <p class="text-white">Trust St. Patrick Schools (TSPS) established in 1997, are registered English
                        medium schools of
                        International standards imparting strong foundation of quality education through its
                        Preparatory, Primary and Secondary levels. TSPS has a unique regional syllabi to suit scholars
                        from East African member states. TSPS works hand in gloves with the Tanzanian government to
                        rekindle the used to be dwindling education standards.</p>
                </article>



            </div>
            <div class="col-sm-12 col-md-6">
                <div class="sidebar sidebar-left mt-sm-30">

                    <div class="widget announcements-container">
                        <h3 class="widget-title text-white"><i class="fal 2x fa-bullhorn"></i> Announcements</h3>
                        <div class="latest-posts row">



                            <?php foreach ($announcements as $announcement) : ?>
                            <article class="post media-post clearfix pb-0 mb-5 col-md-6">
                                <a href="">
                                    <img class="post-thumb" src="images/megaphone.jpg" alt="">
                                    <div class="post-right">
                                        <h5 class="text-white"><?=$announcement->title ?></h5>
                                        <p class="text-white"><?=dateFormatter($announcement->date) ?></p>
                                    </div>
                                </a>
                            </article>
                            <?php endforeach; ?>







                            <article class="post media-post clearfix pb-0 mb-10 col-md-12">
                                <a class="btn  anc" href="#">View More
                                    Announcements</a>
                            </article>

                        </div>
                    </div>





                </div>
            </div>
        </div>
    </div>
</section>