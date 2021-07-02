<section id="events" class="divider parallax overlay-dark-0" data-stellar-background-ratio="0">
    <div class="container pt-70 pb-40">
        <div class="section-title mb-30">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2 class="mt-0 line-height-1 text-center mb-10 text-dark text-uppercase">Upcoming Events</h2>

                </div>
            </div>
        </div>
        <div class="section-content">
            <div class="row">
                <?php foreach ($events as $event) : ?>


                <div class="col-xs-12 col-sm-6 col-md-6 mb-30 wow fadeInRight" data-wow-duration="1s"
                    data-wow-delay="0.5s">
                    <div class=" table-horizontal  maxwidth400 eventCard"
                        style="box-shadow: -1px 4px 10px -1px rgba(36,36,36,0.4);">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="thumb">
                                    <?php if ($event->image_url) : ?>
                                    <img class="img-fullwidth mb-sm-0" src="<?=$event->image_url?>" alt="">
                                    <?php else : ?>
                                    <img class="img-fullwidth mb-sm-0" src="assets/images/eventImg.jpg" alt="">
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="col-md-6 p-30 pl-sm-50">
                                <h4 class="mt-0 mb-5"><a href="#" class="text-white"><?=$event->title?></a></h4>
                                <ul class="list-inline mb-5 text-white">
                                    <li class="pr-0"><i class="fa fa-calendar mr-5"></i><?=dateFormatter($event->date)?>
                                    </li>

                                </ul>
                                <p class="mb-15 mt-15 text-white"><?=substr($event->description,0,80)?>.....</p>
                                <a class="text-white font-weight-600"
                                    href="<?=base_url()?>/singleEvent/<?=$event->id?>">Read More →</a>
                            </div>
                        </div>

                    </div>
                </div>
                <?php endforeach; ?>



                <?php if (count($events)>=6) : ?>
                <div class="col-xs-12 col-sm-6 col-md-6 mb-30 wow fadeInRight" data-wow-duration="1s"
                    data-wow-delay="0.5s">

                    <a href="<?=base_url()?>/allEvents" class="pull-right viewMore">View More Events</a>
                </div>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>