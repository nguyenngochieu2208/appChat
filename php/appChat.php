<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyChat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <?php require_once "connectDB.php" ?>

    <div class="container bg-primary">
        <div class="main-form d-flex"
            style="background-color: aqua;margin-top: 150px; box-shadow: 2px 3px 5px rgb(84, 84, 84);">
            <div class="chat-box d-flex">
                <div class="modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalScrollableLabel">Modal title</h5>
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Optio numquam, saepe
                                    repellat perspiciatis rerum magnam, sapiente vel molestiae cum beatae error corporis
                                    eum atque eveniet!</p>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere mollitia vero odio
                                    quos error dolorem numquam, nemo explicabo modi similique! Eveniet porro
                                    exercitationem autem ratione.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>

</html>