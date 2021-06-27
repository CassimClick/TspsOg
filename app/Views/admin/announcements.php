<?=$this->extend('layouts/adminLayout') ?>
<?=$this->section('content') ?>
<div class="container p-10">
    <h3>Announcements page</h3>
    <div class="col-md-12">
        <button type="button" id="newAnnouncement" class="btn btn-success btn-sm mb-2 pull-right" data-toggle="modal"
            data-target="#announcement">
            <i class="far fa-plus"></i> Add
        </button>

    </div>



    <table class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th scope="col">Tittle</th>
                <th scope="col">Date</th>
                <th scope="col">Content</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($announcements as $announcement) : ?>

            <tr>
                <td><?=ucfirst($announcement->title) ?></td>
                <td><?= dateFormatter($announcement->date) ?></td>
                <td><?=substr($announcement->description,0,60)?></td>
                <td>
                    <div class="button-group">
                        <button onclick="viewAnnouncement('<?=$announcement->id?>')" class="btn btn-sm btn-success"><i
                                class="fal fa-eye"></i></button>
                        <button onclick="editAnnouncement('<?=$announcement->id?>')" class="btn btn-sm btn-primary"><i
                                class="fal fa-edit"></i></button>
                        <button onclick="deleteAnnouncement('<?=$announcement->id?>')" class="btn btn-sm btn-danger"><i
                                class="fal fa-trash-alt"></i></button>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>

<div class="modal fade" id="announcement">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Announcement</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="my-input">Tittle</label>
                    <input id="title" class="form-control" type="text" name="">
                </div>
                <div class="form-group">
                    <label for="my-input">Date</label>
                    <input id="date" class="form-control" type="date" name="">
                </div>
                <div class="form-group">
                    <label for="my-textarea">Description</label>
                    <textarea id="description" class="form-control" name="" rows="3"></textarea>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="publishBtn" class="btn btn-primary">Publish</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- ======================================= -->
<div class="modal announcementPreview fade" id="announcement">
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

<!-- A modal to edit an announcement -->
<div class="modal announcementEdit fade" id="announcementEdit">
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

                <input id="theId" class="form-control" type="text" hidden>
                <div class="form-group">
                    <label for="my-input">Title</label>
                    <input id="announcementTitle" class="form-control" type="text" name="">
                </div>
                <div class="form-group">
                    <label for="my-input">Date</label>
                    <input id="announcementDate" class="form-control" type="date" name="">
                </div>

                <div class="form-group">
                    <label for="my-textarea">Description</label>
                    <textarea id="announcementDesc" class="form-control" name="" rows="3"></textarea>
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
//=================Update Announcement====================
$('#updateBtn').click(function() {
    const theId = $('#theId')
    const title = $('#announcementTitle')
    const date = $('#announcementDate')
    const description = $('#announcementDesc')

    function clearInputs() {
        const title = $('#announcementTitle').val(' ')
        const date = $('#announcementDate').val(' ')
        const description = $('#announcementDesc').val(' ')
    }

    function validator(input) {
        if (input.val() == '') {
            input.css('border', '1px solid red')
            return false
        } else {
            input.css('border', '1px solid green')
            return true
        }
    }

    if (validator(title) && validator(date) && validator(description)) {
        $.ajax({
            type: "POST",
            url: "updateAnnouncement",
            dataType: "json",
            data: {
                theId: theId.val(),
                title: title.val(),
                date: date.val(),
                description: description.val(),
            },

            success: function(response) {
                $('.modal').modal('hide');
                clearInputs()


                Swal.fire(
                    '',
                    `${response}`,
                    'success'
                );
                location.reload(true);
            }
        });
    }


});

//=================Publishing new Announcement====================
$('#publishBtn').click(function(e) {

    const title = $('#title')
    const date = $('#date')
    const description = $('#description')

    function clearInputs() {
        const title = $('#title').val(' ')
        const date = $('#date').val(' ')
        const description = $('#description').val(' ')
    }

    function validator(input) {
        if (input.val() == '') {
            input.css('border', '1px solid red')
            return false
        } else {
            input.css('border', '1px solid green')
            return true
        }
    }
    if (validator(title) && validator(date) && validator(description)) {
        $.ajax({
            type: "POST",
            url: "publishAnnouncement",
            dataType: "json",
            data: {
                title: title.val(),
                date: date.val(),
                description: description.val(),
            },

            success: function(response) {
                $('.modal').modal('hide');
                clearInputs()
                Swal.fire(
                    '',
                    `${response}`,
                    'success'
                );
                location.reload(true);
            }
        });
    }

})
//=====================================

function viewAnnouncement(id) {
    const title = $('#a-title')
    const date = $('#a-date')
    const description = $('#a-description')

    $.ajax({
        type: "POST",
        url: "viewSingleAnnouncement",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {

            title.html(response.title)
            date.html(response.date)
            description.html(response.description)
        }
    });


    $('.announcementPreview').modal('show');
}

function editAnnouncement(id) {
    $('.announcementEdit').modal('show');
    const theId = $('#theId')
    const title = $('#announcementTitle')
    const date = $('#announcementDate')
    const description = $('#announcementDesc')

    $.ajax({
        type: "POST",
        url: "viewSingleAnnouncement",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {
            theId.val(response.id)
            title.val(response.title)
            date.val(response.date)
            description.val(response.description)
        }
    });



}





function deleteAnnouncement(id) {
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

            deleteFile(id)

        }
    })





    //=================Delete Announcement====================
    function deleteFile(recordId) {

        $.ajax({
            type: "POST",
            url: "deleteAnnouncement",
            data: {
                id: recordId
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