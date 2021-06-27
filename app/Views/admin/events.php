<?=$this->extend('layouts/adminLayout') ?>
<?=$this->section('content') ?>
<div class="container p-10">
    <h3>event page</h3>
    <div class="col-md-12">
        <button type="button" id="newEvent" class="btn btn-success btn-sm mb-2 pull-right" data-toggle="modal"
            data-target="#event">
            <i class="far fa-plus"></i> Add
        </button>

    </div>



    <table class="table table-striped">
        <thead class="thead-light">
            <tr>
                <th scope="col">Event Title</th>
                <th scope="col">Date</th>
                <th scope="col">Content</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event) : ?>

            <tr>
                <td><?=ucfirst($event->title) ?></td>
                <td><?= dateFormatter($event->date) ?></td>
                <td><?=substr($event->description,0,60)?></td>
                <td><img style="width: 50px ; height:50px; border-radius:50%; box-shadow: -1px 4px 10px -1px rgba(36,36,36,0.6);"
                        class="event-thumb" src="<?=$event->image_url?>" alt=""></td>
                <td>
                    <div class="button-group">
                        <button onclick="viewEvent('<?=$event->id?>')" class="btn btn-sm btn-success"><i
                                class="fal fa-eye"></i></button>
                        <button onclick="editEvent('<?=$event->id?>')" class="btn btn-sm btn-primary"><i
                                class="fal fa-edit"></i></button>
                        <button onclick="deleteEvent('<?=$event->id?>')" class="btn btn-sm btn-danger"><i
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
<!-- =========New Event======== -->
<div class="modal fade" id="event">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New event</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart(base_url('publishEvent')) ?>
                <form id="eventForm" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="my-input">Tittle</label>
                        <input id="eventTitle" class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <label for="my-input">Date</label>
                        <input id="eventDate" class="form-control" type="date" name="date">
                    </div>
                    <div class="form-group">
                        <label for="my-textarea">Description</label>
                        <textarea id="eventDescription" class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="my-input">Image</label>
                        <input id="image" class="form-control" type="file" name="image-file" accept="image/*">
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Publish</button>
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
//=================Update event====================
$('#updateBtn').click(function() {
    const theId = $('#eventIdEdit')
    const title = $('#eventTitleEdit')
    const date = $('#eventDateEdit')
    const description = $('#eventDescEdit')
    const image = $('#image')

    function clearInputs() {
        const title = $('#eventTitleEdit').val(' ')
        const date = $('#eventDateEdit').val(' ')
        const description = $('#eventDescEdit').val(' ')
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
            url: "updateEvent",
            dataType: "json",
            data: {
                theId: theId.val(),
                title: title.val(),
                date: date.val(),
                description: description.val(),
                image: image.val(),
            },

            success: function(response) {
                $('.modal').modal('hide');
                clearInputs()

                console.log(response)
                // Swal.fire(
                //     '',
                //     `${response}`,
                //     'success'
                // );
                // location.reload(true);
            }
        });
    }


});

//=================Publishing new event====================
$('#eventForm').on('submit', function(e) {
    e.preventDefault()


    const title = $('#eventTitle')
    const date = $('#eventDate')
    const description = $('#eventDescription')
    const image = $('#image')

    //alert(image.val())



    function clearInputs() {
        const title = $('#eventTitle').val(' ')
        const date = $('#eventDate').val(' ')
        const description = $('#eventDescription').val(' ')
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
            url: "publishEvent",
            dataType: "json",
            data: {
                title: title.val(),
                date: date.val(),
                description: description.val(),
                image: image.val(),
            },

            success: function(response) {
                console.log(response)
                // $('.modal').modal('hide');
                // clearInputs()
                // Swal.fire(
                //     '',
                //     `${response}`,
                //     'success'
                // );
                // location.reload(true);
            }
        });
    }

})
//=====================================

function viewEvent(id) {
    const title = $('#a-title')
    const date = $('#a-date')
    const description = $('#a-description')
    const img = $('#thumbnail')

    $.ajax({
        type: "POST",
        url: "viewSingleEvent",
        data: {
            id: id
        },
        dataType: "json",
        success: function(response) {

            title.html(response.title)
            date.html(response.date)
            description.html(response.description)
            img.attr("src", response.image_url)
        }
    });


    $('.eventPreview').modal('show');
}

function editEvent(eventId) {

    //alert(eventId)
    $('.eventEdit').modal('show');
    const theId = $('#eventIdEdit')
    const title = $('#eventTitleEdit')
    const date = $('#eventDateEdit')
    const description = $('#eventDescEdit')

    $.ajax({
        type: "POST",
        url: "viewSingleEvent",
        data: {
            id: eventId
        },
        dataType: "json",
        success: function(response) {
            // console.log(response)
            theId.val(response.id)
            title.val(response.title)
            date.val(response.date)
            description.val(response.description)
        }
    });



}





function deleteEvent(id) {
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





    //=================Delete event====================
    function deleteFile(recordId) {

        $.ajax({
            type: "POST",
            url: "deleteEvent",
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