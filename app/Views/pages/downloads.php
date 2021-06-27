<?=$this->extend('layouts/coreLayout') ?>
<?=$this->section('content') ?>
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="images/about/building.jpg">
    <div class="container pt-70 pb-20">
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
        <h3 class="text-center">YOU CAN DOWNLOAD OUR DIFFERENT DOCUMENTS HERE</h3>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>FILE NAME</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($downloads as $download) : ?>
                <tr>
                    <td><?=$download->name ?></td>
                    <td><a href="<?=$download->file?>" class="btn btn-primary"><i
                                class="far fa-cloud-download"></i>Download</a></td>
                </tr>
                <?php endforeach; ?>


            </tbody>

        </table>

    </div>
</section>
<?=$this->endSection() ?>