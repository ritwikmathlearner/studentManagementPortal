<div class="my-1 w-75 mx-auto border border-dark p-3" style="height: 50vmin; overflow-y: scroll; border-radius: 10px">
    <?php if(!empty($data['messages'])) : ?>
        <div class="container">
            <?php foreach($data['messages'] as $message) : ?>
                <div class="row p-2 border border-primary mb-2">
                    <div class="col-2"><p><strong><?= $message->full_name === $_SESSION['user']->full_name ? 'You' : $message->full_name ?></strong></p></div>
                    <div class="col-10"><span><?= $message->message ?></span><small class="text-secondary">&nbsp;<?= date_format(date_create($message->sent_on), 'd/m/Y H:i:s') ?></small></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p class="py-3 bg-danger text-center text-light">No messages yet</p>
    <?php endif; ?>
</div>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="mt-4 w-75 mx-auto">
    <div class="form-group">
        <textarea name="message" id="message" rows="2" class="form-control" placeholder="Enter your message here"></textarea>
        <small class="text-danger"><?= $data['messageError'] ?? '' ?></small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>