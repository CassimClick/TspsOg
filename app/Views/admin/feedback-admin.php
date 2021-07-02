<?=$this->extend('layouts/adminLayout') ?>
<?=$this->section('content') ?>
<div class="container p-10">
    <h3>FeedBack page</h3>
    <div class="col-md-12">


    </div>




    <?php foreach ($feedbacks as $feedback) : ?>

    <div class="card">
        <div class="card-header">
            <?=($feedback->name != '') ? ucfirst($feedback->name) :'Anonymous' ?> (<span
                style="font-size: 12px;"><?= dateFormatter($feedback->created_at) ?></span>)
        </div>
        <div class="card-body">

            <p class="card-text"><?=$feedback->message?></p>
        </div>
        <div class="card-footer">
            <button onclick="deleteFeedback('<?=$feedback->id?>')" class="btn btn-sm btn-danger"><i
                    class="fal fa-trash-alt"></i></button>
        </div>
    </div>


    <?php endforeach; ?>
    </tbody>
    <tfoot>

    </tfoot>
    </table>
</div>


<!-- ======================================= -->


<!-- A modal to edit an announcement -->

<script>
function deleteFeedback(id) {
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
            url: "deleteFeedback",
            data: {
                id: recordId
            },
            dataType: "json",
            success: function(response) {

                if (response == 'deleted') {
                    Swal.fire(

                        `${response}`,
                        'success',
                        location.reload(true)
                    )
                }


            }
        });
    }


}
</script>
<?=$this->endSection() ?>