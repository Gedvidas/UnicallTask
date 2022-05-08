<?php require_once VIEW_ROOT . 'partials/header.php' ?>

    <h1>Add your email for subscription</h1>

    <form>
        <div class="mb-3">
            <input type="email" name="email" class="form-control input-lg email-input" id="email" aria-describedby="emailHelp" placeholder="petras@gmail.com">
        </div>
        <div id="error" class="alert alert-danger hidden d-none" role="alert">
        </div>
        <div id="confirmation" class="alert alert-success d-none" role="alert">
        </div>
        <button  class="btn btn-primary btn-email" id="sendEmail">Subscribe</button>
    </form>

<?php require_once VIEW_ROOT . 'partials/footer.php' ?>

