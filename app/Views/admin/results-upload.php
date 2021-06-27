<?=$this->extend('layouts/adminLayout') ?>
<?=$this->section('content') ?>
<div class="container p-10">
    <h3>Academic Results</h3>
    <div class="col-md-12">
        <button type="button" id="newEvent" class="btn btn-success btn-sm mb-2 pull-right" data-toggle="modal"
            data-target="#event">
            <i class="far fa-plus"></i> Add
        </button>

    </div>

    <?php if (count($results)>0) : ?>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>Title</th>
                <th>AcademicYear</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $file) : ?>

            <tr>
                <td><?=$file->name ?></td>
                <td><?=$file->year ?></td>
                <td><button type="button" onclick="deleteNow('<?=$file->id ?>')" class="btn btn-danger"><i
                            class="far fa-trash-alt"></i></button></td>
            </tr>
            <?php endforeach; ?>

        </tbody>
        <tfoot>

        </tfoot>
    </table>


    <?php else : ?>
    <h3>No File Uploaded Yet</h3>
    <?php endif; ?>

</div>
<!-- =========Joining Instruction======== -->
<div class="modal fade" id="event">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Uploading Academic Results</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart(base_url('publishResult')) ?>
                <form id="eventForm" method="post" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="my-select">Title</label>
                        <input id="eventDate" class="form-control" type="text" name="name" value="">
                    </div>
                    <div class="form-group">
                        <label for="my-input">Year</label>
                        <input id="eventDate" class="form-control" type="text" name="year" value="<?=date('Y')?>">
                    </div>

                    <div class="form-group">
                        <label for="my-input">File</label>
                        <input class="form-control" type="file" name="pdf-file" accept="application/pdf">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
            <?=form_close() ?>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- ======================================= -->
<div class="modal eventPreview fade" id="event">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <div>
                    <h3 id="a-title"></h3>

                    <spans id="a-date"></spans>
                </div>



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                <p id="a-description"></p>

                <img src="" id="thumbnail" alt="" style="width: 100%; height:50%">

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" id="publishBtn" class="btn btn-primary">Publish</button> -->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- A modal to edit an event -->
<div class="modal eventEdit fade" id="eventEdit">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <div>
                    <h3>Edit...</h3>

                    <!-- <spans id="a-date"></spans> -->
                </div>



                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input id="eventIdEdit" class="form-control" type="text" hidden>
                <div class="form-group">
                    <label for="my-input">Title</label>
                    <input id="eventTitleEdit" class="form-control" type="text" name="">
                </div>
                <div class="form-group">
                    <label for="my-input">Date</label>
                    <input id="eventDateEdit" class="form-control" type="date" name="">
                </div>

                <div class="form-group">
                    <label for="my-textarea">Description</label>
                    <textarea id="eventDescEdit" class="form-control" name="" rows="3"></textarea>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="updateBtn" class="btn btn-primary">Update</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
//====================================









function deleteNow(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            deleteDocument(id)

        }
    })





    //=================Delete event====================
    function deleteDocument(fileId) {



        $.ajax({
            type: "POST",
            url: "deleteResult",
            data: {
                id: fileId
            },
            dataType: "json",
            success: function(response) {

                Swal.fire(
                    'Deleted!',
                    `${response}`,
                    'success',
                    location.reload(true)
                )
            }
        });
    }


}
</script>
<?=$this->endSection() ?>