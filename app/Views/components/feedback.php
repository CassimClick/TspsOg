<section class="divider" data-bg-img="assets/images/slider/eventImg.jpg" style="background-attachment: fixed;">
    <div class="overlay2"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-4">
                <div class="widget border-1px p-30" style="background: white;">
                    <h5 class="widget-title line-bottom">Contact Us</h5>
                    <form id="quick_contact_form" name="quick_contact_form" class="quick-contact-form" action="#"
                        method="post">
                        <div class="form-group">
                            <label for="">Your Name (Optional)</label>
                            <input id="name" class="form-control" type="text" placeholder="Your Name"
                                style="color: #333;">
                        </div>
                        <div class="form-group">
                            <label for="">Your Message</label>
                            <textarea id="message" class="form-control" placeholder="Enter Message" rows="3"
                                style="color: #333;"></textarea>
                        </div>
                        <div class="form-group">

                            <button id="formBtn" type="button"
                                class="btn btn-dark btn-theme-colored btn-sm mt-0">Submit</button>
                        </div>
                    </form>


                    <!-- Quick Contact Form Validation-->
                    <script type="text/javascript">
                    const name = document.querySelector('#name')
                    const message = document.querySelector('#message')
                    const formBtn = document.querySelector('#formBtn')

                    formBtn.addEventListener('click', function(e) {

                        if (message.value != '') {


                            $.ajax({
                                type: "POST",
                                url: "sendFeedback",
                                data: {
                                    name: name.value,
                                    message: message.value,
                                },
                                dataType: "json",
                                success: function(response) {
                                    console.log(response)

                                    if (response == 'submitted') {
                                        message.style.border = ''
                                        name.value = ''
                                        message.value = ''
                                        swal({
                                            title: 'Thanks For Your FeedBack',
                                            icon: "success",
                                            timer: 4500
                                        });
                                    }


                                }
                            });
                        } else {
                            message.style.border = '1px solid red'
                        }
                    })
                    </script>
                </div>
            </div>
        </div>
    </div>
</section>