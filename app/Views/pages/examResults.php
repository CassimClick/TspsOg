<?=$this->extend('layouts/coreLayout') ?>
<?=$this->section('content') ?>
<section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="assets/images/sps/pre.jpg">
    <div class="container pt-70 pb-20">
        <!-- Section Content -->
        <div class="section-content">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title text-white text-center">Examination results</h2>
                    <ol class="breadcrumb text-left text-black mt-10">
                        <li><a class="text-white" href="<?=base_url()?>">Home</a></li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>
<pre>

    <?php // print_r($joining) ?>
</pre>
<section class="joiningInstructions">
    <div class="container">
        <h4 class="text-center">YOU CAN DOWNLOAD EXAMINATION RESULTS HERE</h4>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>AcademicYear</th>
                    <th>File</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $file) : ?>

                <tr>
                    <td><?=$file->name ?></td>
                    <td><?=$file->year ?></td>
                    <td><a class="btn btn-success" href="<?=$file->file?>" download="<?=$file->file?>">Download</a></td>
                </tr>
                <?php endforeach; ?>

            </tbody>
            <tfoot>

            </tfoot>
        </table>
    </div>

</section>
<?=$this->endSection() ?>